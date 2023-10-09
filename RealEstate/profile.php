<?php

session_start();

include 'db_connect.php';
if (isset($_SESSION['user_id'])) {
    echo $_SESSION['user_id'];
}


if (isset($_SESSION['user_id'])) {

    // Escape the user_id to prevent SQL injection
    $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

    // Query the database to retrieve user data
    //   $sql = "SELECT * FROM User WHERE User_ID = '$user_id'";
    $sql = "SELECT u.PhoneNumber, u.Address, u.EmailAddress, u.FirstName, u.MiddleName, u.LastName, a.Address, c.CreditCardNumber, c.CVV, c.ExpirationDate
        FROM User u
        JOIN User_Address a ON u.User_ID = a.UserID
        JOIN CreditCard c ON u.User_ID = c.User_ID
        WHERE u.User_ID = '$user_id'";
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


$property_id = $_POST['property_id'];
echo $property_id;

// Retrieve the user ID from the session variable

// $conn->close();




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
        <button onclick="window.location.href='index.php'" class="btn btn-primary back-button" style="margin-bottom: 25px; margin-top: 35px;">Go back</button>
        <h1 class="h3 mb-3">Settings</h1>
        <div class="row">
            <div class="col-md-5 col-xl-4">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>
                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
                            Bookings
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-xl-8">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Personal info</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="inputUsername">First Name</label>
                                                <input type="text" class="form-control" id="inputUsername" placeholder="Username" value="<?php echo  $user_data['FirstName'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputUsername">Last Name</label>
                                                <input type="text" class="form-control" id="inputUsername" placeholder="Username" value="<?php echo $user_data['LastName']  ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <img alt="Andrew Jones" src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle img-responsive mt-2" width="128" height="128">
                                                <div class="mt-2">
                                                    <span class="btn btn-primary"><i class="fa fa-upload"></i></span>
                                                </div>
                                                <!-- <small>For best results, use an image at least 128px by 128px in .jpg format</small> -->
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Addresses</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div id="form-group-container">
                                        <div class="form-group">
                                            <label for="inputEmail4">Address</label>
                                            <input type="text" class="form-control" id="inputEmail4" placeholder="1234 Main St" value="<?php echo  $user_data['Address'] ?>">
                                        </div>
                                    </div>
                                    <button id="add-form" class="btn btn-primar address" style="margin-bottom: 38px; display: block;     
                                    color: #fff; background-color: #007bff; border-color: #007bff;">Add</button>
                                    <button id="delete-form" class="btn btn-primar address" style="margin-bottom: 38px; display: block;     
                                    color: #fff; background-color: #007bff; border-color: #007bff;">Delete</button>

                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>


                                <script>
                                    document.getElementById('add-form').addEventListener('click', function(event) {
                                        event.preventDefault(); // Prevent the form from submitting when the "Add" button is clicked

                                        const formGroupContainer = document.getElementById('form-group-container');
                                        const firstFormGroup = formGroupContainer.querySelector('.form-group');

                                        const newFormGroup = firstFormGroup.cloneNode(true); // Clone the first form-group div
                                        formGroupContainer.appendChild(newFormGroup); // Append the new form-group div to the container
                                    });

                                    document.getElementById('delete-form').addEventListener('click', function(event) {
                                        event.preventDefault();

                                        const formGroupContainer = document.getElementById('form-group-container');
                                        const formGroups = formGroupContainer.querySelectorAll('.form-group');

                                        if (formGroups.length > 1) {
                                            formGroupContainer.removeChild(formGroups[formGroups.length - 1]);
                                        }
                                    });
                                </script>


                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Credit Card</h5>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <form>
                                        <div id="credit-form-container">
                                            <div class="credit-form">
                                                <div class="form-group">
                                                    <label for="inputEmail4">Credit Card Number</label>
                                                    <input type="text" class="form-control" id="inputEmail4" placeholder="12345678" value="<?php echo $user_data['CreditCardNumber']  ?>">
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputFirstName">Expiration Date</label>
                                                        <input type="date" class="form-control" id="inputFirstName" placeholder="2023-12-11" value="<?php echo $user_data['ExpirationDate']  ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputLastName">CVV</label>
                                                        <input type="text" class="form-control" id="inputLastName" placeholder="123" value="<?php echo $user_data['CVV']  ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button id="add-form-card" class="btn btn-primary card" style="margin-bottom: 38px; display: block; color: #fff; background-color: #007bff; border-color: #007bff;">Add</button>
                                        <button id="delete-form-card" class="btn btn-primar address" style="margin-bottom: 38px; display: block; color: #fff; background-color: #007bff; border-color: #007bff;">Delete</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>

                                <script>
                                    document.getElementById('add-form-card').addEventListener('click', function(event) {
                                        event.preventDefault();

                                        const creditFormContainer = document.getElementById('credit-form-container');
                                        const firstCreditForm = creditFormContainer.querySelector('.credit-form');

                                        const newCreditForm = firstCreditForm.cloneNode(true);
                                        creditFormContainer.appendChild(newCreditForm);
                                    });

                                    document.getElementById('delete-form-card').addEventListener('click', function(event) {
                                        event.preventDefault();

                                        const creditFormContainer = document.getElementById('credit-form-container');
                                        const creditForms = creditFormContainer.querySelectorAll('.credit-form');

                                        if (creditForms.length > 1) {
                                            creditFormContainer.removeChild(creditForms[creditForms.length - 1]);
                                        }
                                    });
                                </script>

                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Your Bookings</h5>
                                <form>


                                    <div class="form-row">

                                        
                                        <div class="form-group col-md-6">
                                            <label for="building">Property</label>
                                            <input type="text" class="form-control" name="building" id="building" placeholder="Building" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="availability">Availability</label>
                                            <input type="text" class="form-control" name="availability" id="availability" placeholder="1 or 0" required>
                                        </div>
                                    </div>
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php

$user_id = $_SESSION['user_id'];

// Retrieve the bookings made by the current user
$sql = "SELECT * FROM Booking WHERE User_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Display the bookings in a table
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Booking ID</th><th>Property ID</th><th>Start Date</th><th>End Date</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["BookingID"] . "</td>";
        echo "<td>" . $row["PropertyID"] . "</td>";
        echo "<td>" . $row["StartDate"] . "</td>";
        echo "<td>" . $row["EndDate"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No bookings found for this user.";
}

$stmt->close();
?>
        </div>
    </div>
    <!-- <script src="js/script.js"></script> -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">


    </script>
</body>

</html>