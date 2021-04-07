<?php
session_start();
if (isset($_SESSION['email'])) {
    header("Location: index.php");
    die();
}

require_once 'classes/Auth.php';
require_once 'functions/mail.php';
$user = new Auth();
$mail = new Mail();

$errors = array('email' => '');

if (isset($_GET['reset']) && $_GET['reset'] != ''){
    if (isset($_GET['email']) && $_GET['email'] != '') {
        //Check email
        if (empty($_GET['email'])) {
            $errors['email'] = 'Please fill in your email.';
        } else {
            $email = $user->test_input($_GET['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email must be a valid email address';
            }
        }
        //Check if Errors
        if (!empty($errors['email'])) {
            goto end;
        }

        $userFound = $user->CurrentUser($_GET['email']);


        // echo ($userFound['id']);
        // print_r($userFound);
        if ($userFound != null) {
            $token = uniqid();
            $token = str_shuffle($token);
            $id = $userFound['id'];

            // echo $id;
            if ($user->reset($id, $token)) {
                $errors['success'] = 'To login tap the button in the email we sent to' . ' ' . $email;
                $mail->resetViaToken($email, $token);
                // die();
            }
        } else {
            $errors['email'] = 'Email Not Found';
        }

    }else{
     exit();
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
    <title>Reset - Camagru</title>
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
                    <form method="GET" action="reset.php">
                        <h1>Reset</h1>
                        <label>Email</label>
                        <input type="email" name="email" value="<?php if (isset($email)){echo $email;}?>" />
                        <div class="red-alert"><?php if (isset($errors['email'])) {
                                echo $errors['email'];
                            } ?></div>
                        <div class="red-alert"><?php if (isset($errors['Error'])) {
                                echo $errors['email'];
                            } ?></div>
                        <div class="green-alert"><?php if (isset($_GET['reset']) && $userFound != NULL) {
                                echo $errors['success'];
                            } ?></div>
                        <br>
                        <input type="submit" class="btn" name="reset" value="reset">

                        <a href="login">
                            <h4 class="logbutton" id="logbutton">Login</h4>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'inc/footer.php'; ?>
</body>

</html>