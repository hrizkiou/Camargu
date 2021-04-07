<?php
session_start();
require_once 'classes/Auth.php';

$user = new Auth();


$errors = array('email' => '', 'password' => '');

$email = NULL;
$password = NULL;

if (isset($_SESSION['email'])) {
    header("Location: index.php");
    die();
}

if (isset($_POST['login']) && $_POST['login'] != '') {

    if (!is_string($_POST['email']) || !is_string($_POST['password'])) {
        header("Location: index.php");
        // http_response_code(505);
        exit();
    }

    //Check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required';
    } else {
        $email = $user->test_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address';
        }
    }

    // Check Password
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    } else {
        $password = $user->test_input($_POST['password']);
    }

    //Check if Email or user exists
    if (!empty($errors['email']) || !empty($errors['password'])) {
        goto end;
    }

    $userLogged = $user->login($email);
    if ($userLogged != NULL) {
        if (password_verify($password, $userLogged['password'])) {
            if ($userLogged['active'] != 0){
                $_SESSION['id'] = $userLogged['id'];
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $userLogged['username'];
                header("Location: index.php");
                die();
            }else{
                header("Location: verify.php?email=$email&token=");
                die();
            }
        }
        // $errors['reg'] = 'You are registred Successfully!';
        else {
            $errors['Error'] = 'Password is incorrect';
        }
    } else {
        $errors['Error'] = 'Something Be wrong';
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
    <title>Login - Camagru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link href="style/index.css" rel="stylesheet">
    <link href="style/profile.css" rel="stylesheet">
</head>

<body>
    <?php include_once './inc/header.php'; ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="login" id="login">
                    <form id="login" method="POST" action="login.php">
                        <h1>Login</h1>
                        <label>Email</label>
                        <input type="email" name="email" value="<?php if (isset($email)) {
                                                                    echo $email;
                                                                } ?>" />
                        <div class="red-alert"><?php echo $errors['email']; ?></div>
                        <label>Password</label>
                        <input type="password" name="password" />
                        <div class="red-alert"><?php echo $errors['password']; ?></div>
                        <div class="red-alert"><?php if (isset($errors['Error'])) {
                                                    echo $errors['Error'];
                                                } ?></div>
                        <br>
                        <input type="submit" class="btn" name="login" value="login">
                        <!-- <div onclick="login()" class="btn">Log In</div> -->
                        <a href="reset.php"><h4 class="resbutton" id="resbutton">Forgot Password!</h4></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'inc/footer.php'; ?>
</body>
</html>