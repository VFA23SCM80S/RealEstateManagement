<?php
session_start();
include 'db_connect.php';
?>

<?php

// if(isset($_POST['submit'])){
//     $q=$_POST['search'];
//     echo $q;
// }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  $search = $_POST['search'];
  $room_num = $_POST['room_num'];
  $price = $_POST['price'];
  $category = $_POST['category'];
  echo "Search: " . $search . ", Room number: " . $room_num . "Price: ".$price."<br>";



  if (!empty($search)) {
    $sql = "SELECT * FROM property WHERE No_of_rooms = ? AND BuildingType = ? AND Price = ? AND description LIKE ?";
    $stmt = $conn->prepare($sql);
    $search_param = "%{$search}%";
    $stmt->bind_param("isss", $room_num, $category, $price, $search_param);
} else if ($room_num === "Select") {
    if ($price === "Select") {
        if ($category === "Select") {
            $sql = "SELECT * FROM property";
            $stmt = $conn->prepare($sql);
        } else {
            $sql = "SELECT * FROM property WHERE BuildingType = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $category);
        }
    } else {
        if ($category === "Select") {
            $sql = "SELECT * FROM property WHERE Price = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $price);
        } else {
            $sql = "SELECT * FROM property WHERE Price = ? AND BuildingType = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $price, $category);
        }
    }
} else if ($price === "Select") { 
    if ($category === "Select") {
        $sql = "SELECT * FROM property WHERE No_of_rooms = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $room_num);
    } else {
        $sql = "SELECT * FROM property WHERE No_of_rooms = ? AND BuildingType = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $room_num, $category);
    }
} else if ($category === "Select") {
    // if ($room_num === "Select") {
    //     $sql = "SELECT * FROM property WHERE Price = ?";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("i", $price);
    // } else {
        $sql = "SELECT * FROM property WHERE Price = ? AND No_of_rooms = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $price, $room_num);
    // }
} else {
    $sql = "SELECT * FROM property WHERE No_of_rooms = ? AND Price = ? AND BuildingType = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $room_num, $price, $category);
}

$stmt->execute();
$result = $stmt->get_result();
// Further code to fetch and process the result...

   // Display search results
 if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
     echo "Description: " . $row["description"] . ", Number of rooms: " . $row["No_of_rooms"] . ", Price: " . $row["Price"] . ", Square footage: " . $row["SquareFootage"]. ", Type of building: " . $row["BuildingType"]."<br>";
    }
} else {
    echo "0 results found.";
}

// Close the connection
$stmt->close();
//  $conn->close();
}

// $tab = $_POST['tab'];
// $search = $_POST['search'];
// $room_num = $_POST['room_num'];
// $min_price = $_POST['min-price'];
// $bedrooms = $_POST['bedrooms'];



?>