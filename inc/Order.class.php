<?php
class Order
{
  public $type = "undefined";
  public $amount = 0;
  public $customerId = "";
  function setType($type)
  {
    $this->type = $type;
  }
  function setAmount($amount)
  {
    $this->amount = $amount;
  }
  function setCustomerId($customerId)
  {
    $this->customerId = $customerId;
  }
}
