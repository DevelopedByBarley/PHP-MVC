<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminActivity;
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
    $child_admin_id = isset($_POST['current_admin_id']) ? $_POST['current_admin_id']  : null;
    $loggedAdmin =  $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');;
    $adminId = $child_admin_id ?? $loggedAdmin;


    try {
      $admin = $this->Admin->updateAdmin($adminId, $_POST, $child_admin_id);

      if (!isset($admin['status']) && $admin['status'] !== false) {
        $this->Activity->store([
          'content' => "Frissítette a profilját.",
          'contentInEn' => null,
          'adminRefId' => $_SESSION['adminId']
        ],  $_SESSION['adminId']);
        $this->Toast->set('Admin sikeresen frissítve', 'cyan-500', '/admin/settings', null);
      } else {
        $this->Toast->set($admin['message'], 'rose-500', '/admin/settings', null);
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function delete($vars)
  {
    try {
      $adminId = $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');

      $id  = filter_var($vars["id"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
      $admin = $this->Model->selectByRecord('admins', 'id', $id, PDO::PARAM_INT);

      $this->Model->deleteRecordById('admins', $id);

      $this->Activity->store([
        'content' => "Kitörölt egy admint: " . $admin->name . ", level(" . $admin->level . ")",
        'contentInEn' => null,
        'adminRefId' => $adminId
      ], $adminId);

      $this->Toast->set('Admin törlése sikeres volt', 'green-500', '/admin/settings', null);
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
    $adminId = $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');
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

    echo $this->Render->write("admin/Layout.php", [
      "admin" => $admin,
      "csrf" => $this->CSRFToken,
      "content" => $this->Render->write("admin/pages/Dashboard.php", [
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

    echo $this->Render->write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "content" => $this->Render->write("admin/pages/Login.php", [
        "csrf" => $this->CSRFToken
      ])
    ]);
  }


  public function table()
  {
    $adminId = $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');
    $admin = $this->Model->selectByRecord('admins', 'id', $adminId, PDO::PARAM_INT);
    $users = $this->Model->all('users');
    $data = $this->Model->paginate($users, 4, '', null);


    echo $this->Render->write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "admin" => $admin,
      "content" => $this->Render->write("admin/pages/Table.php", [
        'data' => $data,
        'users' => $data->pages
      ])
    ]);
  }
  public function form()
  {
    $adminId = $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');
    $admin = $this->Model->selectByRecord('admins', 'id', $adminId, PDO::PARAM_INT);
    $data = [
      'numOfPage' => 10,
    ];

    echo $this->Render->write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "admin" => $admin,
      "content" => $this->Render->write("admin/pages/Form.php", [
        'data' => $data
      ])
    ]);
  }
  public function settings()
  {
    $adminId = $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');

    $admin = $this->Model->selectByRecord('admins', 'id', $adminId, PDO::PARAM_STR);
    $admin_list = $this->Model->all('admins', $adminId, PDO::PARAM_STR);

    $data = $this->Model->paginate($admin_list, 10, '',  function ($offset, $numOfPages) {
      if ((int)$offset > (int)$numOfPages) {
        header("Location: /admin/settings?offset=$numOfPages");
        exit;
      }
    });







    echo $this->Render->write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      'admin' => $admin,
      "content" => $this->Render->write("admin/pages/Settings.php", [
        "csrf" => $this->CSRFToken,
        'data' => $data,
        'admin' => $admin,
        'data' => $data
      ])
    ]);
  }
  public function mailbox()
  {
    $adminId = $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');
    $admin = $this->Model->selectByRecord('admins', 'id', $adminId, PDO::PARAM_STR);

    $data = [
      'numOfPage' => 10,
    ];

    echo $this->Render->write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      'admin' => $admin,
      "content" => $this->Render->write("admin/pages/MailBox.php", [
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
