<?php

  session_start();
  include 'db_connect.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (empty($name) || empty($email)) {
        echo "Please fill in both fields.";
    } else {
        $sql = "SELECT * FROM user WHERE FirstName = ? AND EmailAddress = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name, $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          // Fetch the user_id from the result set
          $row = $result->fetch_assoc();
          $user_id = $row['User_ID'];
          // Save the user_id in the session variable
          $_SESSION['user_id'] = $user_id;
      }


        if ($result->num_rows > 0) {
            // Successful login
            $_SESSION['message'] = "Login successful!";
            $_SESSION['name'] = $name; //displays the name and email
            $_SESSION['email'] = $email;
            header("Location: index.php");
            exit;
        } else {
            // Invalid credentials
            $_SESSION['login_error'] = "Invalid name or email.";
            header("Location: login.php");
            exit;
        }

        $stmt->close();
    }
}







$conn->close();

?>


<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="css/style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Log in</div>
    <div class="content">
    <?php
if (isset($_SESSION['login_error'])) {
    echo '<p class="error">' . $_SESSION['login_error'] . '</p>';
    unset($_SESSION['login_error']);
}
?>
      <form action="login.php" method="post">
        <div class="user-details">
            <!-- <form method= "POST" action="#"></form> -->
          <div class="input-box">
            <span class="details">Name</span>
            <input type="text" name="name" placeholder="Enter your Name" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="email" placeholder="Enter your email" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Submit">
        </div>
        <div class="signup">
            <span class="signup">Don't have an account?
             <label for="check"><a href="signup.php">Sign up</a></label>
            </span>
          </div>
      </form>
    </div>
  </div>

</body>
</html>
