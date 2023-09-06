<?php
include("pdo.php");
session_start();

    if (!isset($_SESSION['name'])) {
        die("ACCESS DENIED");
    }

    if ( isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['seat_cap'])  && isset($_POST['car_type'])) {

        // Data validation
        if ( strlen($_POST['make']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1 ) {
            $_SESSION['error'] = 'All fields are required';
            header("Location: add.php");
            return;
        }

        if (!is_numeric($_POST['year'])) {
            $_SESSION['error'] = "Year must be an integer";
            header("Location: add.php");
            return;
        }

        $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage , seat_cap ,car_type) VALUES (:mk, :yr, :mi , :sc, :ct)');
        $stmt->execute(array(
            ':mk' => $_POST['make'],
            ':yr' => $_POST['year'],
            ':mi' => $_POST['mileage'],
            ':sc' => $_POST['seat_cap'],
            ':ct' => $_POST['car_type'])
            );
            
        $_SESSION['success'] = 'Record added';
        header( 'Location: index.php' ) ;
        return;
    }

?>

<html>

<head>
    <title>Rohan Hoval</title>
    <link rel="stylesheet" href="style.css">

<body>
    <?php
        // Flash pattern
        if ( isset($_SESSION['error']) ) {
            echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
            unset($_SESSION['error']);
        }
    ?>
    
    <form method="post" class="form" style="margin-top: 50px">
    <h2>Add A New Entry</h2>
        <p>Model_Name:
            <input type="text" size="45" name="make" placeholder="xyz...">
        </p>
        <p>Year :
            <input type="text" size="45" name="year" placeholder="yyyy">
        </p>
        <p>Mileage:
            <input type="text" size="45" name="mileage" placeholder="nn">
        </p>
        <p>seating_capacity:
            <input type="text" size="45" name="seat_cap" placeholder="nn">
        </p>
        <p>car_type:
            <input type="text" size="45" name="car_type" placeholder="SUV">
        </p>
        <p>
            <input type="submit" value="Add" name="Add" class="button" /> 
        </p>
         <p> 
            <a href="logout.php" class="div">LogOut</a>
         </p>
    </form>
</body>

</html>