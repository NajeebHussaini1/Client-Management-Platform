<?php
/*
	Najeebulla Hussaini 
	WEBD3201
	September 23, 2020
*/
$title = "WEBD3201 Login Page";
include "./includes/header.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
$login = "";
$password = "";
$error = "";
}if($_SERVER["REQUEST_METHOD"] == "POST"){
	$login = trim($_POST["inputEmail"]);
	$password = trim($_POST["inputPassword"]);
	$conn = db_connect();
	if ($login == ""){
		$error .= "You must enter an email address to log in . <br/>";
	}
	else if ($password == ""){
		$error .= "You must enter password to log in . <br/>";
	}
	$sql = user_authenthicate($login , $password);
	if ($sql == false){
		$error .= "user did not authenthicate correctly. Please enter correct email address and password. <br/>";
		$_SESSION['message'] = "Unsuccessful log in";
		file_put_contents("./DATE_log.txt", $_SESSION['message']."\n", FILE_APPEND);
	} else if ($sql != false){
		if ($_SESSION['user']['user_type'] == DISABLED){
		$error .= "This user is inactive from the ADMIN, Inactive user cannot sign in.  <br/>" ;
		$_SESSION['inactivemessage'] = "This user is inactive from the ADMIN, Inactive user cannot sign in";
		file_put_contents("./DATE_log.txt", $_SESSION['inactivemessage']."\n", FILE_APPEND);
		}
		else {
			user_update_login_time($login,date("Y-m-d H:i:s", time()));
			$_SESSION['loggedin'] = true;
			$_SESSION['message'] = "You successfully logged in";
			$_SESSION['loginmessage'] = "You successfully logged in at ".date("Y-m-d H:i:s", time())." for user ".$login. ".";
			file_put_contents("./DATE_log.txt", $_SESSION['loginmessage']."\n", FILE_APPEND);
			header ("Location: ./dashboard.php");
			ob_flush();
		}
	}
}
?>   
<h2><?php echo $message; ?></h2>
<h3><?php echo $error; ?></h3>
<form class="form-signin" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>

<?php
include "./includes/footer.php";
?>    