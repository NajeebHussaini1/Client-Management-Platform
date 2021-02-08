<?php
/*
	Najeebulla Hussaini 
	WEBD3201
	December 2nd, 2020
*/
$title = "WEBD3201 Reset Password request page";
include "./includes/header.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
$login = "";
$error = "";
}if($_SERVER["REQUEST_METHOD"] == "POST"){
	$login = trim($_POST["email"]);
	$conn = db_connect();
	if ($login != ""){
		$sql = user_email_verification($login);
	 if ($sql){
		user_update_login_time($login,date("Y-m-d H:i:s", time()));
		$_SESSION['message'] = "Request was sent to " . $login;
		$_SESSION['verifymessage'] = "Hello, ".$login. " This is a request sent to you to reset your password.";
		file_put_contents("./EMAIL_log.txt", $_SESSION['verifymessage']."\n", FILE_APPEND);
	 } else{
		$_SESSION['message'] = "Unsuccessful email verification";
		file_put_contents("./EMAIL_log.txt", $_SESSION['message']."\n", FILE_APPEND);
	 }
	} else{
		$error .= "You must enter an email address. <br/>";
		$login = "";
	}
	
}
?>
<h3><?php echo $error; ?></h3>
<?php
display_form(
	array(
		array(
			"type" => "email",
			"name" => "email",
			"value" => "",
			"label" => "Email"
		),
	)
);
?>
<?php
include "./includes/footer.php";
?> 