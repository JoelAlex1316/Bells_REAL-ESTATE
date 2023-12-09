<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Name = $_POST["name"];
    $PhoneNumber = $_POST["phonenumber"];
    $Email = $_POST["email"];
    $Message = $_POST["message"];
    
    $Date = date('Y-m-d H:i:s');

    include "Connection.php";
    include "functions.php";
    $ID = random_num(10);
    

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

     // insert the customer's message into the database
        $sql = "INSERT INTO customer (ID, Name, PhoneNumber, Email, Message, Date) VALUES ('$ID', '$Name', '$PhoneNumber', '$Email', '$Message', '$Date')";
        if ($conn->query($sql) === TRUE) {
            // if the query is successful, display a success message using an alert
            echo "<script>alert('Thank you for your Message'); window.location.href = '../index.html';</script>";


    $conn->close();
}
}
?>
