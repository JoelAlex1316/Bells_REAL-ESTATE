<?php
session_start();

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");

// Check if the user is logged in
if (!isset($_SESSION['UserNameS'])) {
    // Redirect to the login page or display an error message
    header('Location: ../index.html');
    exit();
}

// Continue displaying the Staff.php content
?>


    <?php
if (strcasecmp($_SESSION['UserNameS'], 'deb') === 0 || strcasecmp($_SESSION['UserNameS'], 'JoelAlex1316') === 0) {        
    
    include "Connection.php";
  

        // Fetch all customers from the database
        $sql = "SELECT ID, Name, PhoneNumber, Email, Message, Date FROM customer";

        // Check if search query is provided
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            // Add search condition to the SQL query
            $sql .= " WHERE Name LIKE '%$search%' OR PhoneNumber LIKE '%$search%' OR Email LIKE '%$search%'";
        }

        $result = $conn->query($sql);

        echo'<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>BELLS REAL-ESTATE</title>
            <link rel="icon" href="../img/logo.png">
            <link rel="stylesheet" href="TableStyle.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
        </head>
        <body>';
            echo'
            
            <dialog class="modal" id="poppupp">
            <form class="formn" action="Message.php" method="post">
                <div class="title">Daily Notification</div>
                     <input type="text" placeholder="Subject" name="Subject" class="input">
                    <textarea placeholder="Your message" name="Message"></textarea>
             
                    <button>Send</button>
           </form>
            </dialog>
            ';
        // Display the fetched user data in a table
        if ($result->num_rows > 0) {
            echo '<main class="table" id="customers_table">';
            echo '<section class="table__header">';
            echo '<h1>Requests from Customers</h1>';
            echo '<div class="input-group">';
            echo '<input type="search" placeholder="Search Data...">
                   <img src="../img/search.png" alt="">';
            echo '</div>';

            echo '<div class="Daily_Message">
            <i class="fas fa-message"></i>
                </div>';

            echo '<div class="logout"> <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> </a></div>';
            echo '<div class="export__file">';
            echo '<label for="export-file" class="export__file-btn" title="Export File"></label>';
            echo '<input type="checkbox" id="export-file">';

            echo '<div class="export__file-options">';
            echo '<label>Export As &nbsp; &#10140;</label>';
            echo '<label for="export-file" id="toPDF">PDF <img src="../img/pdf.png" alt=""></label>';
            echo '<label for="export-file" id="toEXCEL">EXCEL <img src="../img/excel.png" alt=""></label>';
            echo '</div>';
            echo '</div>';
            echo '</section>';
            echo '<section class="table__body">';
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Name<span class="icon-arrow">&UpArrow;</span></th>';
            echo '<th>Phone Number</th>';
            echo '<th>Email</th>';
            echo '<th>Message</th>';
            echo '<th>Date</th>';  
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['ID'] . '</td>';
                echo '<td>' . $row['Name'] . '</td>';
                echo '<td>' . $row['PhoneNumber'] . '</td>';
                echo '<td>' . $row['Email'] . '</td>';
                echo '<td>' . $row['Message'] . '</td>';
                echo '<td>' . $row['Date'] . '</td>';
                echo '<td>';
                echo '<a href="tel:' . $row['PhoneNumber'] . '"><i class="fa-solid fa-phone"></i></a>';
                echo '<a href="delete.php?ID=' . $row['ID'] . '"><i class="fa-solid fa-trash"></i></a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</section>';
            echo '</main>';
            echo '<script src="script.js"></script>';
        } else {
            echo "No users found.";
        }

        $conn->close();
    } 
    ?>

</div>

<script>
    const modal = document.getElementById('poppupp');
const cards = document.querySelectorAll('.card');
const mess = document.querySelectorAll('.Daily_Message');

cards.forEach(card => {
    card.addEventListener('click', () => {
        modal.showModal();
    });
});

mess.forEach(card => {
    card.addEventListener('click', () => {
        modal.showModal();
    });
});
// Close the modal when the user clicks outside
modal.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.close();
    }
});
</script>
</body>
</html>
