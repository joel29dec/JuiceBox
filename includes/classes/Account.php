
<?php
class Account{
    private $con;
    private $errorArray;
    public function __construct($con){
        $this->con = $con;
        $this->errorArray = array();
    }

    public function login($username, $password){
        $password = md5($password);
        $query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$username' AND password='$password'");
        if(mysqli_num_rows($query) == 1){
            return true;
        }else{
            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }
    }

    public function register($username, $firstname, $lastname, $email,$email2, $password, $password2){
        $this->validateUsername($username);
        $this->validateFirstname($firstname);
        $this->validateLastname($lastname);
        $this->validateEmails($email,$email2);
        $this->validatePasswords($password, $password2);

        if(empty($this->errorArray)){
            //insert into db
            return $this->insertUserDetails($username, $firstname,$lastname, $email, $password);
        }else{
            return false;
        }
    }

    private function insertUserDetails($username, $firstname,$lastname, $email, $password){
        $encryptedPw = md5($password);
        $profilePic = "assets/images/profile-pics/head_emerald.png";
        $date = date("Y-m-d");
        $result = mysqli_query($this->con,"INSERT INTO users VALUES (null, '$username', '$firstname', '$lastname', '$email', '$encryptedPw', '$date', '$profilePic')");
        return $result;
    }

    public function getError($error){
        if(!in_array($error, $this->errorArray)){
            $error = "";
        }
        return "<span class='errorMessage'>$error<span>";
    }

    private function validateUsername($username){
        if(strlen($username) > 25 || strlen($username) < 5){
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$username'");
        if(mysqli_num_rows($checkUsernameQuery)!= 0){
            array_push($this->errorArray, Constants::$usernameTaken);
            return;
        }
    }
    
    private function validateFirstname($firstname){
        if(strlen($firstname) > 25 || strlen($firstname) < 2){
            array_push($this->errorArray, Constants::$firstnameCharacters);
            return;
        }
    }
    
    private function validateLastname($lastname){
        if(strlen($lastname) > 25 || strlen($lastname) < 2){
            array_push($this->errorArray, Constants::$lastnameCharacters);
            return;
        }
    }
    
    private function validateEmails($email, $email2){
        if($email != $email2){
            array_push($this->errorArray, Constants::$emailsDoNotMatch);
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $checkEmailQuery = mysqli_query($this->con, "SELECT username FROM users WHERE email='$email'");
        if(mysqli_num_rows($checkEmailQuery)!= 0){
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        }

    }
    
    private function validatePasswords($password, $password2){
        if($password != $password2){
            array_push($this->errorArray, Constants::$passwordsDoNotMatch);
            return;
        }

        if(preg_match('/[^A-Za-z0-9]/', $password)){
            array_push($this->errorArray, Constants::$passwordsDoNotAlpha);
            return;
        }
        if(strlen($password) > 30 || strlen($password) < 5){
            array_push($this->errorArray, Constants::$passwordsCharacters);
            return;
        }

    }
}

?>
