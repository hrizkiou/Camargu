<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    die();
}

require_once 'classes/Auth.php';
$user = new Auth();

$errors = array('opassword' => '', 'npassword' => '', 'cpassword' => '');

$password = NULL;
$cpassword = NULL;

$email = $_SESSION['email'];


if (isset($_POST['update']) && $_POST['update'] != ''){

    if (!is_string($_POST['opassword']) || !is_string($_POST['cpassword']) || !is_string($_POST['npassword'])) {
        http_response_code(505);
        exit();
    }

    if (empty($_POST['opassword'])) {
        $errors['opassword'] = 'Password is required';
    } else{
        $password = $user->test_input($_POST['opassword']);
    }

    $userLogged = $user->login($_SESSION['email']);

    if ($userLogged != NULL) {
        if (password_verify($password, $userLogged['password'])) {
            if (empty($_POST['npassword'])) {
                $errors['npassword'] = 'Password is required';
            }
            if (empty($_POST['cpassword'])) {
                $errors['cpassword'] = 'Password is required';
            }
            if (strcmp($_POST['npassword'], $_POST['cpassword']) !== 0) {
                $errors['match'] = 'These passwords do not match. Try Again.';
            }
            elseif (strlen(trim($_POST['npassword'])) <= 0 || strlen($_POST['cpassword']) <= 8) {
                $errors['len'] = 'Your password must be at least 8 characters long. Please try another.';
            }
        }
        else {
            $errors['Error'] = 'Incorrect Password';
        }
    } else {
        $errors['Error'] = 'Something Be wrong';
    }

    //Check Errors
    if (!empty($errors['cpassword']) || !empty($errors['match']) || !empty($errors['len']) || !empty($errors['opassword']) || !empty($errors['npassword'])) {
        goto end;
    }

    //Traitement
    $hpass = password_hash($_POST['cpassword'], PASSWORD_DEFAULT) ;
    $passwordChanged = $user->changePassword($hpass, $email);
    if($passwordChanged != NULL){
        header("Location: profile.php");
        die();
    }
}
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
    <title>Change Password - Camagru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link href="style/index.css" rel="stylesheet">
    <link href="style/profile.css" rel="stylesheet">
</head>

<body>
<?php include_once './inc/header.php'; ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="reset" id="reset">
                <?php echo '
                    <form method="POST" action="changepass.php">
                        <h1>Change Password</h1>
                        <label>Old Password</label>
                        <input type="password" name="opassword" required/>   
                        <label>New Password</label>
                        <input type="password" name="npassword" />   
                        <label>Confirm New Password</label>
                        <input type="password" name="cpassword" />';
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