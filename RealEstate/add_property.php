<?php
// Include the database connection file (replace 'db_connect.php' with your connection file)
include 'db_connect.php';

// Fetch all data from the 'property' table
$sql = "SELECT * FROM Property";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // while ($row = $result->fetch_assoc()) {
    $row = $result->fetch_assoc();
    // }
  } 
  else {
    echo "<tr><td colspan='12'>No data found.</td></tr>";
  }



  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $building = $_POST["building"];
    $availability = $_POST["availability"];
    $squareFootage = $_POST["squareFootage"];
    $roomNum = $_POST["roomNum"];
    $typeOfBusiness = $_POST["typeOfBusiness"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $streetAddress = $_POST["streetAddress"];
    $neighbourhoodID = $_POST["neighbourhoodID"];
    $zipCode = $_POST["zipCode"];

    $sql = "INSERT INTO Property (BuildingType, Availability, No_of_rooms, SquareFootage, TypeOfBusiness, Description, Price, NeighbourhoodID, City, State, StreetAddress, ZipCode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssidssdissss", $building, $availability, $roomNum, $squareFootage, $typeOfBusiness, $description, $price, $neighbourhoodID, $city, $state, $streetAddress, $zipCode);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("Location: add_property.php");
    $stmt->close();

}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>bs4 Profile Settings page - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            margin-top: 20px;
            background: #F0F8FF;
        }

        .card {
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #e5e9f2;
            border-radius: .2rem;
        }

        .card-header:first-child {
            border-radius: calc(.2rem - 1px) calc(.2rem - 1px) 0 0;
        }

        .card-header {
            border-bottom-width: 1px;
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            color: inherit;
            background-color: #fff;
            border-bottom: 1px solid #e5e9f2;
        }
    </style>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="container p-0">
    <button onclick="window.location.href='index.php'" id="add-form" class="btn btn-primar address" style="margin-bottom: 38px; display: block;     
    color: #fff; background-color: #007bff; border-color: #007bff; position: absolute;     left: 218px;
    top: 72px;">Go back</button>
        <h1 class="h3 mb-3">Add Property</h1>
        <div class="row" style="width: 1800px;">

            <div class="col-md-7 col-xl-8">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Property</h5>
                            </div>
                            <div class="card-body">
                                <form action="#" method="post">

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="building">Building Type</label>
                                            <input type="text" class="form-control" name="building" id="building" placeholder="Building" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="availability">Availability</label>
                                            <input type="text" class="form-control" name="availability" id="availability" placeholder="1 or 0" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="squareFootage">SquareFootage</label>
                                            <input type="number" step="0.01" class="form-control" name="squareFootage" id="squareFootage" placeholder="Square Footage" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="roomNum">Number of rooms</label>
                                            <input type="number" class="form-control" name="roomNum" id="roomNum" placeholder="No of rooms" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="typeOfBusiness">Type Of Business</label>
                                            <input type="text" class="form-control" name="typeOfBusiness" id="typeOfBusiness" placeholder="Residential or Commercial" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="price">Price</label>
                                            <input type="number" step="0.01" class="form-control" name="price" id="price" placeholder="Price" required>
                                        </div>
                                    </div>

                                    <div id="form-group-container">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" name="description" id="description" placeholder="Description" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" name="city" id="city" placeholder="City" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control" name="state" id="state" placeholder="State" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="streetAddress">Street Address</label>
                                            <input type="text" class="form-control" name="streetAddress" id="streetAddress" placeholder="Street Address" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="neighbourhoodID">Neighbourhood ID</label>
                                            <input type="number" class="form-control" name="neighbourhoodID" id="neighbourhoodID" placeholder="Neighbourhood ID" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="zipCode">Zip Code</label>
                                            <input type="text" class="form-control" name="zipCode" id="zipCode" placeholder="Zip Code" required>
                                        </div>
                                    </div>

                                    <button id="add-form" class="btn btn-primar address" style="margin-bottom: 38px; display: block;     
                                    color: #fff; background-color: #007bff; border-color: #007bff;">Add</button>
                                    <!-- <button id="delete-form" class="btn btn-primar address" style="margin-bottom: 38px; display: block;     
                                    color: #fff; background-color: #007bff; border-color: #007bff;">Delete</button>

                                    <button type="submit" class="btn btn-primary">Save changes</button> -->
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- <script src="js/script.js"></script> -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">


    </script>
</body>

</html>