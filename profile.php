<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    die();
}
include_once 'classes/Auth.php';
include_once 'classes/images.class.php';
include_once 'functions/mail.php';
$user = new Auth();
$gen = new Images();
$mail = new Mail();
// image stuff
//XHR TEST



$id = $_SESSION['id'];
$image = $user->getProfileimg($id);

// $url = $image['profilpic'];


$userinfo = $user->userinfo($_SESSION['email']);

$errors = array('password' => '', 'cpassword' => '', 'match' => '', 'len' => '');



// Uploaded image
if (isset($_POST['uphoto']) && $_POST['uphoto'] != '') {

    $PreviousProfilPic = $gen->getPreviousProfilPic($id);
    print_r($PreviousProfilPic);
//    exit();
    $profilImage = $gen->generateImage($_POST['uphoto']);
    if ($gen->insertProfilPic($id, $profilImage)){
        if ($PreviousProfilPic['profilpic'] != './img/profile.png')
            unlink($PreviousProfilPic['profilpic']);
    }
}


if(isset($_POST['changenotification']) && $_POST['changenotification'] != ''){
    if($_POST['notification'] != 'on'){
        $mail->disableNotification($_SESSION['email']);
    }
    else {
        $mail->enableNotification($_SESSION['email']);
    }
    header("Refresh:0");
//    print_r($_POST);
}

if (isset($_POST['update']) && $_POST['update'] != '') {


    if (!is_string($_POST['full_name']) || !is_string($_POST['email']) || !is_string($_POST['username']) || !is_string($_POST['password'])) {
        http_response_code(505);
        exit();
    }

    //Check Full Name
    if (empty($_POST['full_name'])) {
        $errors['full_name'] = 'Full name is required';
    } else {
        $full_name = $user->test_input($_POST['full_name']);
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

    // Check username
    if (empty($_POST['username'])) {
        $errors['username'] = 'username is required';
    } else {
        $username = $user->test_input($_POST['username']);
    }

    // Check Password
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    } else {
        $password = $user->test_input($_POST['password']);
        $userLogged = $user->login($_SESSION['email']);

        if ($userLogged != NULL) {
            if (password_verify($password, $userLogged['password'])) {
                if ($user->ChangeProfil($_SESSION['id'], $full_name, $email, $username)){
                    $_SESSION['id'] = $userLogged['id'];
                    $_SESSION['email'] = $email;
                    $_SESSION['username'] = $username;
                    header("Location: profile.php");
                    die();
                }
            }
            else {
                $errors['Error'] = 'Incorrect Password';
            }
        } else {
            $errors['Error'] = 'Something Be wrong';
        }
    }

    //Check Errors or user exists
    if (!empty($errors['full_name']) || !empty($errors['email']) || !empty($errors['username']) ||
        !empty($errors['password']) || !empty($errors['Error'])) {
        goto end;
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
    <title>Profile - Camagru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link href="style/index.css" rel="stylesheet">
    <link href="style/profile.css" rel="stylesheet">
</head>

<body>

<?php include_once './inc/header.php'; ?>

<!-- Content -->
<div class="content">
    <div class="container">

        <div class="row" style="margin-top: 5%">
            <div class="col-sm-4" style="margin-bottom: 10%">
                <h1 style="margin-bottom: 20%;">Photo</h1>
                <h3 style="margin-bottom: 20%;">@<?php echo $_SESSION['username']; ?></h3>
                <img id="imgFileUpload" class="img-circle" width="200" height="200" alt="Select File" title="Select File" src="<?php echo $image['profilpic']; ?>" style="cursor: pointer" />
                <br />
                <span id="spnFilePath"></span>
                <input type="file" id="FileUpload1" accept="image/*" style="display: none" />

            </div>
            <?php echo '
                <div class="col-sm-8">
                    <form id="form-1" method="POST" action="profile">
                        <h1>Edit Profile</h1>
                        <label>Full Name</label>
                        <input type="text" name="full_name" value="'.$userinfo['full_name'].'" required />

                        <label>Email</label>
                        <input type="email" name="email" value="'.$userinfo['email'].'" required />

                        <label>Username</label>
                        <input type="text" name="username" value="'.$userinfo['username'].'" required />

                        <label>Password</label>
                        <input type="password" name="password"  required/>
                        
                        <input type="submit" style="margin: 5% 0 5%;" class="btn" name="update"  value="Update Profile">
                        </form>
                        ';
            foreach ($errors as $key => $value) {
                if (!empty($value)) {
                    echo '<div class="red-alert">'.$value.'</div>';
                }
            }
            echo ' 
                    <form id="form-2" method="POST" action="profile.php">
                         <label>Email Notification</label>
                        <input type="checkbox" id="notification" name="notification"';if ($userinfo['notification'] == 1){echo 'value="on"' . ' ' . 'checked';}echo '>
                        <input type="submit" style="margin: 5% 0 5%;" class="btn" name="changenotification"  value="Change Notification">
                    </form>
                    
                    <form id="form-3" method="POST" action="changepass.php">
                        <input type="submit" style="margin: 5% 0 5%;" class="btn" name="changepassword"  value="Change Password">
                    </form>
                </div>';
            ?>
        </div>
    </div>
</div>
<?php include_once './inc/footer.php'; ?>
<script>

    window.onload = function () {
        var fileupload = document.getElementById("FileUpload1");
        var filePath = document.getElementById("spnFilePath");
        var image = document.getElementById("imgFileUpload");

        var request = new XMLHttpRequest();
        var data = new FormData();


        image.onclick = function () {
            fileupload.click();
        };
        fileupload.onchange = function () {
            var file = this.files[0];

            if (file && file.size){
                const reader = new FileReader()
                reader.readAsDataURL(file);
                reader.onload = function() {
                    image.src = reader.result;
                    request.open('POST', 'profile.php');
                    data.append('uphoto', reader.result);
                    request.onload = function () {
                        // alert(request.responseText);
                        // console.log(request.responseText);
                    }
                    request.send(data);
                };
            }

        };
    };
</script>
</body>
</html>