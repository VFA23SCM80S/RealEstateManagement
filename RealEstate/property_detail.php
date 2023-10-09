<?php
session_start();
include 'db_connect.php';


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   $property_id = $_POST["property_id"];
  
//   // Retrieve the property details from the database based on the property ID
//   $sql = "SELECT * FROM Property WHERE PropertyID = ?";
//   $stmt = $conn->prepare($sql);
//   $stmt->bind_param("i", $property_id);
//   $stmt->execute();
//   $result = $stmt->get_result();

//   if ($result->num_rows > 0) {
//       $row = $result->fetch_assoc();

//       // Insert the data into the booking table
//       $sql_insert = "INSERT INTO Booking (PropertyID, BuildingType, No_of_rooms, SquareFootage, TypeOfBusiness, Description, Price, City, State, StreetAddress, ZipCode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
//       $stmt_insert = $conn->prepare($sql_insert);
//       $stmt_insert->bind_param("isiidisdiss", $property_id, $row["BuildingType"], $row["No_of_rooms"], $row["SquareFootage"], $row["TypeOfBusiness"], $row["Description"], $row["Price"], $row["City"], $row["State"], $row["StreetAddress"], $row["ZipCode"]);

//       if ($stmt_insert->execute()) {
//           echo "Booking created successfully";
//       } else {
//           echo "Error: " . $sql_insert . "<br>" . $conn->error;
//       }
//   }
// }



?>

<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");
?>

							
<!-- FOR MORE PROJECTS visit: codeastro.com -->
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta Tags -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Real Estate PHP">
<meta name="keywords" content="">
<meta name="author" content="Unicoder">
<link rel="stylesheet" href="css/property-detail.css">

<!--	Fonts
	========================================================-->
<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

<title>Real Estate PHP</title>
</head>
<body>

<div id="page-wrapper">
<button onclick="window.location.href='index.php'" class="btn btn-primary back-button" style="    position: absolute;
    margin-top: 105px;
    margin-left: 248px;">Go back</button>

    <div class="row"> 
        <!--	Header start  -->
		<?php include("header.php");?>
        <!--	Header end  -->


        <?php
        session_start();
        include 'db_connect.php';
if (isset($_GET['PropertyID'])) {
    $property_id = $_GET['PropertyID'];
    $_SESSION['current_property_id'] = $property_id;
  
    // Retrieve the property details from the database based on the property ID
    $sql = "SELECT * FROM property WHERE PropertyID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
  
    if ($result->num_rows > 0) {
      // Fetch and display the property details
      $row = $result->fetch_assoc();
  ?>

        <main class="container property">
        <div class="top">

            <h1><?php echo $row['BuildingType'] ?></h1>
        </div>
  <!-- Left Column / Headphones Image -->
  <div class="left-column">
    <img data-image="red" class="active" src="images/property-1.jpg" alt="">
  </div>
 
 
  <!-- Right Column -->
  <div class="right-column">
 
  <div class="card-list">
  <div class="card-item desc">
    <!-- <ion-icon name="cube-outline"></ion-icon>  -->
    <h3>Description</h3>
  <span class="item-text"> <?php echo $row['Description'] ?></span>
</div>

  <div class="card-item">
  <div class="item-icon">
    <!-- <ion-icon name="cube-outline"></ion-icon>  -->
    <span>Number of rooms:</span>
  </div>
  <span class="item-text"><?php echo $row['No_of_rooms'] ?></span>
</div>

<div class="card-item">
  <div class="item-icon">
    <!-- <ion-icon name="cube-outline"></ion-icon> -->
    <span>Square footage:</span>
  </div>
  <span class="item-text"><?php echo $row['SquareFootage'] ?>sqf</span>
</div>

<div class="card-item">
  <div class="item-icon">
    <!-- <ion-icon name="bed-outline"></ion-icon> -->
    <span>Type of business:</span>
  </div>
  <span class="item-text"><?php echo $row['TypeOfBusiness'] ?></span>
</div>

<div class="card-item">
  <div class="item-icon">
    <span>Price</span>
  </div>
  <span class="item-text">$<?php echo $row['Price'] ?></span>
</div>
<div class="card-item">
  <div class="item-icon">
    <span>City</span>
  </div>
  <span class="item-text"><?php echo $row['City'] ?></span>
</div>
<div class="card-item">
  <div class="item-icon">
    <span>State</span>
  </div>
  <span class="item-text"><?php echo $row['State'] ?></span>
</div>
<div class="card-item">
  <div class="item-icon">
    <span>Street Address</span>
  </div>
  <span class="item-text"><?php echo $row['StreetAddress'] ?></span>
</div>
<div class="card-item">
  <div class="item-icon">
    <span>Zip Code</span>
  </div>
  <span class="item-text"><?php echo $row['ZipCode'] ?></span>
</div>


</div>


<!-- <form action="" method="post"> -->
<!-- <form action=""> -->
    <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
    <div class="buttons">
        <button onclick="window.location.href='booking.php'" class="btn btn-primary button-inline">Book</button>
        <button class="btn btn-primary button-inline">Edit</button>
        <button class="btn btn-primary button-inline">Delete</button>
    </div>
<!-- </form> -->
  </div>

</main>
<?php
      // Display the property details in the property_detail.php page
    //   echo "Property ID: " . $row['PropertyID'] . "<br>";
    //   echo "Description: " . $row['Description'] . "<br>";
      // Display other property details as needed
    } else {
      echo "Property not found.";
    }
  
    $stmt->close();
  }
?>
        
        <!--	Footer   start-->
		<?php include("footer.php");?>
		<!--	Footer   start-->
        
        <!-- Scroll to top --> 
        <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a> 
        <!-- End Scroll To top --> 
    </div>
</div>
<!-- Wrapper End --> 

<script src="js/property-detail.js"></script>
</body>

</html>