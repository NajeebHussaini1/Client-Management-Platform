<?php
/*
	Najeebulla Hussaini 
	WEBD3201
	November 20th, 2020
*/
$title = "WEBD3201 SalesPeople Page";
include "./includes/header.php";
?>
<h1 class="h3 mb-3 font-weight-normal">Salesperson:</h1> <br> <br>
<?php
if ($_SESSION['user']['user_type'] == ADMIN){
	
}else {
	$_SESSION['message'] = "You are not signed in as Admin";
	header ("Location: ./sign-in.php");
	ob_flush();
} 
$page = 1;

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
display_table_salespeople  (
	user_salesperson_select_all( RECORDS_PER_PAGE , $page)
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
}
if('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['form1submission'])) {
    // first form code. 
	 $activity = trim($_POST["activity"]);
	 $email = trim($_POST["form1submission"]);
	 if ($activity == 'd') {
		$conn = db_connect();
		$sql = user_inactive_update($activity, $email);
		if ($sql){
		$_SESSION['message'] = "Updated Salesperson activity, Refresh the page";
		}else {
		$error .= "Salesperson activity did not update correctly <br/>";
		}
	 }else if ($activity == 'a') {
		$conn = db_connect();
		$sql = user_active_update($activity, $email);
		if ($sql){
		$_SESSION['message'] = "Updated Salesperson activity, Refresh the page";
		}else {
		$error .= "Salesperson activity did not update correctly <br/>";
		}
	 }
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form2submission'])){
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
		/*MADE ALL SALESPERSON PASSWORD agent TO LOG IN AS A SALESPERSON*/
		$password = "agent";
		$enrol_date = date("Y-m-d H:i:s", time());
		$last_access = date("Y-m-d H:i:s", time());
		$user_type = AGENT;
		$sql = user_salesperson_register($login, $password, $first_name, $last_name, $last_access, $enrol_date, $phone, $user_type);
		if ($sql){
		$_SESSION['SalespersonCreated'] = true;
		$_SESSION['message'] = "You successfully created a Salesperson";
		$_SESSION['salespersonmessage'] = "You successfully created a salesperson at ".date("Y-m-d H:i:s", time())." Salesperson name ".$first_name. ".";
		file_put_contents("./DATE_log.txt", $_SESSION['salespersonmessage']."\n", FILE_APPEND);
		} else {
			$error .= "Salesperson did not register correctly. Please enter correct information in each field. <br/>";
			$_SESSION['message'] = "Unsuccessful Salesperson registration";
			file_put_contents("./DATE_log.txt", $_SESSION['message']."\n", FILE_APPEND);
		}
	} else {
		$error .= "You must enter numeric Phone Extension to register . <br/>";
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