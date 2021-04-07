<?php
session_start();
require_once 'classes/Auth.php';
require_once 'functions/mail.php';

$user = new Auth();
$mail = new Mail();


$errors = array('full_name' => '', 'email' => '', 'username' => '', 'password' => '');

$full_name = NULL;
$email = NULL;
$username = NULL;
$password = NULL;

if (isset($_SESSION['email'])) {
    header("Location: index.php");
    die();
}

if (isset($_POST['register']) && $_POST['register'] != '') {


    if (!is_string($_POST['full_name']) || !is_string($_POST['email']) || !is_string($_POST['username']) || !is_string($_POST['password'])) {
        http_response_code(505);
        exit();
    }
    //Check Full Name

    if (empty($_POST['full_name'])) {
        $errors['full_name'] = 'Full name is required';
    }
    elseif (strlen(trim($_POST['full_name'])) <= 0 || strlen($_POST['username']) < 8){
        $errors['full_name'] = 'Full name should not be empty';
    } else {
        $full_name = $user->test_input($_POST['full_name']);
    }

    //Check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors['remail'] = 'Email must be a valid email address';
    }
    else {
        $email = $user->test_input($_POST['email']);
    }


    // Check username
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username is required';
    }
    elseif (strlen(trim($_POST['username'])) <= 0 || strlen($_POST['username']) < 8){
        $errors['username'] = 'Username must be at least 8 characters in length';
    } else {
        $username = $user->test_input($_POST['username']);
    }

    // Check Password
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    }
    elseif (strlen(trim($_POST['password'])) <= 0 || strlen($_POST['password']) <= 8) {
        $errors['password'] = 'Your password must be at least 8 characters long. Please try another.';
    }
    elseif(!preg_match("#[0-9]+#",$_POST['password'])) {
        $errors['password'] = "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$_POST['password'])) {
        $errors['password'] = "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$_POST['password'])) {
        $errors['password'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
    }
    else {
        $password = $user->test_input($_POST['password']);
        $hpass = password_hash($password, PASSWORD_DEFAULT);
    }

    //Check Errors or user exists
    if (!empty($errors['full_name']) || !empty($errors['email']) || !empty($errors['username']) || !empty($errors['password'])) {
        goto end;
    }

    // Check if user exists in db
    if ($user->user_exist($username) || $user->email_exist($email)) {
        $errors['Areg'] = 'This E-mail or Username is already Registred';
    } else {
        $token = uniqid();
        $token = str_shuffle($token);
        if ($user->register($full_name, $email, $username, $hpass, $token)) {
            echo '<script>alert("Your account has been Created Successfully");</script>';
            echo '<script>setTimeout(function() {
              location.href = "/camagru/index"
            }, 500);</script>';
            //Send Mail To user
            $mail->sendVerificationEmail($email, $token);
            die();
        } else {
            echo 'Something went wrong! Try again later!';
        }
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
    <title>Register - Camagru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link href="style/index.css" rel="stylesheet">
    <link href="style/profile.css" rel="stylesheet">

</head>

<body>
    <?php include_once './inc/header.php'; ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="register" id="register">
                    <form method="POST" action="register.php">
                        <h1>Register</h1>
                        <label>Full Name</label>
                        <input type="text" name="full_name" value="<?php if (isset($full_name)) {
                                                                        echo $full_name;
                                                                    } ?>" required/>
                        <div class="red-alert"><?php echo $errors['full_name']; ?></div>
                        <label>Email</label>
                        <input type="email" name="email" value="<?php if (isset($email)) {echo $email;} ?>" required/>
                        <div class="red-alert"><?php echo $errors['email']; ?></div>
                        <label>Username</label>
                        <input type="text" name="username" value="<?php if (isset($username)) { echo $username;} ?>" required/>
                        <div class="red-alert"><?php echo $errors['username']; ?></div>
                        <label>Password</label>
                        <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" -->
                        <input type="password" name="password" required/>
                        <?php 
                        if(isset($errors['password'])){
                            echo '<div class="red-alert">'.$errors['password'].'</div>';
                        }
                        ?>
                        <div class="red-alert"><?php if (isset($errors['Areg'])) { echo $errors['Areg'];} ?></div>
                        <br>
                        <input type="submit" class="btn" name="register" value="register">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'inc/footer.php'; ?>
</body>

</html>