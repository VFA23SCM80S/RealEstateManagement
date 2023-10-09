<?php
  session_start();
  include 'db_connect.php';
if (isset($_POST['submit'])){
    foreach($_POST as $key => $value)
    {
        $_SESSION['info'][$key] = $value;
    }

    $keys = array_keys($_SESSION['info']);

    if (in_array('submit', $keys)){
        unset($_SESSION['info']['submit']);
    }
    header("Location:index.php");
    echo "<pre>";
    print_r($_SESSION['info']);
    echo "</pre>";
}

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/index-style.css"> -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700&display=swap"
    rel="stylesheet">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>


  <div class="container step step-2 renter">
    <div class="title">Registration/Renter</div>
    <div class="content">
      <form action="#" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Desired move in date</span>
            <input type="date" id="moveIn" name="moveIn" placeholder="Enter date" required value="<?= isset($_SESSION['info']['moveIn'])
            ? $_SESSION['info']['moveIn']: '' ?>">
          </div>
          <div class="input-box">
            <span class="details">Preferred location</span>
            <input type="text" id="location" name="location" placeholder="Enter preferred location" required value="<?= isset($_SESSION['info']['location'])
            ? $_SESSION['info']['location']: '' ?>">
          </div>
          <div class="input-box">
            <span class="details">Budget</span>
            <input type="number" id="budget" name="budget" placeholder="Enter your budget" required value="<?= isset($_SESSION['info']['budget'])
            ? $_SESSION['info']['budget']: '' ?>">
          </div>
          <div class="creditCard">
          <span>Credit Card information</span>
          </div>
          <div class="input-box">
            <span class="details">Credit Card Number</span>
            <input type="text" id="cCard" name="cCard" placeholder="Enter your Credit Card" required value="<?= isset($_SESSION['info']['cCard'])
            ? $_SESSION['info']['cCard']: '' ?>">
          </div>
          <div class="input-box">
            <span class="details">Expiration Date</span>
            <input type="date" id="ccDate" name="ccDate" placeholder="CC Expiration date" required value="<?= isset($_SESSION['info']['ccDate'])
            ? $_SESSION['info']['ccDate']: '' ?>">
          </div>
          <div class="input-box">
            <span class="details">CVV</Address></span>
            <input type="text" id="cvv" name="cvv" placeholder="Enter your CVV" required value="<?= isset($_SESSION['info']['cvv'])
            ? $_SESSION['info']['cvv']: '' ?>">
          </div>
        </div>
      <div class="arrow">
      <a href="signup.php" id="previousRenter" class="previous">&laquo; Previous</a>
      <!-- <input class="previous sub" id="previousRenter" type="submit" value="Previous" name="prev"> -->
      </div>
        <div class="button">
        <input type="hidden" name="form_submitted" value="1">
          <input type="submit" name="submit" value="Register">
        </div>
        <div class="signup">
            <span class="signup">Already have an account?
             <label for="check">  <a href="login.php">Login</a></label>
            </span>
          </div>
      </form>
    </div>
  </div>




  <!-- <script src="js/signup.js"></script> -->
</body>
</html>

<?php
  $conn->close();
?>
