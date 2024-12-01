<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\Render;
use App\Helpers\Toast;
use App\Helpers\Validator;
use App\Models\Admin;
use App\Models\AdminActivity;
use App\Services\Auth;
use DateTime;
use Exception;
use PDO;

class AdminController extends Controller
{
  private $Admin;
  private $Activity;


  public function __construct()
  {
    $this->Admin = new Admin();
    $this->Activity = new AdminActivity();
    parent::__construct();
  }



  public function update()
  {

    $this->CSRFToken->check();
    $validators  = [];

    $loggedAdmin =  Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');; // Megnézzük hogy be van e logolva.
    $child_admin_id = isset($_POST['current_admin_id']) ? $_POST['current_admin_id']  : null; // Ha nem profilt frissítünk akkor ez feltöltődik az id-val.
    $adminId = $child_admin_id ?? $loggedAdmin; // Az admin Id ha létezik a current_admin akkor az ha nem akkor a profilba bejelentkezett id-ja


    // Lekérjük hogy van-e már mentve ez az admin az adatbázisba id alapján
    $prev_admin = $this->Model->selectByRecord('admins', 'id', $adminId, PDO::PARAM_INT);

    // Ki kérjük a POST-ból a kívánt adatokat!
    $name = filter_var($_POST["name"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS) ?? null;
    $password = isset($_POST["password"]) ? filter_var($_POST["password"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS) : null;
    $level = isset($_POST["level"]) ? filter_var($_POST["level"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS) : null;
    $email = isset($_POST["email"]) ? filter_var($_POST["email"] ?? '', FILTER_SANITIZE_EMAIL) : null;
    $prev_password = filter_var($_POST["prev_password"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS) ?? null;

    if (($password && !password_verify($prev_password, $prev_admin->password)) && !$child_admin_id) {
      if (isset($_POST['csrf'])) unset($_POST['csrf']);

      if ($child_admin_id) {
        $_SESSION['update_current_admin_prev'] = $_POST;
        return Toast::set('Rosszul adta meg előző jelszavát', 'red-500', '/admin/settings', null);
      }

      $_SESSION['update_admin_profile_prev'] = $_POST;
      return Toast::set('Rosszul adta meg előző jelszavát', 'red-500', '/admin/settings', null);
    }



    if ($email) {
      $validators['email'] = ['maxLength' => 150, 'email' => true, 'unique' => ['admins', 'email', PDO::PARAM_STR]];
    }

    if ($password) {
      $validators['password'] = ['password' => true, 'minLength' => 5, 'maxLength' => 500];
    }

    if ($level) {
      $validators['level'] = ['required' => true, 'num' => true];
    }

    if ($prev_admin->name !== $name) {
      $validators['name'] = ['required' => true, 'maxLength' => 50, 'unique' => ['admins', 'name', PDO::PARAM_STR]];
    }

    $errors = Validator::validate($validators);

    if (!empty($errors)) {
      if (isset($_POST['csrf'])) unset($_POST['csrf']);

      if ($child_admin_id) {
        $_SESSION['update_current_admin_prev'] = $_POST;
        $_SESSION['update_current_admin_errors'] = $errors;
        return Toast::set('Az űrlap hibásan lett kitöltve, vagy már létezik ilyen névvel vagy e-mail címmel admin.', 'danger', '/admin/settings', null);
      }

      $_SESSION['update_admin_profile_prev'] = $_POST;
      $_SESSION['update_admin_profile_errors'] = $errors;
      return Toast::set('Az űrlap hibásan lett kitöltve, vagy már létezik ilyen névvel vagy e-mail címmel admin.', 'danger', '/admin/settings', null);
    }


    try {
      $is_success = $this->Admin->updateAdmin($adminId, $_POST, $prev_admin, $child_admin_id);

      if ($is_success) {
        $this->Activity->store([
          'content' => "Frissítette a profilját.",
          'contentInEn' => null,
          'adminRefId' => $_SESSION['adminId']
        ],  $_SESSION['adminId']);

        if (isset($_SESSION['update_admin_profile_prev'])) unset($_SESSION['update_admin_profile_prev']);
        if (isset($_SESSION['update_admin_profile_errors'])) unset($_SESSION['update_admin_profile_errors']);
        return Toast::set('Admin sikeresen frissítve!', 'cyan-500', '/admin/settings', null);
      } else {
        return Toast::set('Admin frissítése sikertelen!', 'rose-500', '/admin/settings', null);
      }
    } catch (Exception $e) {
      error_log($e->getMessage());
      return Toast::set('Admin frissítése sikertelen!', 'rose-500', '/admin/settings', null);
    }
  }




  public function delete($vars)
  {
    try {
      $adminId = Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');

      $id  = filter_var($vars["id"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
      $admin = $this->Model->selectByRecord('admins', 'id', $id, PDO::PARAM_INT);

      $this->Model->deleteRecordById('admins', $id);

      $this->Activity->store([
        'content' => "Kitörölt egy admint: " . $admin->name . ", level(" . $admin->level . ")",
        'contentInEn' => null,
        'adminRefId' => $adminId
      ], $adminId);

      Toast::set('Admin törlése sikeres volt', 'green-500', '/admin/settings', null);
    } catch (Exception $e) {
      http_response_code(500);
      echo "Internal Server Error" . $e->getMessage();
      return;
    }
  }




























  /**
   * @param RENDERS --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   */





  public function index()
  {
    $adminId = Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');
    $admin = $this->Model->selectByRecord('admins', 'id', $adminId, PDO::PARAM_INT);
    $visitors = SAVING_VISITOR_PERM ? $this->Model->all('visits') : '';
    $admin_list = ADMIN_SERVICE_PERM ? $this->Model->all('admins') : [];
    $users =  USER_SERVICE_PERM ? $this->Model->all('users') : [];
    $feedbacks = FEEDBACK_PERM ? $this->Model->all('feedbacks') : [];
    $feedbackPercentages = self::getPercentageOfFeedbacks($feedbacks);
    $registrationsChartData = self::getRegistrationsByMonth($users);

    $admin_activities = $this->Activity->getAdminActivities();
    $data = [
      'numOfPage' => 10,
    ];

    echo Render::write("admin/Layout.php", [
      "admin" => $admin,
      "csrf" => $this->CSRFToken,
      "content" => Render::write("admin/pages/Dashboard.php", [
        'admin_list' => $admin_list,
        'admin' => $admin,
        'admin_activities' => $admin_activities,
        'feedbacks' => $feedbacks,
        'feedbackPercentages' => $feedbackPercentages,
        'visitors' => $visitors,
        'users' => $users,
        'registrationsChartData' => $registrationsChartData,
        'data' => $data
      ])
    ]);
  }


  public function loginPage()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    $admin = $_SESSION["adminId"] ?? null;

    if ($admin) {
      header("Location: /admin/dashboard");
      exit;
    }


    echo Render::write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "content" => Render::write("admin/pages/Login.php", [
        "csrf" => $this->CSRFToken,
        "prev" => isset($_SESSION['login_admin_prev']) ? (object)$_SESSION['login_admin_prev'] : null,
        "errors" => isset($_SESSION['login_admin_errors']) ? (object)$_SESSION['login_admin_errors'] : null
      ])
    ]);
  }


  public function table()
  {
    $adminId = Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');
    $admin = $this->Model->selectByRecord('admins', 'id', $adminId, PDO::PARAM_INT);
    $users = $this->Model->all('users');
    $data = $this->Model->paginate($users, 4, '', null);


    echo Render::write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "admin" => $admin,
      "content" => Render::write("admin/pages/Table.php", [
        'data' => $data,
        'users' => $data->pages
      ])
    ]);
  }
  public function form()
  {
    $adminId = Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');
    $admin = $this->Model->selectByRecord('admins', 'id', $adminId, PDO::PARAM_INT);
    $data = [
      'numOfPage' => 10,
    ];

    echo Render::write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "admin" => $admin,
      "content" => Render::write("admin/pages/Form.php", [
        'data' => $data
      ])
    ]);
  }
  public function settings()
  {
    $adminId = Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');

    $admin = $this->Model->selectByRecord('admins', 'id', $adminId, PDO::PARAM_STR);
    $admin_list = $this->Model->all('admins', $adminId, PDO::PARAM_STR);

    $data = $this->Model->paginate($admin_list, 10, '',  function ($offset, $numOfPages) {
      if ((int)$offset > (int)$numOfPages) {
        header("Location: /admin/settings?offset=$numOfPages");
        exit;
      }
    });

    echo Render::write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      'admin' => $admin,
      "content" => Render::write("admin/pages/Settings.php", [
        "csrf" => $this->CSRFToken,
        'data' => $data,
        'admin' => $admin,
        'data' => $data,
        "prev" => (object)[
          'add_admin_modal' => isset($_SESSION['add_admin_prev']) ? (object)$_SESSION['add_admin_prev'] : null,
        ],
        "errors" => (object)[
          'add_admin_modal' => isset($_SESSION['add_admin_errors']) ? (object)$_SESSION['add_admin_errors'] : null
        ]
      ])
    ]);
  }
  public function mailbox()
  {
    $adminId = Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');
    $admin = $this->Model->selectByRecord('admins', 'id', $adminId, PDO::PARAM_STR);

    $data = [
      'numOfPage' => 10,
    ];

    echo Render::write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      'admin' => $admin,
      "content" => Render::write("admin/pages/MailBox.php", [
        'data' => $data
      ])
    ]);
  }






















  // PRIVATES 

  private function getRegistrationsByMonth($users)
  {
    // Például, hogy hogyan lehet a $users tömböt a hónapok szerint csoportosítani
    $registrationsByMonth = [];
    $currentYear = date('Y');

    foreach ($users as $user) {
      $createdAt = new DateTime($user->created_at);
      $year = $createdAt->format('Y');
      $month = $createdAt->format('F'); // Hónap neve, pl. "January", "February", stb.

      if ($year == $currentYear) {
        if (!isset($registrationsByMonth[$month])) {
          $registrationsByMonth[$month] = 0;
        }

        $registrationsByMonth[$month]++;
      }
    }


    // JSON formátumba alakítás PHP-ban
    $registrationsChartData = json_encode($registrationsByMonth);
    return $registrationsChartData;
  }

  private function getPercentageOfFeedbacks($feedbacks)
  {
    $countOfFeedbacks = [
      1 => 0,
      2 => 0,
      3 => 0,
      4 => 0,
      5 => 0,
    ];

    $totalFeedbacks = count($feedbacks);

    foreach ($feedbacks as $feedback) {
      switch ((int)$feedback->feedback) {
        case 1:
          $countOfFeedbacks[1]++;
          break;
        case 2:
          $countOfFeedbacks[2]++;
          break;
        case 3:
          $countOfFeedbacks[3]++;
          break;
        case 4:
          $countOfFeedbacks[4]++;
          break;
        case 5:
          $countOfFeedbacks[5]++;
          break;
        default:
          // Esetleges egyéb kezelés, ha van
          break;
      }
    }

    $percentages = [];

    foreach ($countOfFeedbacks as $key => $value) {
      if ($totalFeedbacks > 0) {
        $percentages[$key] = ($value / $totalFeedbacks) * 100;
      } else {
        $percentages[$key] = 0; // Ha nincs feedback, akkor 0 százalék
      }
    }

    return $percentages;
  }
}
