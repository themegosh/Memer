<?php
define('ABSPATH', ((strlen(dirname($_SERVER['PHP_SELF'])) > 1) ? str_replace(dirname($_SERVER['PHP_SELF']), '', str_replace('\\', '/', dirname( __FILE__ ))) : dirname( __FILE__ )) .'/');
require_once (ABSPATH . 'util/includes.php');

$result = "";
$notification = "";
$id = "";
$username = "";
$title = "";
$path = "";
$date = "";
$totalShown = 0;
$totalMemes = 0;
$txtSearch = "";

try {
    
    //set up a new DB connection
    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME."", DB_USER, DB_PASSWORD);
    
    //deleting a memed owned by user
    if (isset($_GET['delete']) && isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $delete = intval($_GET['delete']);
        
        $qry = $db->prepare("SELECT COUNT(*), path FROM memes WHERE user_id=? AND id=?");
        $qry->execute(array($user->getId(), $delete));
        $row = $qry->fetch(PDO::FETCH_ASSOC);
        
        if (intval($row['COUNT(*)']) == 1) { //we have a permission match, delete the image
            if (file_exists($row['path']))
                unlink($row['path']);
            $qry = null;
            $qry = $db->prepare("DELETE FROM memes WHERE id = ?");
            $qry->execute(array($delete));
            $notification .= "<div class='alert alert-success'>Meme Deleted.</div>";
        }
    }
    
    
    //newly created meme
    if (isset($_GET['id'])) { //using the meme id to search
        $sid = intval($_GET['id']);
        $qry = $db->prepare("SELECT username, memes.`id`, title, path, date FROM memes, users WHERE memes.`user_id` = users.`id` AND memes.`id` = ?");
        $qry->execute(array($sid));
    }
    //save the search string
    else {
        if (isset($_GET['txtSearch'])) //using the search string to search
            $txtSearch = $_GET['txtSearch'];
        
        //select all memes from database
        $qry = $db->prepare("SELECT username, memes.`id`, title, path, date FROM memes, users WHERE memes.`user_id` = users.`id` AND title LIKE ?");
        $qry->execute(array("%".$txtSearch."%"));
        
    }
    
    //displaying the results from the search
    while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $username = $row['username'];
        $title = $row['title'];
        $path = $row['path'];
        $date = $row['date'];
        $totalShown++;
        
        $deleteMeme = "";
        if (isset($_SESSION['user'])){ //if the session is the same as the user who made the image, show a delete button
            $user = $_SESSION['user'];
            
            if ($user->getUsername() == $row['username']) {
                $deleteMeme = " - <a href='memes.php?delete=".$row['id']."'><i class='fa fa-trash'></i> Delete Meme</a>";
            }
        }
        
        $result .= "<div class='container'>
            <div class='row memeList text-center'>
                <h1>".$row['title']."</h1>
                <h5>Created by: ".$row['username']." on ".$row['date']." ".$deleteMeme."</h5>
                <img src='".$row['path']."'/>
            </div>
            <hr/>
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
$pageTitle = "Memer - Browse Memes";
$activeNav = 'search';

require (PAGESPATH.'header.php');
/*************************************
		END Header Data
*************************************/



?>
        <div class='headerSection'>
            <div class='container'>
                <h1><i class="fa fa-angle-double-right"></i>Browse Memes</h1>
            </div>
        </div>
        <?php echo $notification; ?>

        <div class='container medForm'>
            <form role="form" class='form-horizontal' name='searchForm' method='get'>
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Search for Memes</h3>
                        <div class="input-group">
                            <input type="text" name='txtSearch' class="form-control" placeholder="Search for..." value="<?php echo $txtSearch; ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Search</button>
                            </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </form>
            <div class='col-md-12'>
                <h5>Showing <?php echo $totalShown; ?> of <?php echo $totalMemes; ?> memes in database based on search parameters.</h5>
            </div>
        </div>
        
        

        <?php echo $result; ?>


<?php


/*************************************
		START Footer Data
*************************************/

$otherFooterData = "";

require_once (PAGESPATH.'footer.php');
/*************************************
		END Footer Data
*************************************/