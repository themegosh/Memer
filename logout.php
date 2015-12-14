<?php
define('ABSPATH', ((strlen(dirname($_SERVER['PHP_SELF'])) > 1) ? str_replace(dirname($_SERVER['PHP_SELF']), '', str_replace('\\', '/', dirname( __FILE__ ))) : dirname( __FILE__ )) .'/');
require_once (ABSPATH . 'util/includes.php');

$result = "";

if (isset($_GET['logout']))
{
    if (isset($_SESSION['user'])){
        session_destroy();
        $result .= "<div class='alert alert-success'>Logged out successfully. Redirecting to login.</div>
         <meta http-equiv=refresh content='0;url=/login.php'>";
    }
    
    
}
else {
    $result = '<div class="alert alert-danger" role="alert">You aren\'t logged on. Redirecting to login.</div>
    <meta http-equiv=refresh content="1;url=/login.php"';
}



/*************************************
		START Header Data
*************************************/
$pageTitle = "Memer - Log Out";
$activeNav = 'logout';

require (ABSPATH.PAGESPATH.'header.php');
/*************************************
		END Header Data
*************************************/



?>

        <div class='headerSection'>
            <div class='container'>
                <h1><i class="fa fa-angle-double-right"></i>Log Out</h1>
            </div>
        </div>
<?php echo $result; ?>



<?php


/*************************************
		START Footer Data
*************************************/

$otherFooterData = "";

require_once (ABSPATH.PAGESPATH.'footer.php');
/*************************************
		END Footer Data
*************************************/