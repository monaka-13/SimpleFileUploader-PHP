<?php
class OrderData
{
  public $orders = [];
  public $orderString = "";

  function parseRead($fileContent)
  {
    $lines = explode("\n", $fileContent);
    for ($i = 1; $i < count($lines); $i++) {
      $columns = explode(",", $lines[$i]);
      $order = new Order();
      $order->setCustomerId($columns[1]);
      $order->setAmount($columns[2]);
      $type = $columns[0];

      switch ($type) {
        case "regular":
        case "special":
          $order->setType($type);
          break;
      }
      print_r($order);
      $this->orders[] = $order;
    }
  }
}
