<?php
require_once 'classes/Auth.php';


$user = new Auth();

$errors = array('password' => '', 'cpassword' => '', 'match' => '', 'len' => '');

$password = NULL;
$cpassword = NULL;

if (!is_string($_POST['password']) || !is_string($_POST['cpassword'])) {
//    http_response_code(505);
//    exit();
}

if(!isset($_GET['email']) && !isset($_GET['token'])){
    header('Location: index.php');
    exit();
}

    $email = $_GET['email'];
    $token = $_GET['token'];

//    echo $_SESSION['email'];
//    exit();
    $checkValidity = $user->checkToken($email);
    if ($checkValidity['token'] != $token) {
        echo '<script>alert("Invalid Token!")</script>';
        echo '<script>setTimeout(function() {
            location.href = "/camagru/index"
          }, 1);</script>';
    }

    if (isset($_POST['update']) && $_POST['update'] != '') {
        if (empty($_POST['password'])) {
            $errors['password'] = 'Password is required';
        } else if (empty($_POST['cpassword'])) {
            $errors['cpassword'] = 'Password is required';
        } else if (strcmp($_POST['password'], $_POST['cpassword']) !== 0) {
            $errors['match'] = 'These passwords do not match. Try Again.';
        } elseif (strlen(trim($_POST['password'])) <= 0 || strlen($_POST['password']) <= 8) {
            $errors['len'] = 'Your password must be at least 8 characters long. Please try another.';
        } else {
            $password = $user->test_input($_POST['password']);
            $hpass = password_hash($password, PASSWORD_DEFAULT);
        }

        //Check Errors
        if (!empty($errors['cpassword']) || !empty($errors['match']) || !empty($errors['len']) || !empty($errors['password'])) {
            goto end;
        }

        // Traitement

        $protocol = "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'];

        $passwordChanged = $user->changePassword($hpass,  $email);

        if ($passwordChanged != NULL) {
            echo '<script>alert("Password Changed Successfully");</script>';
            echo '<script>setTimeout(function() {
              location.href = "/camagru/login"
            }, 1);</script>';
        } else {
            header('Location: index.php');
            die();
            //             $errors['wrong'] = "Something be wrong, Try Again!";
        }
    } // update
end:
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Reset Password - Camagru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link href="style/index.css" rel="stylesheet">
    <link href="style/profile.css" rel="stylesheet">
</head>

<body>
<?php
include_once './inc/header.php';
?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="reset" id="reset">
                <?php echo '
                    <form method="POST" action="">
                        <h1>Reset Password</h1>
                        <label>New Password</label>
                        <input type="password" name="password" required/>   
                        <label>Confirm New Password</label>
                        <input type="password" name="cpassword" required/>';
                foreach ($errors as $key => $value) {
                    if (!empty($value)) {
                        echo '<div class="red-alert">'.$value.'</div>';
                    }
                }
                echo '
                        <br>
                        <input type="submit" style="margin: 5% 0 5%;" class="btn" name="update" value="update">
                        <!-- <div class="btn">Register</div> -->
                    </form>';
                ?>
            </div>
        </div>
    </div>
</div>
<?php include_once 'inc/footer.php'; ?>
</body>

</html>
