<?php

//recieve the post data from create.php's step 2 - saving a picture with text


define('ABSPATH', ((strlen(dirname($_SERVER['PHP_SELF'])) > 1) ? str_replace(dirname($_SERVER['PHP_SELF']), '', str_replace('\\', '/', dirname( __FILE__ ))) : dirname( __FILE__ )) .'/');
require_once (ABSPATH . 'util/includes.php');

$notification = "";

if (isset($_SESSION['user'])){ //logged in user, save the image
    $user = $_SESSION['user'];
    if (isset($_POST['hidden_data'])){

        $title = trim($_POST['title']);
        $topText = trim($_POST['topText']);
        $bottomText = trim($_POST['bottomText']);
        
        if ($title == "")
            $notification .= '<div class="alert alert-danger" role="alert"><strong>Error! You need to give your image a title.</strong></div>';
        else {
            try {
                $img = $_POST['hidden_data'];
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $file = ".".MEMEPATH.round(microtime(true)) . ".png";
                file_put_contents($file, $data);
                if (file_exists($_SESSION['createImg']))
                    unlink($_SESSION['createImg']);
                if (isset($_SESSION['createImg']))
                    unset($_SESSION['createImg']);

                if ($lastId = $user->addMeme($title, $topText, $bottomText, $file))
                    $notification .= "<div class='alert alert-success'>Meme Saved.</div><meta http-equiv=refresh content='2;url=/memes.php?id=".$lastId."'>";
                else
                    $notification .= '<div class="alert alert-danger" role="alert"><strong>Error! Something seriously went wrong with saving.</strong></div>';
            }
            catch(exception $e) {
                $notification .= '<div class="alert alert-danger" role="alert"><strong>Error! Unable to Save:</strong><br/><br/> '. $e->getMessage() .' </div>';
            }
        }
    }
}

echo $notification;