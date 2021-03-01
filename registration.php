<?php

include 'layouts/header.php';

$message = '';
$error = '';
if(isset($_POST["submit"]  ))
{
    if(empty($_POST["firstname"]))
    {
        $error = "<label class='text-danger'>Enter firstname</label>";
    }
    else if(empty($_POST["lastname"]))
    {
        $error = "<label class='text-danger'>Enter lastname</label>";
    }
    else if(empty($_POST["email"]))
    {
        $error = "<label class = 'text-danger'>Enter email</label>";
    }
    else if(empty($_POST["password"]))
    {
        $error = "<label class='text-danger'>Enter password</label>";
    }
    else if(empty($_POST["gender"]))
    {
        $error = "<label class='text-danger'>Enter gender</label>";
    }
    else
    {
     if(file_exists('login.json'))
        {
            $current_data = file_get_contents('login.json');
            $array_data = json_decode($current_data, true);
            $extra = array(
                    'id'            =>     uniqid(),
                'firstname'         =>     $_POST['firstname'],
                'lastname'          =>     $_POST["lastname"],
                'email'             =>     $_POST["email"],
                'password'          =>     $_POST["password"],
                'gender'            =>     $_POST["gender"],
            );
            $array_data[] = $extra;
            $final_data = json_encode($array_data);
            if(file_put_contents('login.json', $final_data))
            {
                $message = "<label class='text-success'>File Appended Success fully</p>";
            }else{
                $error = 'JSON file is not exists';
            }
        }
    }
}



if(isset($_REQUEST['submit'])){
    $xml = new DOMDocument("1.0","UTF-8");
    $xml ->load("login.xml");

    $rootTag = $xml->getElementsByTagName("document")->item(0);
    $dataTag = $xml->createElement("data");

    $nameTag = $xml->createElement("firstname",$_REQUEST['firstname']);
    $surnameTag = $xml->createElement("lastname",$_REQUEST['lastname']);
    $emailTag = $xml->createElement("email",$_REQUEST['email']);
    $passwordTag = $xml->createElement("password",$_REQUEST['password']);
    $genderTag = $xml->createElement("gender",$_REQUEST['gender']);


    $dataTag -> appendChild($nameTag);
    $dataTag -> appendChild( $surnameTag);
    $dataTag -> appendChild($emailTag);
    $dataTag -> appendChild($passwordTag);
    $dataTag -> appendChild($genderTag);

    $rootTag ->appendChild($dataTag);

    $xml->save("login.xml");

}

?>

<div class="wrapper fadeInDown">
    <div id="formContent">
        <div class="fadeIn first">
            <h1>Registration<h1>
        </div>
        <form method="POST">
            <div class="form-group">
                <input type="text" id="firstname" class="fadeIn third" name="firstname" placeholder="firstname">
                <input type="text" id="lastname" class="fadeIn third" name="lastname" placeholder="lastname">
                <input type="text" id="email" class="fadeIn third" name="email" placeholder="email">
                <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
            </div>
            <div class="radio">
                <label class="radio-inline"><input type="radio" name="gender" value="male">Male</label>
                <label class="radio-inline"><input type="radio" name="gender" value="female">Female</label>
                <label class="radio-inline"><input type="radio" name="data" value="json">JSON</label>
                <label class="radio-inline"><input type="radio" name="data" value="xml">XML</label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-lg  login-button" name="submit">Register</button>
            </div>
        </form>
        <div id="formFooter">
        <a>if you are registered click</a>
            <a class="underlineHover" href="index.php">Login</a>
        </div>
    </div>
</div>

<?php

include 'layouts/footer.php';

?>