<?php

session_start();

include "layouts/header.php";

$message = '';
$error = '';

if (isset($_POST["submit"])) {
    if (empty($_POST["email"])) {
        $error = "<label class='text-danger'>Enter Email</label>";
    } else if (empty($_POST["password"])) {
        $error = "<label class='text-danger'>Enter Password</label>";
    } else {

        $_POST['base'] == 'json';
        $file = file_get_contents('login.json');
        $json = json_decode($file);
        
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        foreach ($json as $item) {
            if ($item->email == $email && $item->password == $password) {
                $_SESSION['email'] = $email;
                sleep(1);
                exit("<meta http-equiv='refresh' content='0; url=profile.php'>");
            } else {
                $message = "<label class='text-danger'>The email or password entered does not match any account</label>";
            }
        }
    }
}
?>

<div class="wrapper fadeInDown">
    <div id="formContent">
        <div class="fadeIn first">
            <h1>Login<h1>
        </div>
        <form method="POST"> 
        <div>
            <input type="text" id="email" class="fadeIn third" name="email" placeholder="email"> 
            <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
        </div>
        <div>
            <button type="submit" id="submit" class="btn btn-primary btn-lg  login-button" name="submit">Login</button>
        </div>
        </form>
        
        <div id="formFooter">
            <a>if you are not registered click</a>
            <a class="underlineHover" href="registration.php">Registration</a>
        </div>
    </div>
</div>

<?php 

include "layouts/footer.php";

?>