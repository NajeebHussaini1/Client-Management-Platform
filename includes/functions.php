<?php
/*
	Najeebulla Hussaini 
	WEBD3201
	September 23, 2020
*/

/*Function to redirect to another page */
function redirect($url){
	header ("Location:".$url);
	ob_flush();
}

function setMessage($msg){
	$_SESSION['message'] = $msg;
}

function getMessage(){
	return $_SESSION['message'];
}

function isMessage(){
	return isset($_SESSION['message'])?true:false;
}

function removeMessage(){
	unset($_SESSION['message']);
}

function flashMessage(){
	$message = "";
	if (isMessage())
	{
		$message = getMessage();
		removeMessage();
	}
	return $message;
}
function dump($arg){
	echo "<pre>";
	print_r($arg);
	echo "</pre>";
}
function display_form($array){
?>
	<form class="form-signin" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
	<h1 class="h3 mb-3 font-weight-normal">Please Register</h1>
	<input type="hidden" name="form2submission" value="yes" >
	<?php
	foreach($array as $value){	
	?>
		<label> <?php echo $value['label']; ?> </label> <br> 
		<input type= <?php echo $value['type']; ?>  name= <?php echo $value['name']; ?> value= <?php echo $value['value']; ?> > <br>
	<?php
	}
	?>
	<br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
	</form>
<?php
}
function display_table ($result) {
	?>
	<table border="1" width=auto>
		<tr><th width="25%">Email</th><th width="15%">First Name</th><th width="15%">Last Name</th><th width="15%">Phone Number</th><th width="15%">Extension</th><th width="35%">Logo</th></tr>
	<?php
	$records = pg_num_rows($result);
	//generate the table
	for($i = 0; $i < $records; $i++){  //loop through all of the retrieved records and add to the output variable
		$output .= "\n\t<tr>\n\t\t<td>".pg_fetch_result($result, $i, "email_address")."</td>"; 
		$output .= "\n\t\t<td>".pg_fetch_result($result, $i, "first_name")."</td>"; 
		$output .= "\n\t\t<td>".pg_fetch_result($result, $i, "last_name")."</td>";
		$output .= "\n\t\t<td>".pg_fetch_result($result, $i, "phone_number")."</td>";
		$output .= "\n\t\t<td>".pg_fetch_result($result, $i, "extension")."</td>";
		$output .= "\n\t\t<td><img src=".pg_fetch_result($result, $i, "logo_path")." width="."100"." height="."100"." ></td>\n\t</tr>"; 
	}

	echo $output; //display the output
?>
	</table>
<?php
}
function display_table_salespeople ($result) {
	?>
	<table border="1" width=auto>
		<tr>
			<th>Email</th>
			<th></th>
			<th>First Name</th>
			<th></th>
			<th>Last Name</th>
			<th></th>
			<th>Phone Number</th>
			<th></th>
			<th>Extension</th>
			<th></th>
			<th>Is Active?</th>
			<th></th>
		</tr>
	<?php
	$records = pg_num_rows($result);
	//generate the table
	for($i = 0; $i < $records; $i++){  //loop through all of the retrieved records and add to the output variable
	?>
		<tr>
			<td>
				<?php echo pg_fetch_result($result, $i, "email_address") ?> </td>
			<td>
			<td>
				<?php echo pg_fetch_result($result, $i, "first_name") ?> </td>
			<td>
			<td>
				<?php echo pg_fetch_result($result, $i, "last_name") ?> </td>
			<td>
			<td>
				<?php echo pg_fetch_result($result, $i, "phone_number") ?> </td>
			<td>
			<td>
				<?php echo pg_fetch_result($result, $i, "extension") ?> </td>
			<td>
			<td>
				<?php display_form_activity(pg_fetch_result($result, $i, "user_type"), pg_fetch_result($result, $i, "email_address") ) ?> </td>
			<td>
		</tr>
	<?php
	}

?>
	</table>
<?php
}
function display_form_activity($result, $email) {
?>

		<?php
			if ($result == 'd'){
			?>
				<form class="form-signin" method="post"  action="./salespeople.php">
					<input type="hidden" name="form1submission" value= <?php echo $email ?>  >
					<div>
					<input type="radio" id="a-Active"  name="activity" value="a">
					<label for="a-Active"> Active </label>
					</div>
					<div>
					<input type="radio" id="d-Inactive"  name="activity" value="d" checked>
					<label for="d-Inactive"> Inactive </label>
					</div>
					
					<button type="submit"> Update </button>
				</form>
			<?php
			} else {
			?>
				 
			    <form class="form-signin" method="post"  action="./salespeople.php">
					<input type="hidden" name="form1submission" value= <?php echo $email ?> >
					<div>
					<input type="radio" id="a-Active"  name="activity" value="a" checked>
					<label for="a-Active"> Active </label>
					</div>
					<div>
					<input type="radio" id="d-Inactive"  name="activity" value="d">
					<label for="d-Inactive"> Inactive </label>
					</div>
					
					<button type="submit"> Update </button>
				</form>  
				
				
		<?php
			}
		?>
		
<?php	
}	
?>