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

  <div class="container step step-2 agent">
    <div class="title">Registration/Agent</div>
    <div class="content">
      <form action="#" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Job Title</span>
            <input type="text" id="job" name="job" placeholder="Enter your job title" required value="<?= isset($_SESSION['info']['job'])
            ? $_SESSION['info']['job']: '' ?>">
          </div>
          <div class="input-box input-wrapper">
            <label for="rent" class="details">Agency</label>
            <select name="agency" id="agency" class="dropdown-list" value="<?= isset($_SESSION['info']['agency'])
            ? $_SESSION['info']['agency']: '' ?>">
            <?php
            $sql = "SELECT AgencyID FROM Agent";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['AgencyID'] . '">' . $row['AgencyID'] . '</option>';
                }
            }
            ?>
            </select>
          </div>
        </div>
      <div class="arrow">
      <a href="signup.php" id="previousAgent" class="previous">&laquo; Previous</a>
      <!-- <input class="previous sub" id="previousAgent" type="submit" value="Previous" name="prev"> -->
      </div>
        <div class="button">
        <input type="hidden" name="form_submitted" value="1">
          <input type="submit"  name="submit" value="Register">
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
