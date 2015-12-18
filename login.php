<?php
define('ABSPATH', ((strlen(dirname($_SERVER['PHP_SELF'])) > 1) ? str_replace(dirname($_SERVER['PHP_SELF']), '', str_replace('\\', '/', dirname( __FILE__ ))) : dirname( __FILE__ )) .'/');
require_once (ABSPATH . 'util/includes.php');

//some constants
$FIELD_MAX = 50;

//vars to use
$successfulLogin = false;
$result = "";
$username = "";
$password = "";
$disable = "";

if (isset($_GET['logout']) && isset($_SESSION['user'])) { //trying to log out
	session_destroy();
	$result .= "<div class='alert alert-success'>Logged out successfully. Redirecting to login.</div>
	 <meta http-equiv=refresh content='0;url=/login.php'>";
}
else if (isset($_SESSION['user'])) { //logged in
	$disable = "disabled";
    $result .= '<div class="alert alert-danger" role="alert"><strong>You are already logged in, redirecting home in 5 sec.</div>'
            . '<meta http-equiv=refresh content="2;url=/index.php">';
}
else { //not logged in
	if (isset($_POST['loginSubmit']))
	{
		$username = $_POST['inputUsername'];
		$password = $_POST['inputPassword'];
		
		try {
			$newLogin = new User($username, $password);
			//if login fails, it will throw a LoginException and never proceed beyond the above line (includes SQL errors)
			//assume valid login
			$successfulLogin = true;
			$result .= "<div class='alert alert-success'>Logged in successfully.</div><meta http-equiv=refresh content='2;url=/index.php'>";
			$username = "";
			$disable = "disabled";
		}
		catch(PDOException $e) {
			$successfulLogin = false;
			$result = '<div class="alert alert-danger" role="alert"><strong>Error! Something seriously went wrong with sign in.</strong><br/><br/> '.$e->getMessage().' </div>';
		}
		catch(Exception $e) {
			$successfulLogin = false;
			$result .= '<div class="alert alert-danger" role="alert"><strong>Error!</strong><br/><br/> '. $e->getMessage() .' </div>';
		}
		$password = "";
	}
}








/*************************************
		START Header Data
*************************************/
$pageTitle = "Memer - Log In";
$activeNav = 'login';

require (PAGESPATH.'header.php');
/*************************************
		END Header Data
*************************************/



?>

        <div class='headerSection'>
            <div class='container'>
                <h1><i class="fa fa-angle-double-right"></i>Log In</h1>
            </div>
        </div>
<?php echo $result; ?>

        <div class='container medForm'>
            <h2 class='text-center'>Log in to save your memes!</h2>
            <form role="form" class='form-horizontal' name='loginForm' method='post'>
                <div class="form-group">
                    <label class='col-lg-2 control-label' for="inputUsername">Username:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputUsername" placeholder="Your Username" name='inputUsername' value='<?php echo $username; ?>' <?php echo $disable; ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class='col-lg-2 control-label' for="inputPassword">Password:</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Your password" name='inputPassword' value='<?php echo $password; ?>' <?php echo $disable; ?>>
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center col-lg-12">
                        <button name='loginSubmit' type="submit" class="btn btn-lg btn-primary" <?php echo $disable; ?>><i class="fa fa-rocket" <?php echo $disable; ?>></i> Log In</button>
                    </div>
                </div>
            </form>
            
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