<?php


session_start();
include 'db_connect.php';

// $conn = new mysqli($servername, $username, $password, $dbname);
  echo "<pre>";
  print_r($_SESSION['info']);
  echo "</pre>";

if(isset($_SESSION['info'])){

    extract($_SESSION['info']);

    if ($_SESSION['info']['userType'] === 'agent') {
        // Insert data into Agent table
        $sql = mysqli_query($conn, "INSERT  INTO Agent (JobTitle, EmailAddress, PhoneNumber, AgencyID, 
        FirstName, MiddleName, LastName) VALUES ('$job', '$email', '$phone', '$agency', '$fname', '$mname', '$lname') ");

        $sql = mysqli_query($conn, "INSERT  INTO User (PhoneNumber, Address, EmailAddress, FirstName, 
        MiddleName, LastName) VALUES ('$phone', '$address', '$email', '$fname', '$mname', '$lname') ");
    }
    else if ($_SESSION['info']['userType'] === 'renter'){
        $sql = mysqli_query($conn, "INSERT  INTO Renter (Address, Budget, PreferredLocation, PhoneNumber, 
        DesiredMoveInDate, FirstName, MiddleName, LastName) VALUES ('$address', '$budget', '$location', '$phone', '$moveIn', '$fname', '$mname', '$lname') ");

        // Get the last inserted Renter ID
        $renter_id = mysqli_insert_id($conn);

        $sql = mysqli_query($conn, "INSERT  INTO User (PhoneNumber, Address, EmailAddress, FirstName, 
        MiddleName, LastName) VALUES ('$phone', '$address', '$email', '$fname', '$mname', '$lname') ");

        // Get the last inserted User ID
        $user_id = mysqli_insert_id($conn);

        $sql = mysqli_query($conn, "INSERT  INTO CreditCard (CreditCardNumber, User_ID, CVV, ExpirationDate, RenterID) 
        VALUES ('$cCard', '$user_id', '$cvv', '$ccDate', '$renter_id') ");
    }

    // $sql = mysqli_query($conn, "INSERT  INTO User (PhoneNumber, Address, EmailAddress, FirstName, 
    // MiddleName, LastName) VALUES ('$phone', '$address', '$email', '$fname', '$mname', '$lname') ");

    if($sql){
        unset($_SESSION['info']);
        echo "Data has been saved sucessfully!";
    }else{
        echo mysqli_errno($conn);
    }

    // echo $email;
}

?>