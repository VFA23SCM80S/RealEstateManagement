<?php
  session_start();
  include 'db_connect.php';
if (isset($_POST['next'])){
    foreach($_POST as $key => $value)
    {
        $_SESSION['info'][$key] = $value;
    }

    $keys = array_keys($_SESSION['info']);

    if (in_array('next', $keys)){
        unset($_SESSION['info']['next']);
    }


 // Check the value of the selected dropdown option and redirect accordingly
 if (isset($_SESSION['info']['userType'])) {
    if ($_SESSION['info']['userType'] === 'renter') {
        header("Location:signup_renter.php");
    } elseif ($_SESSION['info']['userType'] === 'agent') {
        header("Location:signup_agent.php");
    }
}

// header("Location:signup_renter.php");
    echo "<pre>";
    print_r($_SESSION['info']);
    echo "</pre>";
}

//   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $f_name = trim($_POST['fname']);
//     $m_name = trim($_POST['mname']);
//     $l_name = trim($_POST['lname']);
//     $email = trim($_POST['email']);
//     $address = trim($_POST['address']);
//     $phone = trim($_POST['phone']);
//     $userType = trim($_POST['userType']);

//     $moveIn = trim($_POST['moveIn']);
//     $location = trim($_POST['location']);
//     $budget = trim($_POST['budget']);
//     $cCard = trim($_POST['cCard']);
//     $ccDate = trim($_POST['ccDate']);
//     $cvv = trim($_POST['cvv']);

//     $job = trim($_POST['job']);
//     $agency = trim($_POST['agency']);


//     if (empty($f_name) || empty($l_name) || empty($email) || empty($address) || empty($phone)) {
//         echo "Please fill in all required fields.";
//     } 

// }

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
  <div class="container step step-1 active">
    <div class="title">Registration</div>
    <div class="content">
      <form action="#" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" id="fname" name="fname" placeholder="Enter your name" required value="<?= isset($_SESSION['info']['fname'])
            ? $_SESSION['info']['fname']: '' ?>">
          </div>
          <div class="input-box">
            <span class="details">Middle Name</span>
            <input type="text" id="mname" name="mname" placeholder="Enter your middle name" required value="<?= isset($_SESSION['info']['mname'])
            ? $_SESSION['info']['mname']: '' ?>">
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" id="lname" name="lname" placeholder="Enter your last name" required value="<?= isset($_SESSION['info']['lname'])
            ? $_SESSION['info']['lname']: '' ?>">
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" id="email" name="email" placeholder="Enter your email" required value="<?= isset($_SESSION['info']['email'])
            ? $_SESSION['info']['email']: '' ?>">
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" id="phone" name="phone" placeholder="Enter your number" required value="<?= isset($_SESSION['info']['phone'])
            ? $_SESSION['info']['phone']: '' ?>">
          </div>
          <div class="input-box">
            <span class="details">Address</Address></span>
            <input type="text" id="address" name="address" placeholder="Enter your address" required value="<?= isset($_SESSION['info']['address'])
            ? $_SESSION['info']['address']: '' ?>">
          </div>
          <div class="input-box input-wrapper">
            <label for="rent" class="details">Agent/Renter:</label>
            <select name="userType" id="userType" class="dropdown-list" required value="<?= isset($_SESSION['info']['userType'])
            ? $_SESSION['info']['userType']: '' ?>">
            <option value="renter">Renter</option>
            <option value="agent">Agent</option>
            </select>
          </div>
        </div>
      <div class="arrow">
        <!-- <a href="#" class="next">Next &raquo;</a> -->
        <input class="next sub" type="submit" value="Next" name="next">
      </div>
        <div class="signup">
            <span class="signup">Already have an account?
             <label for="check">  <a href="login.php">Login</a></label>
            </span>
          </div>
      </form>
    </div>
  </div>
  <div>
    
  </div>
  <!-- <script src="js/signup.js"></script> -->
</body>
</html>

<?php
  $conn->close();
?>
