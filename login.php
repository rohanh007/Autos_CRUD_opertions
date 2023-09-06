<head>
    <title>6fd8a9e9</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
        include("pdo.php");
        session_start();
        
        if ( isset($_POST['email']) && isset($_POST['password'])  ) {
            if($_POST['email'] == "" || $_POST['password'] == "") {
                $_SESSION['error'] = "User name and password are required";   
                header("Location: login.php");
                return;    
            } elseif (strpos($_POST['email'], '@') == false) {
                $_SESSION['error'] = "Email must have an at-sign (@)";
                header("Location: login.php");
                return;
            } else {
                if ( $_POST['password'] == "php123" ) {
                    error_log("Login success ".$_POST['email']);
                    $_SESSION['success'] = "Login success.";
                    $_SESSION['name'] = $_POST['email'];
                    header('Location: index.php');
                    return;
                } else { 
                    $hash = hash('sha256', $_POST['password']);
                    error_log("Login fail ".$_POST['email']." $hash");
                    $_SESSION['error'] = "Incorrect password";
                    header('Location: login.php');
                    return;
                }
            }
        }
    ?>

<body>
    <?php 

        if ( isset($_SESSION['error']) ) {
            echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
            unset($_SESSION['error']);
        }
    ?>

<form method="post">
        <h1>Log In</h1>
        <p>Email:
            <input type="text" size="45" name="email" placeholder='xyz@email.com'>
        </p>
        <p>Password:
            <input type="text" size="45" name="password" placeholder="********">
        </p>
        <p>
            <input type="submit" value="Log In" class="button" />
            <br>
            <!-- Refresh the page by linking to itself -->
            <a href="<?php echo ($_SERVER['PHP_SELF']); ?>">Refresh</a>
        </p>
    </form>
</body>
<html>