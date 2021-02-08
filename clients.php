<?php
/*
	Najeebulla Hussaini 
	WEBD3201
	November 20th, 2020
*/
$title = "WEBD3201 Clients Page";
include "./includes/header.php";
?>
<h1 class="h3 mb-3 font-weight-normal">Client:</h1> <br> <br>
<?php
if (($_SESSION['user']['user_type'] == ADMIN) || ($_SESSION['user']['user_type'] == AGENT )){
	
}else {
	$_SESSION['message'] = "You are not signed in as Admin or a Salesperson";
	header ("Location: ./sign-in.php");
	ob_flush();
} 
$page = 1;

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
display_table(
	user_client_select_all(RECORDS_PER_PAGE , $page)
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
	} else if (is_numeric($extension) == false){
		$error .= "You must enter numeric Phone Extension to register client . <br/>";
		$extension = "";
	} else if ($_FILES['uploadfilename']['error'] != 0) {
		$error .= "Problem uploading File. <br/>";
	} else if ($_FILES['uploadfilename']['type'] != "image/jpeg") {
		$error .= "Logo Must be of type JPEG. <br/>";
	} else {
		$tmp_name = $_FILES['uploadfilename']['tmp_name'];
		$name = basename($_FILES['uploadfilename']['name']);
		move_uploaded_file($tmp_name, "./uploads/" . $name);
		$logo_path = "./uploads/" . $name;
		$phone = strval($extension);
		$sql = user_client_register($first_name, $last_name, $login, $extension, $logo_path, $_SESSION['user']['id'] );
		if ($sql){
		$_SESSION['ClientCreated'] = true;
		$_SESSION['message'] = "You successfully created a Client";
		$_SESSION['clientmessage'] = "You successfully created a client at ".date("Y-m-d H:i:s", time())." client name ".$first_name. ".";
		file_put_contents("./DATE_log.txt", $_SESSION['clientmessage']."\n", FILE_APPEND);
		} else {
			$error .= "Client did not register correctly. Please enter correct information in each field. <br/>";
			$_SESSION['message'] = "Unsuccessful client registration";
			file_put_contents("./DATE_log.txt", $_SESSION['message']."\n", FILE_APPEND);
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
		array(
			"type" => "file",
			"name" => "uploadfilename",
			"label" => "Select Logo File For Upload"
		),
	)
);		
?>
<?php
include "./includes/footer.php";
?> 
