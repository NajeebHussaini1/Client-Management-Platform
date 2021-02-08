<?php
/*
	Najeebulla Hussaini 
	WEBD3201
	November 20th, 2020
*/
$title = "WEBD3201 Calls Page";
include "./includes/header.php";
?>
<h1 class="h3 mb-3 font-weight-normal">Call Records:</h1> <br> <br>
<?php
if ($_SESSION['user']['user_type'] == AGENT || $_SESSION['user']['user_type'] == ADMIN ){
	
}else {
	$_SESSION['message'] = "You are not signed in as a Salesperson";
	header ("Location: ./sign-in.php");
	ob_flush();
} 
$page = 1;

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
display_table(
	user_calls_select_all(RECORDS_PER_PAGE , $page)
	);
?>	
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>
<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
$login = "";
$first_name = "";
$last_name = "";
$extension = "";
$error = "";
}if($_SERVER["REQUEST_METHOD"] == "POST"){
	$login = trim($_POST["email"]);
	$first_name = trim($_POST["first_name"]);
	$last_name = trim($_POST["last_name"]);
	$extension = trim($_POST["extension"]);
	$conn = db_connect();
	if ($login == ""){
		$error .= "You must enter an email address to register . <br/>";
		$login = "";
	}
	else if ($first_name == ""){
		$error .= "You must enter first name to register . <br/>";
		$first_name = "";
	}
	else if ($last_name == ""){
		$error .= "You must enter last name to register . <br/>";
		$last_name = "";
	}
	else if ($extension == ""){
		$error .= "You must enter Phone Extension to register . <br/>";
		$extension = "";
	} else if (is_numeric($extension) == true){
		$phone = strval($extension);
		$date = date("Y-m-d H:i:s", time());
		$sql = user_calls_register($first_name, $last_name, $login, $extension, $date);
		if ($sql){
		$_SESSION['CallCreated'] = true;
		$_SESSION['message'] = "You successfully created a Call record";
		$_SESSION['callmessage'] = "You successfully created a call record at ".date("Y-m-d H:i:s", time())." client name ".$first_name. ".";
		file_put_contents("./DATE_log.txt", $_SESSION['callmessage']."\n", FILE_APPEND);
		} else {
			$error .= "Call record did not register correctly. Please enter correct information in each field. <br/>";
			$_SESSION['message'] = "Unsuccessful call record registration";
			file_put_contents("./DATE_log.txt", $_SESSION['message']."\n", FILE_APPEND);
		}
	} else {
		$error .= "You must enter numeric Phone Extension to register call record . <br/>";
		$extension = "";
	}
}
?>
<h2><?php echo $_SESSION['message']; ?></h2>
<h3><?php echo $error; ?></h3>
<?php
display_form(
	array(
		array(
			"type" => "text",
			"name" => "first_name",
			"value" => $first_name,
			"label" => "First Name"
		),
		array(
			"type" => "text",
			"name" => "last_name",
			"value" => $last_name,
			"label" => "Last Name"
		),
		array(
			"type" => "email",
			"name" => "email",
			"value" => $login,
			"label" => "Email"
		),
		array(
			"type" => "text",
			"name" => "extension",
			"value" => $extension,
			"label" => "Extension"
		),
	)
);	
?>
<?php
include "./includes/footer.php";
?> 