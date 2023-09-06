<?php
include("pdo.php");
session_start();

if ( isset($_POST['make']) 
     && isset($_POST['mileage']) && isset($_POST['year']) ) {

    // Data validation
    if ( strlen($_POST['make']) < 1  || strlen($_POST['mileage']) < 1  || strlen($_POST['year']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: edit.php?autos_id=".$_POST['autos_id']);
        return;
    }

    if ( !is_numeric($_POST['year']) ) {
        $_SESSION['error'] = 'Year must be numeric';
        header("Location: edit.php?autos_id=".$_POST['autos_id']);
        return;
    }

    $sql = "UPDATE autos SET make = :make, year = :year, mileage = :mileage, car_type = :car_type ,seat_cap = :seat_cap
            WHERE auto_id = :auto_id";
            
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute(array(
        ':make' => $_POST['make'],
        ':year' => $_POST['year'],
        ':mileage' => $_POST['mileage'],
        ':seat_cap' => $_POST['seat_cap'],
        ':car_type' => $_POST['car_type']
       ,':auto_id' => $_POST['autos_id']));
        
    $_SESSION['success'] = 'Record edited';
    header( 'Location: index.php' ) ;
    return;
    }

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['autos_id']) ) {
  $_SESSION['error'] = "Missing autos_id";
  header('Location: index.php');
  return;
}

$stmt = $pdo->prepare("SELECT * FROM autos where auto_id = :id");
$stmt->execute(array(":id" => $_GET['autos_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for autos_id';
    header( 'Location: index.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$make = htmlentities($row['make']);
$y = htmlentities($row['year']);
$mileage = htmlentities($row['mileage']);
$sc = htmlentities($row['seat_cap']);
$ct = htmlentities($row['car_type']);
?>
<head>
   
    <title>Rohan Hoval</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

<form method="post" class="form" style="margin-top: 50px">
<p>Edit User</p>
        <p>Model_Name:
            <input type="text" size="45" name="make" value="<?= $make?>">
        </p>
        <p>Year :
            <input type="text" size="45" name="year" value="<?= $y?>">
        </p>
        <p>Mileage:
            <input type="text" size="45" name="mileage" value="<?= $mileage ?>">
        </p>
        <p>seating_capacity:
            <input type="text" size="45" name="seat_cap" value="<?= $sc ?>">
        </p>
        <p>car_type:
            <input type="text" size="45" name="car_type" value="<?=$ct ?>">
        </p>
         <input type="hidden" name="autos_id" value="<?= $row['auto_id'] ?>">
      <!-- <p>
        <input type="submit" value="Save" />
        <a href="index.php">Cancel</a>
    </p> -->
       <p>
            <input type="submit" value="Save" class="div" /> 
        </p>
         <p> 
            <a href="index.php" class="div">LogOut</a>
    <div class=""></div>
</form>
    
</body>
</html>
