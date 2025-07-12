<?php

class FileUtility
{

  static $notifications = array();
  static $fileCounter = 0;
  static $currentFile = '';

  static function initialize($fileName)
  {
    self::$currentFile = $fileName;
  }

  static function open($mode)
  {
    if (file_exists(self::$currentFile)) {
      $fh = fopen(self::$currentFile, $mode);
      return $fh;
    } else {
      echo "The file does not exist";
      return false;
    }
  }

  static function close($fh)
  {
    fclose($fh);
  }

  static function read()
  {

    $contents = null;
    try {
      if ($fh = self::open('r')) {
        $contents = fread($fh, filesize(self::$currentFile));
        self::close($fh);
      } else {
        throw new Exception("Couldn't open file " . self::$currentFile);
      }
    } catch (Exception $fe) {
      self::$notifications[] = array($fe->getMessage());
    }
    return $contents;
  }

  static function write($data)
  {
    try {
      if ($fh = self::open('a')) {
        flock($fh, LOCK_EX);
        fwrite($fh, $data, strlen($data));
        flock($fh, LOCK_UN);
        self::close($fh);
      }
    } catch (Exception $fe) {
      self::$notifications[] = array($fe->getMessage());
    }
  }

  static function upload()
  {
    $fileName = '';
    //A simple check if a file was uploaded
    if (empty($_FILES)) {
      self::$notifications[] = "Error: Please select a file to upload.";
    } else {
      if (is_uploaded_file($_FILES['orderData']['tmp_name'])) {
        // We skip the file format checking

        // Move uploaded file to final destination.
        $result = move_uploaded_file(
          $_FILES['orderData']['tmp_name'],
          REPOSITORY . self::$fileCounter . '_' . $_FILES['orderData']['name']
        );
        if ($result == 1) {
          self::$notifications[] = "Success: File was successfully uploaded.";
          $fileName = REPOSITORY . self::$fileCounter . '_' . $_FILES['orderData']['name'];
          self::$fileCounter++;
        } else
          self::$notifications[] = "Error: There was a problem uploading the file.";
      }
    }
    return $fileName;
  }
}
