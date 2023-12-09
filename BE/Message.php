<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get the user's input
    $Subject = $_POST["Subject"];
    $Message = $_POST["Message"];
    $Signiture = "Bells Real-Estate\nbellsrealestateeth.com";

    include "Connection.php";

    // Retrieve the list of users from the database
    $query = "SELECT * FROM customer";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Loop through each user
        while ($row = $result->fetch_assoc()) {
            $email = $row['Email'];
            $name = $row['Name'];

            // Compose your daily message

            // Send the email
            $headers = "From: eyouelalemayehu1316@gmail.com";
            if (mail($email, $Subject, $Message."\n\n$Signiture", $headers)) {
                // Email sent successfully, redirect to a previous page
                echo "<script>alert('Email sent successfully!'); window.history.back();</script>";
            } else {
                // Error sending email
                echo "Error sending email.";
            }
        }
    } else {
        echo "No users found.";
    }

    // Close the database connection
    $conn->close();
}
?>
