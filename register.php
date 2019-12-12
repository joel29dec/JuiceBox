<?php
    include("includes/config.php");
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");
    $account = new Account($con);
    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");
    
    function getInputValue($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to JuiceBox</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
    <?php
    if(isset($_POST['registerButton'])){
        echo '<script>
                $(document).ready(function(){
                    $("#loginForm").hide();
                    $("#registerForm").show();
                })
            </script>';
    }else{
        echo '<script>
                $(document).ready(function(){
                    $("#loginForm").show();
                    $("#registerForm").hide();
                })
            </script>';
    }
    ?>
    
    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">
                <form id="loginForm" action="register.php" method="POST">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed);?>
                        <label for="loginUsername">Username</label>
                        <input id="loginUsername" name="loginUsername" type="text" placeholder="Happy Gilmore" value="<?php getInputValue('loginUsername');?>">
                    </p>
                    <p> 
                        <label for="loginPassword">Password</label>
                        <input id="loginPassword" name="loginPassword" type="password">
                    </p>
                    <button type="submit" name="loginButton">Log In</button>

                    <div class="hasAccountText">
                        <span id="hideLogin">Don't have an account yet? Signup here</span>
                    </div>
                </form>
        
                <form id="registerForm" action="register.php" method="POST">
                    <h2>Create your free account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$usernameCharacters);?>
                        <?php echo $account->getError(Constants::$usernameTaken);?>
                        <label for="username">Username</label>
                        <input id="username" name="username" type="text" placeholder="Happy Gilmore" value="<?php getInputValue('username');?>">
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$firstnameCharacters);?>
                        <label for="firstname">First Name</label>
                        <input id="firstname" name="firstname" type="text" placeholder="David" value="<?php getInputValue('firstname');?>">
                    </p>
                    <p> 
                        <?php echo $account->getError(Constants::$lastnameCharacters);?>
                        <label for="lastname">Last Name</label>
                        <input id="lastname" name="lastname" type="text" placeholder="Copperfield" value="<?php getInputValue('lastname');?>">
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$emailCharacters);?>
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" placeholder="something@interesting.com" value="<?php getInputValue('email');?>">
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$emailsDoNotMatch);?>
                        <?php echo $account->getError(Constants::$emailInvalid);?>
                        <?php echo $account->getError(Constants::$emailTaken);?>
                        <label for="email2">Confirm Email</label>
                        <input id="email2" name="email2" type="email" placeholder="something@interesting.com" value="<?php getInputValue('email2');?>">
                    </p>
                    <p> 
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch);?>
                        <?php echo $account->getError(Constants::$passwordsDoNotAlpha);?>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch);?>
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" placeholder="Your Password">
                    </p>
                    <p> 
                        <label for="password2">Confirm Password</label>
                        <input id="password2" name="password2" type="password">
                    </p>
                    <button type="submit" name="registerButton">Sign Up</button>
                    <div class="hasAccountText">
                        <span id="hideRegister">Already have an Account? Login Here</span>
                    </div>
                </form>
            </div>
            <div id="loginText">
                <h1>Get Great Music, right now</h1>
                <h2>Listen to songs for free</h2>
                <ul>
                    <li>Discover music you'll fall in love with</li>
                    <li>Create your own playlist</li>
                    <li>Follow artists to keep up to date</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>