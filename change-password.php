<?php
/*
	Najeebulla Hussaini 
	WEBD3201
	November 20th, 2020
*/
$title = "WEBD3201 Change Password Page";
include "./includes/header.php";
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

} else {
	header ("Location: ./sign-in.php");
}
if($_SERVER["REQUEST_METHOD"] == "GET"){
$password = "";
$confirm_password = "";
$error = "";
}if($_SERVER["REQUEST_METHOD"] == "POST"){
	$password = trim($_POST["password"]);
	$confirm_password = trim($_POST["confirm"]);
	$conn = db_connect();
	if ($password == ""){
		$error .= "You must enter a new password . <br/>";
	} else if ($confirm_password == ""){
		$error .= "You must re enter new password . <br/>";
	} else if (strlen($password) < 3){
		$error .= "password must be 3 characters long . <br/>";
	} else if ($confirm_password != $password) {
		$error .= "both passwords entered do not match . <br/>";
	} else {
		$result = user_change_password($password, $_SESSION['user']['email_address']);
		if ($result) {
			$_SESSION['PasswordChanged'] = true;
			$_SESSION['message'] = "You successfully changed your password";
			$_SESSION['passwordmessage'] = "You successfully changed your password at ".date("Y-m-d H:i:s", time());
			file_put_contents("./DATE_log.txt", $_SESSION['passwordmessage']."\n", FILE_APPEND);
		} else {
			$error .= "Failed to change password. <br/>";
		}
	}
	
}
?>
<h2><?php echo $_SESSION['message']; ?></h2>
<h3><?php echo $error; ?></h3>
<?php
display_form(
	array(
		array(
			"type" => "password",
			"name" => "password",
			"value" => $password,
			"label" => "New Password"
		),
		array(
			"type" => "password",
			"name" => "confirm",
			"value" => $confirm_password,
			"label" => "Re-type Password"
		),
	)
);

?>
<?php
include "./includes/footer.php";
?> 