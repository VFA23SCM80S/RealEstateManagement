<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// trigger_error("Test error", E_USER_ERROR);

session_start();
include 'db_connect.php';
if (isset($_POST['property_id'])) {
    $_SESSION['property_id'] = $_POST['property_id'];
}
// if (isset($_SESSION['user_id'])) {
//     $user_id = $_SESSION['user_id'];
//     echo "Current user ID: " . $user_id;
// } else {
//     echo "No user is logged in.";
// }
// isset($_SESSION['user_id'])

if (isset($_SESSION['property_id'])) {
    $property_id = $_SESSION['property_id'];

    // Fetch property data
    $sql_property = "SELECT * FROM Property WHERE PropertyID = ?";
    $stmt_property = $conn->prepare($sql_property);
    $stmt_property->bind_param("i", $property_id);
    $stmt_property->execute();
    $result_property = $stmt_property->get_result();
    if ($result_property->num_rows > 0) {
        $row_property = $result_property->fetch_assoc();
        // Save property data into variables
        $buildingType = $row_property['BuildingType'];
        $no_of_rooms = $row_property['No_of_rooms'];
        // echo $buildingType;
        // echo $no_of_rooms;
    } else {
        // echo "No property found with the given ID.";
    }
    $stmt_property->close();
} else {
    // echo "Property ID or User ID not set.";
}


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Fetch user data
    $sql_user = "SELECT * FROM User WHERE User_ID = ?";
    $stmt_user = $conn->prepare($sql_user);
    if (!$stmt_user) {
        die("Error: " . $conn->error);
    }
    $stmt_user->bind_param("i", $user_id);
    // if (!$stmt_user) {
    //     die("Error: " . $conn->error);
    // }
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    if ($result_user->num_rows > 0) {
        $row_user = $result_user->fetch_assoc();

        // Save user data into variables
        $username = $row_user['FirstName'];
        $email = $row_user['EmailAddress'];
        // Add other columns as needed

        // You can now use the user variables in your code
    } else {
        // echo "No user found with the given ID.";
    }
    $stmt_user->close();



    // Fetch credit card data for the user
    $sql_creditcard = "SELECT * FROM CreditCard WHERE User_ID = ?";
    $stmt_creditcard = $conn->prepare($sql_creditcard);
    if (!$stmt_creditcard) {
        die("Error: " . $conn->error);
    }
    $stmt_creditcard->bind_param("i", $user_id);
    $stmt_creditcard->execute();
    $result_creditcard = $stmt_creditcard->get_result();
    // $creditCardData[$card_number]['CreditCardID'] = $row_creditcard['CreditCardID'];
    $creditCardData = [];

}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = $_POST['property_id'];
    $credit_card = $_POST['credit_card'];
    $expiration_date = $_POST['expiration_date'];
    $cvv = $_POST['cvv'];
    $bdate = $_POST['bdate'];
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];

    // Insert data into the booking table (replace 'booking' with your actual table name)
    $sql = "INSERT INTO Booking (Start_date, End_date, PropertyID, RenterID, CreditCardID, Booking_date, User_ID) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiisii", $sdate, $edate, $_SESSION['property_id'], $_SESSION['user_id'], $_SESSION['user_id'], $bdate, $_SESSION['user_id']);

    if ($stmt->execute()) {
        // Redirect to profile.php after successful insertion
        header("Location: booking.php");
        echo "Booking was successful";
        echo "<a href = 'index.php'> Go back <a/>";
        exit;
    } else {
        echo "Booking was successful";
        echo "<a href = 'index.php'> Go back <a/>";
    }

    $stmt->close();
    $conn->close();
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
        <button onclick="window.location.href='property_detail.php?PropertyID=<?php echo $_SESSION['property_id']; ?>'" class="btn btn-primary back-button">Go back</button>

        <h1 class="h3 mb-3">Credit Card</h1>
        <div class="row" style="width: 1800px;">

            <div class="col-md-7 col-xl-8">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Credit Card</h5>
                            </div>
                            <div class="card-body">
                            <form action="booking.php" method="post" onsubmit="return validateCreditCardInfo();">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="building">Choose your credit card</label>
                                            <select class="form-control" name="credit_card" id="credit_card" required>
                                                <?php
                                                if ($result_creditcard->num_rows > 0) {
                                                    while ($row_creditcard = $result_creditcard->fetch_assoc()) {
                                                        $card_number = $row_creditcard['CreditCardNumber'];
                                                        $creditCardData[$card_number] = [
                                                            'ExpirationDate' => $row_creditcard['ExpirationDate'],
                                                            'CVV' => $row_creditcard['CVV']
                                                        ];
                                                        echo "<option value='$card_number'>$card_number</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>No credit cards found</option>";
                                                }
                                                ?>
                                            </select>
                                            <!-- <input type="text" class="form-control" name="building" id="building" placeholder="Building" required> -->
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="availability">Enter Expiration Date</label>
                                            <input type="text" class="form-control" name="expiration_date" id="expiration_date" placeholder="Expiration Date" required>

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="squareFootage">CVV</label>
                                            <input type="number" step="0.01" class="form-control" name="cvv" id="cvv" placeholder="CVV" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="bdate">Booking Date</label>
                                            <input type="text" class="form-control" name="bdate" id="bdate" placeholder="2023-04-22" required>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                    <div class="form-group col-md-6">
                                            <label for="sdate">Start Date</label>
                                            <input type="text" class="form-control" name="sdate" id="sdate" placeholder="2023-04-22" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="edate">End Date</label>
                                            <input type="text" class="form-control" name="edate" id="edate" placeholder="2023-04-22" required>
                                        </div>

                                    </div>
                                  
                                  
                                  
                                    <input type="hidden" name="property_id" value="<?php $property_id ?>">


                                    <button type="submit" class="btn btn-primary" style="margin-bottom: 38px; 
                                    display: block; color: #fff; background-color: #007bff; border-color: #007bff;">Book</button>

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
    <script>
document.addEventListener('DOMContentLoaded', function() {
    var creditCardSelect = document.getElementById('credit_card');
    var creditCardData = <?php echo json_encode($creditCardData); ?>;

    creditCardSelect.addEventListener('change', function() {
        var creditCardNumber = this.value;

        if (creditCardData.hasOwnProperty(creditCardNumber)) {
            document.getElementById('expiration_date').value = creditCardData[creditCardNumber].ExpirationDate;
            document.getElementById('cvv').value = creditCardData[creditCardNumber].CVV;
        } else {
            document.getElementById('expiration_date').value = '';
            document.getElementById('cvv').value = '';
        }
    });

    // Trigger the change event to set the initial values
    creditCardSelect.dispatchEvent(new Event('change'));
});
</script>
    
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">


    </script>
</body>

</html>