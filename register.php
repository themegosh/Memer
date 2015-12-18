<?php
//the path to the installed dir
define('ABSPATH', ((strlen(dirname($_SERVER['PHP_SELF'])) > 1) ? str_replace(dirname($_SERVER['PHP_SELF']), '', str_replace('\\', '/', dirname( __FILE__ ))) : dirname( __FILE__ )) .'/');
require_once (ABSPATH . 'util/includes.php');

//there is going to be more here for handling errors

//some constants
$USERNAME_MIN = 4;
$USERNAME_MAX = 70;
$EMAIL_MAX = 254;
$PASS_MIN = 5;
$PASS_MAX = 70;

//vars to use
$hasError = false; //boolean
$result = "";
$registrationComplete = false;

$username = "";
$usernameError = "";
$usernameErrorClass = "";
$email = "";
$emailError = "";
$emailErrorClass = "";
$pass = "";
$passError = "";
$passErrorClass = "";
$passConf = "";
$passConfError = "";
$passConfErrorClass = "";

if (isset($_POST['contactSubmit']))
{
    $username = $_POST['inputUsername'];
    $email = $_POST['inputEmail'];
    $pass = $_POST['inputPassword'];
    $passConf = $_POST['inputConfPassword'];
    
    //validate
    if (strlen($username) > $USERNAME_MAX)
    {
        $userNameError = "<label class='control-label'>Your username is too long...</label>";
        $userNameErrorClass = "has-error";
        $hasError = true;
    }
    if (strlen($username) < $USERNAME_MIN)
    {
        $usernameError = "<label class='control-label'>Your username is too short...</label>";
        $usernameErrorClass = "has-error";
        $hasError = true;
    }
    if (!preg_match("/^[a-zA-Z0-9]+$/", $username) == 1) {
        $forumNickError = "<label class='control-label'>Your username may contain only numbers and letters.</label>";
        $forumNickErrorClass = "has-error";
        $hasError = true;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $emailError = "<label class='control-label'>This email address doesnt look quite right...</label>";
        $emailErrorClass = "has-error";
        $hasError = true;
    }
    if (strlen($pass) > $PASS_MAX)
    {
        $passError = "<label class='control-label'>The password you have entered is too long...</label>";
        $passErrorClass = "has-error";
        $hasError = true;
    }
    if (strlen($pass) < $PASS_MIN)
    {
        $passError = "<label class='control-label'>The password you have entered is too short...</label>";
        $passErrorClass = "has-error";
        $hasError = true;
    }  
    if ($pass != $passConf)
    {
        $passConfError = "<label class='control-label'>The passwords you have entered do not match...</label>";
        $passConfErrorClass = "has-error";
        $hasError = true;
    }
    
    if ($hasError == false)
    {
        try {
            
            //set up db var
            $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME."", DB_USER, DB_PASSWORD);
            
            //check if username is in use
            $qry = $db->prepare("SELECT count(*) FROM users WHERE username=?");
            $qry->execute(array($username));
            $row = $qry->fetch(PDO::FETCH_ASSOC);
            if (intval($row['count(*)']) != 0) {
                $usernameError = "<label class='control-label'>That Username has already been taken.</label>";
                $usernameErrorClass = "has-error";
                $hasError = true;
            }
            
            //passed sanitization and duplication checks
            if (!$hasError) {
                //encrypt pass
                $cPass = SHA1(strtoupper($username).":".strtoupper($pass));
                //prepare statement
                $cQry1 = $db->prepare("INSERT INTO users(username, password, email) VALUES (?, ?, ?)");
                //execute
                $cQry1->execute(array($username, $cPass, $email));
                
                $result = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Registration complete.</div>';
                $username = '';
                $email = '';
                $registrationComplete = true;
            }
        }
        catch(PDOException $e) {
            $hasError = true;
            $result = '<div class="alert alert-danger" role="alert"><strong>Error!</strong> Something seriously went wrong with registration. '.$e->getMessage().'</div>';
        }
        catch(Exception $e) {
            $hasError = true;
            $result = '<div class="alert alert-danger" role="alert"><strong>Error!</strong> Something seriously went wrong with registration. '.$e->getMessage().'</div>';
        }
    }
    //unset these no matter what
    $pass = '';
    $passConf = '';
}



/*************************************
		START Header Data
*************************************/
$pageTitle = "Memer - Register";
$activeNav = 'register';

require_once (PAGESPATH.'header.php');
/*************************************
		END Header Data
*************************************/



?>

        <div class='headerSection'>
            <div class='container'>
                <h1><i class="fa fa-angle-double-right"></i>Register</h1>
            </div>
        </div>
<?php
    echo $result;
?>

        <div class='container medForm'>
            <h2 class='text-center'>Register to save your memes!</h2>
<?php 
if (!$registrationComplete)
{
?>
            <form role="form" class='form-horizontal' name='registrationForm' method='post'>
                <div class="form-group <?php echo $usernameErrorClass; ?>">
                    <label class='col-lg-3 control-label' for="inputUsername">Username: <span class='color-red'>*</span></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="inputUsername" placeholder="Your username" name='inputUsername' value='<?php echo $username; ?>'>
                        <?php echo $usernameError; ?>
                    </div>
                </div>
                
                <div class="form-group <?php echo $emailErrorClass; ?>">
                    <label class='col-lg-3 control-label' for="inputEmail">Email: <span class='color-red'>*</span></label>
                    <div class="col-lg-9">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Your email" name='inputEmail' value='<?php echo $email; ?>'>
                        <?php echo $emailError; ?>
                    </div>
                </div>
				
				<div class="form-group <?php echo $passErrorClass; ?>">
                    <label class='col-lg-3 control-label' for="inputPassword">Password: <span class='color-red'>*</span></label>
                    <div class="col-lg-9">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Your password" name='inputPassword' value='<?php echo $pass; ?>'>
                        <?php echo $passError; ?>
                    </div>
                </div>
                
                <div class="form-group <?php echo $passConfErrorClass; ?>">
                    <label class='col-lg-3 control-label' for="inputMessage">Confirm Password: <span class='color-red'>*</span></label>
                    <div class="col-lg-9">
                        <input type="password" class="form-control" id="inputConfPassword" placeholder="Confirm password" name='inputConfPassword' value='<?php echo $passConf; ?>'>
                        <?php echo $passConfError; ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="text-center col-lg-12">
                        <button name='contactSubmit' type="submit" class="btn btn-lg btn-primary"><i class="fa fa-flag-checkered"></i> Register</button>
                    </div>
                </div>
            </form>
<?php
}
else
{
?>
                                <div class="text-center">

                                
                                    <a class='btn btn-primary btn-lg' href='login.php'>Login</a>
                                </div>
<?php
}
?> 
        </div>


<?php


/*************************************
		START Footer Data
*************************************/

$otherFooterData = "";

require_once (PAGESPATH.'footer.php');
/*************************************
		END Footer Data
*************************************/