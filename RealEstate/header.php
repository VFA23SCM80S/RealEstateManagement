<?php  
      session_start();
      include 'db_connect.php';
      if (isset($_SESSION['user_id'])) {
 echo $_SESSION['user_id'] ;


 if (isset($_SESSION['user_id'])) {
  
  // Escape the user_id to prevent SQL injection
  $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

  // Query the database to retrieve user data
$sql = "SELECT * FROM User WHERE User_ID = '$user_id'";
  $result = mysqli_query($conn, $sql);

  // Check if the query is successful
  if (mysqli_num_rows($result) > 0) {
      // User data is retrieved successfully
      $user_data = mysqli_fetch_assoc($result);

      // Access the user data
      // echo "User ID: " . $user_data['User_ID'] . "<br>";
      // echo "CreditCard: " . $user_data['CreditCardNumber'] . "<br>";
      // echo "Email: " . $user_data['Address'] . "<br>";
      // Add other user data fields as needed
  } else {
      echo "User not found";
  }

  // Close the database connection
  mysqli_close($conn);
} 

      } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <!-- <link rel="stylesheet" href="style.css"> -->
  <link rel="stylesheet" href="css/index-style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700&display=swap"
    rel="stylesheet">
</head>
<body>
<header class="header" data-header>
    <div class="container">

      <a href="index.php" class="logo">
        <ion-icon name="business-outline"></ion-icon> RealHome
      </a>

      <nav class="navbar container" data-navbar>
        <ul class="navbar-list">

          <li>
            <a href="index.php" class="navbar-link" data-nav-link>Home</a>
          </li>

          <li>
            <a href="#" class="navbar-link" data-nav-link>Buy</a>
          </li>

          <li>
            <a href="#" class="navbar-link" data-nav-link>Rent</a>
          </li>

          <li>
            <a href="#" class="navbar-link" data-nav-link>Listing</a>
          </li>

          <li>
            <a href="#" class="navbar-link" data-nav-link>About Us</a>
          </li>

          <!-- <li>
            <a href="#" class="navbar-link" data-nav-link>Contact</a>
          </li> -->

        </ul>
      </nav>

      <a href="profile.php" class="btn btn-secondary"><?php echo $user_data['FirstName'] ?></a>
      <!-- <a href="signup.php" class="btn btn-secondary">Signup</a> -->

      <button class="nav-toggle-btn" aria-label="Toggle menu" data-nav-toggler>
        <ion-icon name="menu-outline" aria-hidden="true" class="menu-icon"></ion-icon>
        <ion-icon name="close-outline" aria-hidden="true" class="close-icon"></ion-icon>
      </button>

    </div>
  </header>


  <!-- 
    - custom js link
  -->
  <script src="js/script.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>