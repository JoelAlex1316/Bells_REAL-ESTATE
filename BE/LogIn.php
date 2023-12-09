<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Uname = $_POST["Uname"];
    $Password = $_POST["Password"];

    include "Connection.php";
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM staff WHERE UserName = '$Uname'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row["Password"] == $Password) {
            $_SESSION["UserNameS"] = $Uname;
            header("Location: Staff.php");
            exit;
        } else {
            echo "<script>alert('Invalid password! Please try again.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Username not found! Please try again.'); window.history.back();</script>";
    }

    $conn->close();
}
?>
