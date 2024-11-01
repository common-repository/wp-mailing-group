<?php
/* get all variables */
$pop_server = (isset($_REQUEST["pop_server"])? sanitize_text_field($_REQUEST["pop_server"]): '');
$pop_server_type = (isset($_REQUEST["pop_server_type"])? sanitize_text_field($_REQUEST["pop_server_type"]): '');
$pop_port = (isset($_REQUEST["pop_port"])? sanitize_text_field($_REQUEST["pop_port"]): '');
$pop_username = (isset($_REQUEST["pop_username"])? sanitize_text_field($_REQUEST["pop_username"]): '');
$pop_password = (isset($_REQUEST["pop_password"])? sanitize_text_field($_REQUEST["pop_password"]): '');
$password = (isset($_REQUEST["password"])? sanitize_text_field($_REQUEST["password"]): '');
$email = (isset($_REQUEST["email"])? sanitize_text_field($_REQUEST["email"]): '');
$pop_ssl = ($_REQUEST["pop_ssl"] == 'true') ? TRUE : FALSE;

require_once(WPMG_PLUGIN_PATH.'/lib/receivemail.class.php');

if($pop_username != '' && $pop_password != '') {
	$TestObj = new receiveMail($pop_username, $pop_password, $email, $pop_server, $pop_server_type, $pop_port, $pop_ssl);
} else {
	$TestObj = new receiveMail($email, $password, $email,$pop_server, $pop_server_type, $pop_port, FALSE);
}
/* Connect to the Mail Box */
$TestObj->connect();
/* If connection fails give error message and exit */
?>