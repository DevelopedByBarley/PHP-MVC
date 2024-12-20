<?php


namespace App\Helpers;

/*
  ?How to use?
  $fileSaver = new FileSaver();
  $fileSaver->saver($_FILES['ValueWhereNameIsExist'], 'public/assets/PATH', array($prevImages) ?? null, array($whiteList) ?? null ) 
*/

class FileSaver
{

  public static function saver($files, $path, $prevImages, $whiteList = null)
  {

    $whiteList = $whiteList ?? [
      'application/pdf',
      'application/msword',
      'image/png',
      'image/jpeg',
      'image/jpg',
    ];

    if (empty($files["name"])) return false;

    if (is_array($files["name"])) {
      $files = self::saveMultipleFiles($files, $path, $whiteList, $prevImages);
      if (in_array(false, $files)) {
        foreach ($files as $file) {
          if (!is_bool($file)) {
            unlink("./public/assets/$path/" . $file);
          }
        }
        return false;
      }

      return $files;
    }

    return self::save($files, $path, $whiteList, $prevImages);
  }

  private function saveMultipleFiles($files, $path, $whiteList, $prevImages)
  {
    $ret = [];
    $fileNames = [];


    foreach ($files as $fieldName => $fields) {

      foreach ($fields as $index => $field) {
        $ret[$index][$fieldName] = $fields[$index];
      }
    }

    foreach ($ret as $file) {
      $fileName =  $this->save($file, $path, $whiteList, $prevImages);
      $fileNames[] = $fileName;
    }


    return $fileNames;
  }

  private static function save($file, $path, $whiteList, $prevImages)
  {
    $fileType = mime_content_type($file["tmp_name"]);

    if (!in_array($fileType, $whiteList)) {
      return false;
    }

    $rand = uniqid(rand(), true);
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $originalFileName =  $rand . '.' . $ext;
    $directoryPath = "./public/assets/$path/";

    $destination = $directoryPath . $originalFileName;
    move_uploaded_file($file["tmp_name"], $destination);

    self::unlinkPrevImages($prevImages, $path);

    setcookie("prevContent", "", time() - 1, "/");
    return $originalFileName;
  }

  public static function unLinkImagesForFail($path, $images)
  {

    try {
      if (!$images) {
        return false;
      }

      if (is_array($images)) {
        foreach ($images as $image) {
          unlink("./public/assets/$path/" . $image);
        }
      } else {
        unlink("./public/assets/$path/" . $images);
      }

    } catch (\Throwable $th) {
      echo $th;
      exit;
    }
  }

  private static function unlinkPrevImages($prevImages, $path)
  {
    if (isset($prevImages)) {
      if (is_array($prevImages)) {
        foreach ($prevImages as $images) {
          if (file_exists("./public/assets/$path/" . $images)) {
            unlink("./public/assets/$path/" . $images);
          }
        }
      } else {
        if (file_exists("./public/assets/$path/" . $prevImages)) {
          unlink("./public/assets/$path/" . $prevImages);
        }
      }
    }
  }
}
