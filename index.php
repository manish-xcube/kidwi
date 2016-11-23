<?php
// it is the session function
session_start();
// every page needs to start with these basic things 

// I'm using a separate config file. so pull in those values 
require("includes/config.php"); 
// pull in the file with the database class 
require("classes/Database.class.php"); 

require("classes/security_functions.php"); 

require_once('classes/validation.class.php');

require_once('classes/survey.class.php');

$obj = new validation();
// create the $db object 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$sec=new security_functions($db);
$survey=new survey_functions($db);


if(!$sec->isLoggedIn())
{
echo "<script>window.location.href='login.php'</script>";	

}
else
{
echo "<script>window.location.href='user_profile.php'</script>";	
}
?>
