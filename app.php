<?php
require_once('inc/Page.class.php');
require_once('inc/OrderData.class.php');
require_once('inc/Order.class.php');
require_once('inc/FileUtility.class.php');
require_once('inc/config.inc.php');
$orderData = new OrderData();
FileUtility::initialize(DATA);
Page::header();

if (!empty($_POST)) {
  if (isset($_POST["upload"])) {
    echo "upload";
  } else { // add
    FileUtility::$currentFile = $_POST["fileName"];
    $orderData->parseWrite();
    FileUtility::write($orderData->orderString);
  }
  $notifications = FileUtility::$notifications;
}



$orderData->parseRead(FileUtility::read());

Page::main(FileUtility::$notifications, $orderData->orders);
Page::entryForm();
Page::footer();
