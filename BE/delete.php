<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['UserNameS'])) {
    // Redirect to the login page or display an error message
    header('Location: ../index.html');
    exit();
}

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];

    include "Connection.php";

    // Check if the user has confirmed the deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // Deletion is confirmed, proceed to delete the row from the database
        $deleteQuery = "DELETE FROM customer WHERE ID = '$ID'";
        $deleteResult = $conn->query($deleteQuery);

        if ($deleteResult) {
            // Deletion successful
            echo '<script>
                alert("User deleted successfully.");
                window.location.href = "staff.php"; // Redirect to staff page
            </script>';
        } else {
            // Deletion failed
            echo '<script>
                alert("Failed to delete the user.");
                window.location.href = "staff.php"; // Redirect to staff page
            </script>';
        }

        $conn->close();
    } else {
        // Display a confirmation alert to the user
        echo '<script>
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "delete.php?ID=' . $ID . '&confirm=yes";
            } else {
                window.location.href = "staff.php"; // Redirect to staff page
            }
        </script>';
    }
} else {
    // If the username is not provided, redirect back to the main page or display an error message
    header('Location: main.php');
    exit();
}
?>
