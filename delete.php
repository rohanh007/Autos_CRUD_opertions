<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['delete']) && isset($_POST['autos_id']) ) {
    $sql = "DELETE FROM autos WHERE auto_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['autos_id']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['autos_id']) ) {
  $_SESSION['error'] = "Missing autos id";
  header('Location: index.php');
  return;
}

$stmt = $pdo->prepare("SELECT make, auto_id FROM autos where auto_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['autos_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for autos_id';
    header( 'Location: index.php' ) ;
    return;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Rohan Hoval</title>

    <style>
        /* Style for the confirmation message */
.confirmation-message {
    background-color: #f2f2f2;
    border: 1px solid #ddd;
    padding: 10px;
    margin: 10px 0;
    text-align: center;
    font-weight: bold;
}

/* Style for the form */
.form-container {
    width: 300px;
    margin: 0 auto;
   
}

/* Style for the Delete button */
.delete-button {
    background-color:#04AA6D;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    margin-right: 10px;
}

/* Style for the Cancel link */
.cancel-link {
    background-color:#04AA6D;
    color: black;
    padding: 10px 20px;
    text-decoration: none;
    color: white;
}

    </style>
</head>
<body>
<p class="confirmation-message">Confirm: Deleting  <?= htmlentities($row['make']) ?></p>

<div class="form-container">
    <form method="post">
        <input type="hidden" name="autos_id" value="<?= $row['auto_id'] ?>">
        <input type="submit" value="Delete" name="delete" class="delete-button">
        <a href="index.php" class="cancel-link">Cancel</a>
    </form>
</div>

</body>
</html>
