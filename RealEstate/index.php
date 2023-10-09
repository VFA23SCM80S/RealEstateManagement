<?php
session_start();
include 'db_connect.php';

if (isset($_SESSION['info'])) {

  extract($_SESSION['info']);

  if ($_SESSION['info']['userType'] === 'agent') {
    // Insert data into Agent table
    $sql = mysqli_query($conn, "INSERT  INTO User (PhoneNumber, Address, EmailAddress, FirstName, 
      MiddleName, LastName) VALUES ('$phone', '$address', '$email', '$fname', '$mname', '$lname') ");
    $user_id = mysqli_insert_id($conn);
    $_SESSION['user_id'] = $user_id;

    $sql = mysqli_query($conn, "INSERT  INTO Agent (JobTitle, EmailAddress, PhoneNumber, AgencyID, 
      FirstName, MiddleName, LastName) VALUES ('$job', '$email', '$phone', '$agency', '$fname', '$mname', '$lname') ");

    $sql = mysqli_query($conn, "INSERT  INTO User_Address (UserID, Address) 
      VALUES ('$user_id', '$address') ");
  } else if ($_SESSION['info']['userType'] === 'renter') {
    $sql = mysqli_query($conn, "INSERT  INTO Renter (Address, Budget, PreferredLocation, PhoneNumber, 
      DesiredMoveInDate, FirstName, MiddleName, LastName) VALUES ('$address', '$budget', '$location', '$phone', '$moveIn', '$fname', '$mname', '$lname') ");

    // Get the last inserted Renter ID
    $renter_id = mysqli_insert_id($conn);

    $sql = mysqli_query($conn, "INSERT  INTO User (PhoneNumber, Address, EmailAddress, FirstName, 
      MiddleName, LastName) VALUES ('$phone', '$address', '$email', '$fname', '$mname', '$lname') ");

    // Get the last inserted User ID
    $user_id = mysqli_insert_id($conn);
    $_SESSION['user_id'] = $user_id;

    $sql = mysqli_query($conn, "INSERT  INTO CreditCard (CreditCardNumber, User_ID, CVV, ExpirationDate, RenterID) 
      VALUES ('$cCard', '$user_id', '$cvv', '$ccDate', '$renter_id') ");

    $sql = mysqli_query($conn, "INSERT  INTO User_Address (UserID, Address) 
      VALUES ('$user_id', '$address') ");
  }


  if (isset($_SESSION['info'])) {

    // Your existing form processing code...

    if($sql){
        // Clear the session data after saving the data to the database
        unset($_SESSION['info']);

        // Redirect the user to another page or the same page
        header("Location: index.php"); // Replace "success.php" with the desired destination page
        exit;
    }else{
        echo mysqli_errno($conn);
    }
}


  // $sql = mysqli_query($conn, "INSERT  INTO User (PhoneNumber, Address, EmailAddress, FirstName, 
  // MiddleName, LastName) VALUES ('$phone', '$address', '$email', '$fname', '$mname', '$lname') ");

  // if($sql){
  //     unset($_SESSION['info']);
  //     echo "Data has been saved sucessfully!";
  // }else{
  //     echo mysqli_errno($conn);
  // }

  // echo $email;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Realhome - Choose your dream place</title>

  <!-- 
    - favicon
  -->
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
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->
  <?php include("header.php"); ?>


  <!-- <header class="header" data-header>
    <div class="container">

      <a href="#" class="logo">
        <ion-icon name="business-outline"></ion-icon> RealHome
      </a>

      <nav class="navbar container" data-navbar>
        <ul class="navbar-list">

          <li>
            <a href="#" class="navbar-link" data-nav-link>Home</a>
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

          <li>
            <a href="#" class="navbar-link" data-nav-link>Contact</a>
          </li>

        </ul>
      </nav>

      <a href="signup.php" class="btn btn-secondary">Signup</a>

      <button class="nav-toggle-btn" aria-label="Toggle menu" data-nav-toggler>
        <ion-icon name="menu-outline" aria-hidden="true" class="menu-icon"></ion-icon>
        <ion-icon name="close-outline" aria-hidden="true" class="close-icon"></ion-icon>
      </button>

    </div>
  </header> -->

  <main>
    <article class="article">

      <!-- 
        - #HERO
      -->

      <section class="section hero" aria-label="hero">
        <div class="container">

          <div class="hero-bg">
            <div class="hero-content">

              <h1 class="h1 hero-title">
                We will help you find your <span class="span">Wonderful</span> home
              </h1>

              <p class="hero-text">
                A great plateform to buy and rent any properties that fits best for you.
              </p>

            </div>
          </div>

          <div class="hero-form-wrapper">
            <!-- <div class="form-tab">

              <button class="tab-btn active" data-tab-btn>Purchase</button>
              <button class="tab-btn" data-tab-btn>Rent</button>

            </div> -->

            <form action="index.php" class="hero-form" method="POST">
              <!-- 
              <div class="input-wrapper">

                <label for="search" class="input-label">Search : *</label>

                <input type="search" name="search" id="search" placeholder="Search your home" 
                  class="input-field">

                <ion-icon name="search-outline"></ion-icon>

              </div> -->
              <div class="input-wrapper">
                <label for="rent_sale" class="input-label">Sale / Rent:</label>

                <select name="rent_sale" id="rent_sale" class="dropdown-list">
                  <option value="Select">Select</option>
                  <option value="sale">Sale</option>
                  <option value="rent">Rent</option>
                </select>
              </div>
              <div class="input-wrapper">
                <label for="location" class="input-label">Location:</label>
                <select name="location" id="location" class="dropdown-list">
                <option value="Select">Select</option>
                <?php
                // SQL query to retrieve unique locations
                include 'db_connect.php';
                $sql = "SELECT DISTINCT City FROM Property";
                $result = mysqli_query($conn, $sql);

                // Loop through the result set to create option tags
                while ($row = mysqli_fetch_assoc($result)) {
                  $location = $row['City'];
                  echo "<option value=\"$location\">$location</option>";
                }
                ?>
                 <!-- <option value="Select">Select</option>
                  <option value="sale">Sale</option>
                  <option value="rent">Rent</option> -->
                </select>
              </div>

              <div class="input-wrapper">
                <label for="category" class="input-label">Select Building type:</label>

                <select name="category" id="category" class="dropdown-list">
                <option value="Select">Select</option>
                <?php
                // SQL query to retrieve unique locations
                include 'db_connect.php';
                $sql = "SELECT DISTINCT BuildingType FROM Property";
                $result = mysqli_query($conn, $sql);

                // Loop through the result set to create option tags
                while ($row = mysqli_fetch_assoc($result)) {
                  $location = $row['BuildingType'];
                  echo "<option value=\"$location\">$location</option>";
                }
                ?>
                  <option value="Select">Select</option>
                  <!-- <option value="house">House</option>
                  <option value="apartment">Apartment</option>
                  <option value="offices">Commercial Buildings</option> -->
                </select>
              </div>

              <!-- 
              <div class="input-wrapper">
                <label for="rent" class="input-label">Rent/Purchase:</label>

                <select name="rent" id="rent" class="dropdown-list">

                  <option value="Rent">Rent</option>
                  <option value="Purchase">Purchase</option>
                </select>
              </div> -->

              <div class="input-wrapper">
                <label for="price" class="input-label">Price :</label>

                <select name="price" id="price" class="dropdown-list">
                  <option value="Select" selected>Select</option>
                  <?php
                // SQL query to retrieve unique locations
                include 'db_connect.php';
                $sql = "SELECT DISTINCT Price FROM Property ORDER BY Price ASC";
                $result = mysqli_query($conn, $sql);

                // Loop through the result set to create option tags
                while ($row = mysqli_fetch_assoc($result)) {
                  $location = $row['Price'];
                  echo "<option value=\"$location\">$location</option>";
                }
                ?>
                  <!-- <option value="400">400</option>
                  <option value="500">500</option>
                  <option value="1000">1000</option>
                  <option value="1500">1500</option>
                  <option value="2000">2000</option>
                  <option value="3000">3000</option>
                  <option value="4000">4000</option>
                  <option value="5000">5000</option>
                  <option value="6000">6000</option> -->

                </select>
              </div>

              <div class="input-wrapper">
                <label for="room_num" class="input-label">Number of rooms :</label>

                <select name="room_num" id="room_num" class="dropdown-list">
                  <option value="Select" selected>Select</option>
                  <?php
                // SQL query to retrieve unique locations
                include 'db_connect.php';
                $sql = "SELECT DISTINCT No_of_rooms FROM Property";
                $result = mysqli_query($conn, $sql);

                // Loop through the result set to create option tags
                while ($row = mysqli_fetch_assoc($result)) {
                  $location = $row['No_of_rooms'];
                  echo "<option value=\"$location\">$location</option>";
                }
                ?>
                  <!-- <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option> -->
                </select>
              </div>
              <div class="input-wrapper">
                <label for="category" class="input-label">Date:</label>
                <input type="date" name="date" id="date" class="input-field">
                <!-- <select name="category" id="category" class="dropdown-list">
                 <option value="Select">Select</option>
                  <option value="house">House</option>
                  <option value="apartment">Apartment</option>
                  <option value="offices">Commercial Buildings</option>
                </select> -->
              </div>

              <button type="submit" name="submit" class="btn btn-primary">Search now</button>

            </form>
          </div>

        </div>
      </section>

      <!-- 
        - #PROPERTY
      -->

      <section class="section property" aria-label="property">
        <div class="container">
        <button onclick="window.location.href='add_property.php'" name="submit" class="btn btn-primary" style="position: absolute; top: 886px;
    left: 1384px;">Add Property</button>
          <h2 class="h2 section-title">Featured Properties</h2>

          <p class="section-text">
            A great plateform to buy and rent any propertie.
          </p>

          <ul class="property-list">


            <?php
            session_start();
            include 'db_connect.php';
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              // Collect form data
              $search = $_POST['search'];
              $room_num = $_POST['room_num'];
              $price = $_POST['price'];
              $category = $_POST['category'];
              $location = $_POST['location'];
              // echo "Search: " . $search . ", Room number: " . $room_num . "Price: ".$price."<br>";



              if (!empty($search)) {
                $sql = "SELECT * FROM property WHERE No_of_rooms = ? AND BuildingType = ? AND Price = ? AND City = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isss", $room_num, $category, $price, $location);
            } else if ($room_num === "Select") {
                if ($price === "Select") {
                    if ($category === "Select") {
                        if ($location === "Select") {
                            $sql = "SELECT * FROM property";
                            $stmt = $conn->prepare($sql);
                        } else {
                            $sql = "SELECT * FROM property WHERE City = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $location);
                        }
                    } else {
                        if ($location === "Select") {
                            $sql = "SELECT * FROM property WHERE BuildingType = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $category);
                        } else {
                            $sql = "SELECT * FROM property WHERE BuildingType = ? AND City = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ss", $category, $location);
                        }
                    }
                } else {
                    if ($category === "Select") {
                        if ($location === "Select") {
                            $sql = "SELECT * FROM property WHERE Price = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $price);
                        } else {
                            $sql = "SELECT * FROM property WHERE Price = ? AND City = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("is", $price, $location);
                        }
                    } else {
                        if ($location === "Select") {
                            $sql = "SELECT * FROM property WHERE Price = ? AND BuildingType = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("is", $price, $category);
                        } else {
                            $sql = "SELECT * FROM property WHERE Price = ? AND BuildingType = ? AND City = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("iss", $price, $category, $location);
                        }
                    }
                }
            } else if ($price === "Select") {
                if ($category === "Select") {
                    if ($location === "Select") {
                        $sql = "SELECT * FROM property WHERE No_of_rooms = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $room_num);
                    } else {
                        $sql = "SELECT * FROM property WHERE No_of_rooms = ? AND City = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("is", $room_num, $location);
                    }
                } else {
                    if ($location === "Select") {
                        $sql = "SELECT * FROM property WHERE No_of_rooms = ? AND BuildingType = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("is", $room_num, $category);
                    } else {
                        $sql = "SELECT * FROM property WHERE No_of_rooms = ? AND BuildingType = ? AND City = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("iss", $room_num, $category, $location);
                    }
                }
            }

              $stmt->execute();
              $result = $stmt->get_result();
              // Further code to fetch and process the result...

              // Display search results
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  //  echo "Description: " . $row["description"] . ", Number of rooms: " . $row["No_of_rooms"] . ", Price: " . $row["Price"] . ", Square footage: " . $row["SquareFootage"]. ", Type of building: " . $row["BuildingType"]."<br>";

            ?>


                  <li>
                    <a href="property_detail.php?PropertyID=<?php echo $row['PropertyID']; ?>">
                      <div class="property-card">
                        <figure class="card-banner img-holder" style="--width: 800; --height: 533;">
                          <img src="images/property-1.jpg" width="800" height="533" loading="lazy" alt="10765 Hillshire Ave, Baton Rouge, LA 70810, USA" class="img-cover">
                        </figure>

                        <button class="card-action-btn" aria-label="add to favourite">
                          <ion-icon name="heart" aria-hidden="true"></ion-icon>
                        </button>

                        <div class="card-content">
                          <h3 class="h3">
                            <a href="#" class="card-title"><?php echo $row["City"] . ", " . $row["State"]; ?></a>
                          </h3>
                          <ul class="card-list">
                            <li class="card-item">
                              <div class="item-icon">
                                <ion-icon name="cube-outline"></ion-icon>
                              </div>
                              <span class="item-text"><?php echo $row["SquareFootage"]; ?></span>
                            </li>
                            <li class="card-item">
                              <div class="item-icon">
                                <ion-icon name="bed-outline"></ion-icon>
                              </div>
                              <span class="item-text"><?php echo $row["No_of_rooms"]; ?></span>
                            </li>
                            <li class="card-item">
                              <div class="item-icon">
                                <ion-icon name="man-outline"></ion-icon>
                              </div>
                              <span class="item-text"><?php echo $row["Availability"]; ?></span>
                            </li>
                          </ul>
                          <div class="card-meta">
                            <div>
                              <span class="meta-title">Price</span>
                              <span class="meta-text">$<?php echo $row["Price"]; ?></span>
                            </div>
                            <div>
                              <span class="meta-title">Rating</span>
                              <span class="meta-text">
                                <div class="rating-wrapper">
                                  <ion-icon name="star"></ion-icon>
                                  <ion-icon name="star"></ion-icon>
                                  <ion-icon name="star"></ion-icon>
                                  <ion-icon name="star"></ion-icon>
                                  <ion-icon name="star"></ion-icon>
                                </div>
                                <span>5.0(30)</span>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </li>

            <?php
                }
              } else {
                echo "0 results found.";
              }

              // Close the connection
              $stmt->close();
              //  $conn->close();
            }

            ?>




            <!-- <li>
              <a href="property_detail.php">
              <div class="property-card">

                <figure class="card-banner img-holder" style="--width: 800; --height: 533;">
                  <img src="images/property-1.jpg" width="800" height="533" loading="lazy"
                    alt="10765 Hillshire Ave, Baton Rouge, LA 70810, USA" class="img-cover">
                </figure>

                <button class="card-action-btn" aria-label="add to favourite">
                  <ion-icon name="heart" aria-hidden="true"></ion-icon>
                </button>

                <div class="card-content">

                  <h3 class="h3">
                    <a href="#" class="card-title">10765 Hillshire Ave, Baton Rouge, LA 70810, USA</a>
                  </h3>

                  <ul class="card-list">

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="cube-outline"></ion-icon>
                      </div>

                      <span class="item-text">8000sqf</span>
                    </li>

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="bed-outline"></ion-icon>
                      </div>

                      <span class="item-text">4 Beds</span>
                    </li>

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="man-outline"></ion-icon>
                      </div>

                      <span class="item-text">4 Baths</span>
                    </li>

                  </ul>

                  <div class="card-meta">

                    <div>
                      <span class="meta-title">Price</span>

                      <span class="meta-text">$5000</span>
                    </div>

                    <div>
                      <span class="meta-title">Rating</span>

                      <span class="meta-text">

                        <div class="rating-wrapper">
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                        </div>

                        <span>5.0(30)</span>

                      </span>
                    </div>

                  </div>

                </div>

              </div>
              </a>
            </li> -->

            <!-- <li>
              <div class="property-card">

                <figure class="card-banner img-holder" style="--width: 800; --height: 533;">
                  <img src="images/property-2.jpg" width="800" height="533" loading="lazy"
                    alt="59345 STONEWALL DR, Plaquemine, LA 70764, USA" class="img-cover">
                </figure>

                <button class="card-action-btn" aria-label="add to favourite">
                  <ion-icon name="heart" aria-hidden="true"></ion-icon>
                </button>

                <div class="card-content">

                  <h3 class="h3">
                    <a href="#" class="card-title">59345 STONEWALL DR, Plaquemine, LA 70764, USA</a>
                  </h3>

                  <ul class="card-list">

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="cube-outline"></ion-icon>
                      </div>

                      <span class="item-text">8000sqf</span>
                    </li>

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="bed-outline"></ion-icon>
                      </div>

                      <span class="item-text">4 Beds</span>
                    </li>

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="man-outline"></ion-icon>
                      </div>

                      <span class="item-text">4 Baths</span>
                    </li>

                  </ul>

                  <div class="card-meta">

                    <div>
                      <span class="meta-title">Price</span>

                      <span class="meta-text">$5000</span>
                    </div>

                    <div>
                      <span class="meta-title">Rating</span>

                      <span class="meta-text">

                        <div class="rating-wrapper">
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                        </div>

                        <span>5.0(30)</span>

                      </span>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="property-card">

                <figure class="card-banner img-holder" style="--width: 800; --height: 533;">
                  <img src="images/property-3.jpg" width="800" height="533" loading="lazy"
                    alt="3723 SANDBAR DR, Addis, LA 70710, USA" class="img-cover">
                </figure>

                <button class="card-action-btn" aria-label="add to favourite">
                  <ion-icon name="heart" aria-hidden="true"></ion-icon>
                </button>

                <div class="card-content">

                  <h3 class="h3">
                    <a href="#" class="card-title">3723 SANDBAR DR, Addis, LA 70710, USA</a>
                  </h3>

                  <ul class="card-list">

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="cube-outline"></ion-icon>
                      </div>

                      <span class="item-text">8000sqf</span>
                    </li>

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="bed-outline"></ion-icon>
                      </div>

                      <span class="item-text">4 Beds</span>
                    </li>

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="man-outline"></ion-icon>
                      </div>

                      <span class="item-text">4 Baths</span>
                    </li>

                  </ul>

                  <div class="card-meta">

                    <div>
                      <span class="meta-title">Price</span>

                      <span class="meta-text">$5000</span>
                    </div>

                    <div>
                      <span class="meta-title">Rating</span>

                      <span class="meta-text">

                        <div class="rating-wrapper">
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                        </div>

                        <span>5.0(30)</span>

                      </span>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="property-card">

                <figure class="card-banner img-holder" style="--width: 800; --height: 533;">
                  <img src="images/property-4.jpg" width="800" height="533" loading="lazy"
                    alt="LOT 21 ROYAL OAK DR, Prairieville, LA 70769, USA" class="img-cover">
                </figure>

                <button class="card-action-btn" aria-label="add to favourite">
                  <ion-icon name="heart" aria-hidden="true"></ion-icon>
                </button>

                <div class="card-content">

                  <h3 class="h3">
                    <a href="#" class="card-title">LOT 21 ROYAL OAK DR, Prairieville, LA 70769, USA</a>
                  </h3>

                  <ul class="card-list">

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="cube-outline"></ion-icon>
                      </div>

                      <span class="item-text">8000sqf</span>
                    </li>

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="bed-outline"></ion-icon>
                      </div>

                      <span class="item-text">4 Beds</span>
                    </li>

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="man-outline"></ion-icon>
                      </div>

                      <span class="item-text">4 Baths</span>
                    </li>

                  </ul>

                  <div class="card-meta">

                    <div>
                      <span class="meta-title">Price</span>

                      <span class="meta-text">$5000</span>
                    </div>

                    <div>
                      <span class="meta-title">Rating</span>

                      <span class="meta-text">

                        <div class="rating-wrapper">
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                        </div>

                        <span>5.0(30)</span>

                      </span>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="property-card">

                <figure class="card-banner img-holder" style="--width: 800; --height: 533;">
                  <img src="images/property-5.jpg" width="800" height="533" loading="lazy"
                    alt="710 BOYD DR, Unit #1102, Baton Rouge, LA 70808, USA" class="img-cover">
                </figure>

                <button class="card-action-btn" aria-label="add to favourite">
                  <ion-icon name="heart" aria-hidden="true"></ion-icon>
                </button>

                <div class="card-content">

                  <h3 class="h3">
                    <a href="#" class="card-title">710 BOYD DR, Unit #1102, Baton Rouge, LA 70808, USA</a>
                  </h3>

                  <ul class="card-list">

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="cube-outline"></ion-icon>
                      </div>

                      <span class="item-text">8000sqf</span>
                    </li>

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="bed-outline"></ion-icon>
                      </div>

                      <span class="item-text">4 Beds</span>
                    </li>

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="man-outline"></ion-icon>
                      </div>

                      <span class="item-text">4 Baths</span>
                    </li>

                  </ul>

                  <div class="card-meta">

                    <div>
                      <span class="meta-title">Price</span>

                      <span class="meta-text">$5000</span>
                    </div>

                    <div>
                      <span class="meta-title">Rating</span>

                      <span class="meta-text">

                        <div class="rating-wrapper">
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                        </div>

                        <span>5.0(30)</span>

                      </span>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="property-card">

                <figure class="card-banner img-holder" style="--width: 800; --height: 533;">
                  <img src="images/property-6.jpg" width="800" height="533" loading="lazy"
                    alt="5133 MCLAIN WAY, Baton Rouge, LA 70809, USA" class="img-cover">
                </figure>

                <button class="card-action-btn" aria-label="add to favourite">
                  <ion-icon name="heart" aria-hidden="true"></ion-icon>
                </button>

                <div class="card-content">

                  <h3 class="h3">
                    <a href="#" class="card-title">5133 MCLAIN WAY, Baton Rouge, LA 70809, USA</a>
                  </h3>

                  <ul class="card-list">

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="cube-outline"></ion-icon>
                      </div>

                      <span class="item-text">8000sqf</span>
                    </li>

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="bed-outline"></ion-icon>
                      </div>

                      <span class="item-text">4 Beds</span>
                    </li>

                    <li class="card-item">
                      <div class="item-icon">
                        <ion-icon name="man-outline"></ion-icon>
                      </div>

                      <span class="item-text">4 Baths</span>
                    </li>

                  </ul>

                  <div class="card-meta">

                    <div>
                      <span class="meta-title">Price</span>

                      <span class="meta-text">$5000</span>
                    </div>

                    <div>
                      <span class="meta-title">Rating</span>

                      <span class="meta-text">

                        <div class="rating-wrapper">
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                        </div>

                        <span>5.0(30)</span>

                      </span>
                    </div>

                  </div>

                </div>

              </div>
            </li> -->

          </ul>

        </div>
      </section>





      <!-- 
        - #CONTACT
      -->

      <!-- <section class="section contact" aria-label="contact">
        <div class="container">

          <h2 class="h2 section-title">Have Question ? Get in touch!</h2>

          <p class="section-text">
            A great plateform to buy, sell and rent your properties without any agent or commisions.
          </p>

          <button class="btn btn-primary">
            <ion-icon name="call-outline"></ion-icon>

            <span class="span">Contact us</span>
          </button>

        </div>
      </section> -->





      <!-- 
        - #NEWSLETTER
      -->

      <!-- <section class="newsletter" aria-label="newsletter">
        <div class="container">

          <div class="wrapper">
            <h2 class="h2 section-title">Subscribe to Newsletter!</h2>

            <p class="section-text">Subscribe to get latest updates and information.</p>
          </div>

          <form action="" class="newsletter-form">
            <input type="email" name="email_address" placeholder="Enter your email :" aria-label="Enter your email"
              required class="email-field">

            <button type="submit" class="btn btn-secondary">Subscribe</button>
          </form>

        </div>
      </section> -->

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <!-- <footer class="footer">

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand">

          <a href="#" class="logo">
            <ion-icon name="business-outline"></ion-icon> RealHome
          </a>

          <p class="footer-text">
            A great plateform to buy rent your propertie.
          </p>

        </div>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Company</p>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward"></ion-icon>

              <span class="span">About us</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward"></ion-icon>

              <span class="span">Services</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward"></ion-icon>

              <span class="span">Pricing</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward"></ion-icon>

              <span class="span">Blog</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward"></ion-icon>

              <span class="span">Login</span>
            </a>
          </li>

        </ul>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Contact Details</p>
          </li>

          <li class="footer-item">
            <ion-icon name="location-outline"></ion-icon>

            <address class="address">
              C/54 Northwest Freeway,<br>
              Suite 558,<br>
              Houston, USA 485
              <a href="#" class="address-link">View on Google map</a>
            </address>
          </li>

          <li class="footer-item">
            <ion-icon name="mail-outline"></ion-icon>

            <a href="mailto:contact@example.com" class="footer-link">contact@example.com</a>
          </li>

          <li class="footer-item">
            <ion-icon name="call-outline"></ion-icon>

            <a href="tel:+152534468854" class="footer-link">+152 534-468-854</a>
          </li>

        </ul>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
          &copy; 2023 RealHome. All Right Reserved by <a href="#" class="copyright-link">Team 31</a>.
        </p>

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li>

        </ul>

      </div>
    </div>

  </footer> -->

  <?php include("footer.php"); ?>



  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <ion-icon name="arrow-up" aria-hidden="true"></ion-icon>
  </a>

  <!-- 
    - custom js link
  -->
  <!-- <script src="js/script.js" defer></script> -->

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>