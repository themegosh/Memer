<?php
define('ABSPATH', ((strlen(dirname($_SERVER['PHP_SELF'])) > 1) ? str_replace(dirname($_SERVER['PHP_SELF']), '', str_replace('\\', '/', dirname( __FILE__ ))) : dirname( __FILE__ )) .'/');
require_once (ABSPATH . 'util/includes.php');

$view = "";
$notification = "";
$result = "";
$error = "";
$validImage = true;
$createImage = false;
$user = false;
$disableSave = "";
$img = "";
$title = "";
$topText = "";
$bottomText = "";
$info = "";

//delete the image to start over
if (isset($_POST['trashImage']) && isset($_SESSION['createImg'])){
    if ($_POST['trashImage'] == "true"){
        if (file_exists($_SESSION['createImg']))
            unlink($_SESSION['createImg']);
        if (isset($_SESSION['createImg']))
            unset($_SESSION['createImg']);
        $notification .= "<div class='alert alert-warning'>Image Discarded.</div>";
    }
}

if (isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $info .= "<p>When you hit save, your meme will be saved in our database for others to enjoy.</p>";
} else {
    $notification .= "<div class='alert alert-warning'>You are not logged in and as a result, will not be able to save your memes. <a href='login.php'>Log In</a> or <a href='register.php'>Register</a>.</div>";
    $info .= "<p>If you log in you can save your memes for others to see. <br/><br/> You can right click the image and \"Save Image As\" whenever you wish.</p>";
    $disableSave = "disabled";
}

//here, we are uploading a fresh image
if (!isset($_SESSION['createImg'])){
    if (isset($_POST['uploadSubmit'])){ //we are handling an upload
    
    $fileName = ".".MEMEPATH.round(microtime(true)) . '.' . end(explode(".", $_FILES["uploadImg"]["name"]));
        $imageFileType = pathinfo($fileName,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["uploadImg"]["tmp_name"]);
        if($check == false) {
            $error .= "The file you tried to upload was not an image, or way too big for us to handle...<br/>";
            $validImage = false;
        } 
        else if ($_FILES["uploadImg"]["size"] > (5*1048576)) {
            $error .= "The file you tried to upload is too large...<br/>";
            $validImage = false;
        }
        else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $error .= "The image you tried to upload must have an extension of: JPG, JPEG, PNG & GIF.<br/>";
            $validImage = false;
        }
        else {
            if (move_uploaded_file($_FILES["uploadImg"]["tmp_name"], $fileName)) {
                $result .= "<div class='alert alert-success'>Image Uploaded Successfully!</div>";
                $_SESSION['createImg'] = $fileName;
                $createImage = $_SESSION['createImg'];
            } else {
                $validImage = false;
                $error .= "Sorry, there was an unknown error uploading your file.";
            }
        }

        if (!$validImage) //failure
            $notification = '<div class="alert alert-danger" role="alert"><strong>Error! '.$error.' </div>';
    }
    
    $view = "
    <div class='container medForm'>
        <h2 class='text-center'>Step 1 - Upload an Image to Use</h2>
        <div class='col-md-12 bigMargin'>
            <form class='form-horizontal' action='create.php' method='post' name='uploadForm' enctype='multipart/form-data'>
                <div class='form-group'>
                    <div class='col-lg-12 text-center'>
                        <input type='file' name='uploadImg' class='btn btn-lg btn-primary' id='fileToUpload'>
                    </div>
                </div>
                <div class='form-group'>
                    <div class='text-center col-lg-12'>
                        <button name='uploadSubmit' type='submit' class='btn btn-lg btn-primary'><i class='fa fa-rocket'></i> Upload Image</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>";
}

if (isset($_SESSION['createImg'])) {  //editing an image, saving too
    
    if (isset($user)){ //logged in user, save the image
        if (isset($_POST['loginSubmit'])){
            if ($_POST['loginSubmit'] == 'true') {
                $title = $_POST['title'];
                $topText = $_POST['topText'];
                $bottomText = $_POST['bottomText'];
                
                try {
                    if ($user->addMeme($title, $topText, $bottomText, $_SESSION['createImg']))
                        $notification .= "<div class='alert alert-success'>Meme Saved.</div>";
                    else
                        $notification = '<div class="alert alert-danger" role="alert"><strong>Error! Something seriously went wrong with saving.</strong></div>';
                }
                catch(PDOException $e) {
                    $successfulLogin = false;
                    $notification = '<div class="alert alert-danger" role="alert"><strong>Error! Something seriously went wrong with saving.</strong><br/><br/> '.$e->getMessage().' </div>';
                }
                catch(exception $e) {
                    $successfulLogin = false;
                    $notification .= '<div class="alert alert-danger" role="alert"><strong>Error! Unable to Save:</strong><br/><br/> '. $e->getMessage() .' </div>';
                }
                $password = "";
            }
        }
    }
    
    
    
    $createImage = $_SESSION['createImg'];
    $view = "
        <div class='container '>
            <h2 class='text-center'>Step 2 - Add Text</h2>
            <div class='col-md-3'>
                <form role='form' class='form-horizontal' name='editForm' method='post'>
                    <fieldset class='saveDisable'>
                        <div class='form-group'>
                            <label class='control-label' for='title'>Title:</label>
                            <input type='text' class='form-control disabled' id='title' placeholder='Your Title' name='title' value='".$title."'>
                            <label class='control-label' for='topText'>Top Text:</label>
                            <input type='text' class='form-control disabled' id='topText' placeholder='Your Top Text' name='topText' value='".$topText."'>
                            <label class='control-label' for='bottomText'>Bottom Text:</label>
                            <input type='text' class='form-control' id='bottomText' placeholder='Bottom Text' name='bottomText' value='".$bottomText."'>
                        </div>
                    </fieldset>
                    <div class='form-group'>
                        
                        <input name='hidden_data' id='hidden_data' type='hidden'/>
                        <fieldset class='saveDisable inline'>
                        <button name='trashImage' value='true' type='submit' class='btn btn-lg btn-inline-block btn-primary'><i class='fa fa-trash-o'></i> Discard</button>
                        </fieldset>
                        <fieldset class='saveDisable inline' ".$disableSave.">
                            <button name='loginSubmit' onclick='uploadEx()' value='true' type='button' class='btn btn-lg btn-inline-block btn-primary'><i class='fa fa-floppy-o'></i> Save</button>
                        </fieldset>
                    </div>
                    <blockquote id='saveSuccess'>".$info."</blockquote>
                </form>
            </div>
            <div class='col-md-9'>
                <canvas id='canvas'></canvas>
            </div>
        </div>
    ";
}



/*************************************
		START Header Data
*************************************/
$pageTitle = "Memer - Create a Meme";
$activeNav = 'create';

require (ABSPATH.PAGESPATH.'header.php');
/*************************************
		END Header Data
*************************************/



?>

        <div class='headerSection'>
            <div class='container'>
                <h1><i class="fa fa-angle-double-right"></i>Create a Meme</h1>
            </div>
        </div>

<div id='notification'>
<?php echo $notification; ?>
</div>
<?php
echo $view;

/*************************************
		START Footer Data
*************************************/

$otherFooterData = "
<script src='/util/js/create.js'></script>
<script>

	$.fn.ready(function() {

		Meme('".$createImage."', 'canvas');

		$('#topText, #bottomText').keyup(function() {
			Meme('".$createImage."', 'canvas', $('#topText').val(), $('#bottomText').val());
		});

	});

	</script>
    
    
";

require_once (ABSPATH.PAGESPATH.'footer.php');
/*************************************
		END Footer Data
*************************************/