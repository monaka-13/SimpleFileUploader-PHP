<?php
class Page
{
  static $title = "title";
  static $author = "author";

  static function header()
  { ?>
    <!DOCTYPE html>
    <html>

    <head>
      <title></title>
      <meta charset="utf-8">
      <meta name="<?= self::$author ?>" content="">
      <link href="css/styles.css" rel="stylesheet">
    </head>

    <body>
      <header>
        <h1>Order data and Form</h1>
      </header>
      <article>
      <?php }

  static function footer()
    { ?>
      </article>
    </body>

    </html>
  <?php }

  static function entryForm()
  { ?>
    <section class="form_entry">
      <h2>Add a new order</h2>
      <form method="post">
        <div>
          <label for="type">
            Order Type
          </label>
          <select name="type" id="type">
            <option value="regular">Regular</option>
            <option value="special">Special</option>
          </select>
        </div>
        <div>
          <label for="customerId">
            Customer ID
          </label>
          <input type="text" name="customerId" id="customerId">
        </div>
        <div>
          <label for="amount">
            Amount
          </label>
          <input type="text" name="amount" id="amount">
        </div>
        <div>
          <input type="hidden" name="fileName" value="<?= FileUtility::$currentFile ?>">
          <input type="submit" name="submit" value="Submit">
        </div>
      </form>
    </section>
  <?php }

  static function uploadForm()
  { ?>
    <section class="form_upload">
      <h2>Load a file</h2>
      <form method="post" enctype="multipart/form-data">
        You can also load a data file (txt). <br>
        <input type="file" name="orderData" value=""><br>
        <input type="hidden" name="upload" value="upload">
        <input type="submit" name="submit" value="Go!">
      </form>
    </section>
  <?php }

  static function main($notifications, $data)
  { ?>
    <section class="main">
      <?php
      if (!empty($notifications))
        self::putNotification($notifications);

      if (!empty($data)) {
      ?>
        <h2>Current Data from <?= FileUtility::$currentFile; ?></h2>
        <table>
          <thead>
            <tr>
              <th>Order Type</th>
              <th>Customer ID</th>
              <th>Amount</th>
            </tr>
          </thead>
          <?php
          foreach ($data as $orderItem) {
            echo "<tr>";
            echo "\n\t<td>{$orderItem->type}</td>";
            echo "\n\t<td>{$orderItem->customerId}</td>";
            echo "\n\t<td>{$orderItem->amount}</td>";
            echo "</tr>";
          }
          ?>
        </table>
      <?php
      }
      ?>
    </section>
  <?php }

  static function putNotification($notifications)
  { ?>
    <div class="error" style="display: block;">
      <h2>Notification</h2>
      <ul>
        <?php
        foreach ($notifications as $note)
          echo "<li>{$note}</li>";
        ?>
      </ul>
    </div>
  <?php }
  }



?>