<?php
/* 
	CMS 0.1
*/

//the path to the installed dir
define( 'ABSPATH', dirname(__FILE__) . '/' );
//set up the constants, clases and functions
require_once (ABSPATH . 'util/includes.php');



$result = "";
$notification = "";

try {
    
    //set up a new DB connection
    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME."", DB_USER, DB_PASSWORD);
    
    //select all memes from database
    $qry = $db->prepare("SELECT username, title, path FROM memes, users WHERE memes.`user_id` = users.`id` ORDER BY memes.id DESC LIMIT 3");
    $qry->execute(null);
    
    while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
        $result .= "<div class='col-md-4'>
                <h3>".$row['title']."</h3>
                <h6>Created by: ".$row['username']."</h6>
                <div class='box'><img src='".$row['path']."'/></div>
            </div>";
    }
    $qry = null;
    
    //getting the count of total memes in DB
    $qry = $db->prepare("SELECT COUNT(*) FROM memes");
    $qry->execute(null);
    $row = $qry->fetch(PDO::FETCH_ASSOC);
    $totalMemes = $row['COUNT(*)'];
}
catch (PDOException $e) {
    $notification .= '<div class="alert alert-danger" role="alert"><strong>Error! Something seriously went wrong with searching.</strong><br/><br/> '.$e->getMessage().' </div>';
}




/*************************************
		START Header Data
*************************************/
$pageTitle = "Memer - Home";
$otherHeaderIncludes = "";
$activeNav = 'home';

require_once (ABSPATH.PAGESPATH.'header.php');
/*************************************
		END Header Data
*************************************/

?>

        <div class='container'>
            <div class='hello'>
                <div class='col-md-12'>
                    <h1>Upload to create your own cool <span class='blue'> memes </span> to download and use anywhere.</h1>
                </div>
            </div>
        </div>


        <div class='headerSection'>
            <div class='container'>
                <h2 class='text-center'>Recently Created Memes</h2>
            </div>
		</div>
        <div class='container recentMemes'>
            <?php echo $result; ?>
        </div>

        
		


<?php


/*************************************
		START Footer Data
*************************************/

$otherFooterData = "
    <script src='".JSPATH."index.js' type='text/javascript'></script>
";

require_once (ABSPATH.PAGESPATH.'footer.php');
/*************************************
		END Footer Data
*************************************/