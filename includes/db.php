<?php
/*
	Najeebulla Hussaini 
	WEBD3201
	September 23, 2020
*/

function db_connect(){
	$conn = pg_connect("host=".DB_HOST." dbname=".DATABASE." user=".DB_ADMIN." password=".DB_PASSWORD);
	return $conn;
}
/*function db_connect(){
	return pg_connect("host=127.0.0.1 dbname=hussainin_db user=hussainin password=Ashraf1997");
}*/
function user_select($email_address){
	$user_select_stmt= pg_prepare(db_connect(),"user_select", "SELECT * FROM users WHERE email_address = $1");
	$result = pg_execute($conn, "user_select", array($email_address));
	if (pg_num_rows($result) == 1){
		$user = pg_fetch_assoc($result ,0);
		return $user;
	}
	else 
	{
		return false;
	}
}
function user_authenthicate($login , $password){
	$user_select_stmt= pg_prepare(db_connect(),"user_select", "SELECT * FROM users WHERE email_address = $1");
	$result = pg_execute(db_connect(), "user_select", array($login));
	if (pg_num_rows($result) == 1){
		$user = pg_fetch_assoc($result ,0);
		$is_user = password_verify($password , $user["password"]);
		if ($is_user == true){
			$_SESSION['user'] = $user;
			return $user;
		}
		else {
			return false;
		}
		
	}
}
function user_update_login_time ($id , $date) {
	pg_prepare(db_connect(), "user_update_login_time", "UPDATE users SET last_access = $2 WHERE email_address = $1");
	$result = pg_execute(db_connect(), "user_update_login_time", array($id, $date));
	//$result = pg_execute(db_connect(), "user_update_login_time", array($date));
	/*if (pg_num_rows($result) == 1){
		$user = pg_fetch_assoc($result ,0);
		return $user;
	}*/
}

function user_salesperson_register($id, $password, $first_name, $last_name, $last_access, $enrol_date, $extension, $user_type){
	pg_prepare(db_connect(),'user_salesperson_register', 'INSERT INTO users (email_address, password, first_name, last_name, last_access, enrol_date, phone_number, user_type) VALUES(
	$1, $2, $3, $4, $5, $6, $7, $8)');
	$result = pg_execute(db_connect(), "user_salesperson_register", array($id, password_hash($password,PASSWORD_BCRYPT), $first_name, $last_name, $last_access, $enrol_date, $extension, $user_type));
	return $result;
}
function user_client_register($first_name, $last_name, $id, $extension, $logo_path, $salesperson){
	pg_prepare(db_connect(),'user_client_register', 'INSERT INTO clients (first_name, last_name, email_address, phone_number, logo_path, id) VALUES(
	$1, $2, $3, $4, $5, $6)');
	$result = pg_execute(db_connect(), "user_client_register", array($first_name, $last_name, $id, $extension, $logo_path, $salesperson));
	return $result;
}
function user_calls_register($first_name, $last_name, $id, $extension, $date){
	pg_prepare(db_connect(),'user_calls_register', 'INSERT INTO calls (first_name, last_name, email_address, phone_number, call_date) VALUES(
	$1, $2, $3, $4, $5)');
	$result = pg_execute(db_connect(), "user_calls_register", array($first_name, $last_name, $id, $extension, $date));
	return $result;
}
function user_client_select_all($limit, $offset) {
	pg_prepare(db_connect(),'client_select_all','SELECT email_address, first_name, last_name, phone_number, extension, logo_path FROM clients LIMIT $1 OFFSET $2');
	$result = pg_execute(db_connect(),'client_select_all',array($limit, $offset));
	return $result;
}
function user_client_count() {
	pg_prepare(db_connect(), 'client_count', 'SELECT COUNT(*) FROM clients');
	$result = pg_execute(db_connect(), 'client_count', array());
	return $result;
}
function user_salesperson_select_all($limit, $offset) {
	pg_prepare(db_connect(),'salesperson_select_all','SELECT email_address, first_name, last_name, phone_number, extension, user_type FROM users LIMIT $1 OFFSET $2');
	$result = pg_execute(db_connect(),'salesperson_select_all',array($limit, $offset));
	return $result;
}
function user_salesperson_count() {
	pg_prepare(db_connect(), 'salesperson_count', 'SELECT COUNT(*) FROM users');
	$result = pg_execute(db_connect(), 'salesperson_count', array());
	return $result;
}
function user_calls_select_all($limit, $offset) {
	pg_prepare(db_connect(),'calls_select_all','SELECT email_address, first_name, last_name, phone_number, extension, logo_path FROM calls LIMIT $1 OFFSET $2');
	$result = pg_execute(db_connect(),'calls_select_all',array($limit, $offset));
	return $result;
}
function user_calls_count() {
	pg_prepare(db_connect(), 'calls_count', 'SELECT COUNT(*) FROM calls');
	$result = pg_execute(db_connect(), 'calls_count', array());
	return $result;
}
function user_change_password($password, $id) {
	pg_prepare(db_connect(), 'change_password', 'UPDATE users SET password = $1 WHERE email_address = $2');
	$result = pg_execute(db_connect(), 'change_password', array(password_hash($password,PASSWORD_BCRYPT), $id));
	return $result;
}

function user_email_verification($email) {
	pg_prepare(db_connect(), 'email_verification', 'SELECT * FROM users WHERE email_address = $1');
	$result = pg_execute(db_connect(), 'email_verification', array($email));
	return $result;
}

function user_active_update($activity, $email) {
	pg_prepare(db_connect(), 'active_update', 'UPDATE users SET user_type = $1 WHERE email_address = $2');
	$result = pg_execute(db_connect(), 'active_update', array($activity, $email));
	return $result;
}

function user_inactive_update($activity, $email) {
	pg_prepare(db_connect(), 'inactive_update', 'UPDATE users SET user_type = $1 WHERE email_address = $2');
	$result = pg_execute(db_connect(), 'inactive_update', array($activity, $email));
	return $result;
}

//date("Y-m-d",time())
?>




















