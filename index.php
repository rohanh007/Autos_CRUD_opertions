<?php
require_once "pdo.php";
session_start();

?>
<html>

<head>
    <title>Rohan Hoval</title>
    <link rel="stylesheet" href="style.css">
    <style>
     
        /* h1 {
            text-align: center;
            color: #333; 
            font-size: 36px; 
            padding: 20px; 
        } */
        .centered-div {
            text-align: center;
            margin-top: 20px; /* Add margin for spacing */
           background-color:white;
           margin-top: 180px;
           margin-left: 180px;
           margin-right: 180px;
           padding-bottom: 30px;
        }

        .centered-div h1 {
            color: #333; /* Change the color to your desired value */
            font-size: 36px; /* Adjust the font size as needed */
            padding: 20px; /* Add padding for spacing */
        }

        .centered-div a {
            color:white; /* Change the link color to your desired value */
            text-decoration: none; /* Remove underlines from the link */
            font-weight: bold; 
            background-color: #04AA6D;
            padding:10px 20px;
           
        }

        .centered-div a:hover {
            text-decoration: underline; /* Add underline on hover */
        }
        table {
                border-collapse: collapse;
                width: 100%;
            }
    
            th, td {
                padding: 10px;
                text-align: left;
            }
    
            th {
                background-color: #f2f2f2;
            }
    
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
    
            tr:nth-child(odd) {
                background-color: #ffffff;
            }
    
            a {
                text-decoration: none;
            }
    
            a:hover {
                color: blue;
            }
    </style>
</head>

<body>
    <!-- <h1 >Welcome to the Automobiles Database</h1> -->
    <?php
    if (isset($_SESSION['name'])) {
    echo '<div style="float: left; background-color: #04AA6D; margin-top: 18px; margin-right: 20px; padding: 10px;">';
    echo '<button style="background-color: #04AA6D; border: none; color: white; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin-right: 10px;">';
    echo '<a href="add.php" style="color: white; text-decoration: none;">Add New Entry</a>';
    echo '</button>';
    echo '</div>';

    echo '<div style="float: left; background-color: #04AA6D; margin-top: 18px; margin-right: 20px; padding: 10px;">';
    echo '<button style="background-color: #04AA6D; border: none; color: white; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin-right: 10px;">';
    echo '<a href="logout.php" style="color: white; text-decoration: none;">Logout</a>';
    echo '</button>';
    echo '</div>';
}
?>
    <?php

    
        if (!isset($_SESSION['name'])) {
           echo '<div class="centered-div">';
           echo '<h1>Welcome to the Automobiles Database</h1>';
           echo '<p><a href="login.php">Please log in</a></p>';
           echo '</div>';
        } else {
            if ( isset($_SESSION['error']) ) {
                echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
                unset($_SESSION['error']);
            }
            if ( isset($_SESSION['success']) ) {
                echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
                unset($_SESSION['success']);
            }
           
            $stmt = $pdo->query("SELECT * FROM autos");
        
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row == false) {
                echo "No rows found";
            }
            
    
    echo "<table border='1'>";
    echo "<thead>";
    echo "<tr>";
    echo '<th style="text-align: center;">Make</th>';
    echo '<th style="text-align: center;">Year</th>';
    echo '<th style="text-align: center;">Mileage</th>';
    echo '<th style="text-align: center;">Seat Capacity</th>';
    echo '<th style="text-align: center;">Car Type</th>';
    echo '<th colspan="2" style="text-align: center;">Edit/Delete</th>';
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlentities($row['make']) . "</td>";
        echo "<td>" . htmlentities($row['year']) . "</td>";
        echo "<td>" . htmlentities($row['mileage']) . "</td>";
        echo "<td>" . htmlentities($row['seat_cap']) . "</td>";
        echo "<td>" . htmlentities($row['car_type']) . "</td>";
        echo '<td><a href="edit.php?autos_id=' . $row['auto_id'] . '">Edit</a></td>';
        echo '<td><a href="delete.php?autos_id=' . $row['auto_id'] . '">Delete</a></td>';
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
    
            
        }
    ?>
    <!-- <p> <a href="add.php" class="div">Add New Entry</a></p>
    <p><a href="logout.php" class="div" >Logout</a></p> -->
</body>

