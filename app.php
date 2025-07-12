<?php
require_once('inc/Page.class.php');
require_once('inc/OrderData.class.php');
require_once('inc/Order.class.php');
require_once('inc/FileUtility.class.php');
require_once('inc/config.inc.php');
$orderData=new OrderData();
FileUtility::initialize(DATA);
Page::header();

if(isset($_POST["submit"])){
  echo "OK";
}



$orderData->parseRead(FileUtility::read());

Page::main(FileUtility::$notifications, $orderData->orders);
Page::entryForm();
Page::footer();
