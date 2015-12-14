<?php
/*************************************
		Header Data
*************************************/

$activeNavHome = '';
$activeNavLogIn = '';
$activeNavRegister = '';
$activeNavSearch = '';
$activeNavCreate = '';

if (isset($activeNav))
{
    switch ($activeNav)
    {
        case "home":
            $activeNavHome = 'class="active"';
            break;
        case "login":
            $activeNavLogIn = 'class="active"';
            break;
        case "register":
            $activeNavRegister = 'class="active"';
            break;
        case "search":
            $activeNavSearch = 'class="active"';
            break;
        case "create":
            $activeNavCreate = 'class="active"';
            break;
    }
        
}

$dynamicNav = "";

if (!isset($_SESSION['user'])){
    $dynamicNav .= "
    <li>
        <a href='/register.php' ".$activeNavRegister.">
            <span class='icon'><i class='fa fa-user-plus'></i></span>
            <div class='content'>
                <h2 class='main'>Register</h2>
                <h3 class='sub'>save your memes</h3>
            </div>
        </a>
    </li>
    <li>
        <a href='/login.php' ".$activeNavLogIn.">
            <span class='icon'><i class='fa fa-user'></i></span>
            <div class='content'>
                <h2 class='main'>Log In</h2>
                <h3 class='sub'>save your memes</h3>
            </div>
        </a>
    </li>";
} else {
    $dynamicNav .= "
    <li>
        <a href='/logout.php?logout=true' ".$activeNavRegister.">
            <span class='icon'><i class='fa fa-user'></i></span>
            <div class='content'>
                <h2 class='main'>Log Out</h2>
                <h3 class='sub'>".$_SESSION['user']->getUsername()."</h3>
            </div>
        </a>
    </li>";
}


if (!isset($otherHeaderData))
    $otherHeaderData = '';


//class='animated fadeIn'
?>

<!DOCTYPE html>
<html lang='en' >
	<head>
	
		<title><?php echo $pageTitle; ?></title>
		
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		
		<link href='//fonts.googleapis.com/css?family=Libre+Baskerville|Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
		<link type='text/css' rel='stylesheet' href='<?php echo CSSPATH; ?>bootstrap.min.css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link type='text/css' rel='stylesheet' href='<?php echo CSSPATH; ?>reset.css'>
		<link type='text/css' rel='stylesheet' href='<?php echo CSSPATH; ?>style.css'>
		<link type='text/css' rel='stylesheet' href='<?php echo CSSPATH; ?>style-responsive.css'>
        <script> 
            if (/*@cc_on!@*/false) { 
                var headHTML = document.getElementsByTagName('head')[0].innerHTML; 
                headHTML    += "<link type='text/css' rel='stylesheet' href='<?php echo CSSPATH; ?>ie.css'>"; 
                document.getElementsByTagName('head')[0].innerHTML = headHTML; 
            } 
        </script>
        
        <?php echo $otherHeaderData; ?>
		
	</head>
	<body id='top'>
		<header id='header' class='mainHeader'>
			<nav class='navbar navbar-fixed-top' role='navigation'>
				<div class='container'>
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class='navbar-header'>
						<div class='brandContainer'>
							<a href='/index.php'>
								<h1 class='brand'>Memer</h1>
                                <h2 class='slogan'>Easy Meme Generator</h2>
							</a>
						</div>
						
						<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
							<b class='blue'>Menu</b><i class='fa fa-bars blue'></i>
						</button>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class='collapse navbar-collapse navbar-ex1-collapse'>
						<ul class='nav navbar-nav'>
                            <li>
								<a href='/create.php' <?php echo $activeNavCreate; ?>>
									<span class='icon'><i class='fa fa-object-group'></i></span>
									<div class='content'>
										<h2 class='main'>Create</h2>
										<h3 class='sub'>Create a Meme</h3>
									</div>
								</a>
							</li>
                            <li>
								<a href='/memes.php' <?php echo $activeNavSearch; ?>>
									<span class='icon'><i class='fa fa-search'></i></span>
									<div class='content'>
										<h2 class='main'>Browse</h2>
										<h3 class='sub'>Search for Memes</h3>
									</div>
								</a>
							</li>
							<?php echo $dynamicNav; ?>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>
		</header>
        <div id='content'>