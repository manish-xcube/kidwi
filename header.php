<?php
session_start();

//error_reporting(0);
// every page needs to start with these basic things 

// I'm using a separate config file. so pull in those values 
require("includes/config.php"); 
// pull in the file with the database class 
require("classes/Database.class.php"); 

require("classes/security_functions.php"); 

require_once('classes/listing.class.php');

require_once('classes/survey.class.php');

// create the $db object 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$sec=new security_functions($db);
$survey=new survey_functions($db);
$fnc = new listing_functions($db);


if(!$sec->isLoggedIn())
{
echo "<script>window.location.href='login.php'</script>";	

}

$user_result = $db->getUser($_SESSION['session_user_id']);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Admin</title>
		<meta name="description" content="Restyling jQuery UI Widgets and Elements" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		  		<!-- basic styles -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.full.min.css" />
		<!--<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />-->
		<link rel="stylesheet" href="assets/css/jquery.gritter.css" />
		<link rel="stylesheet" href="assets/css/select2.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-editable.css" />
		<!-- fonts -->
		<link rel="stylesheet" href="assets/css/ace-fonts.css" />
		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/colorpicker.css" />
		<link rel="stylesheet" href="assets/css/site.css" />
		
		<link rel="stylesheet" href="assets/css/chosen.css" />
		<link rel="stylesheet" href="assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="assets/css/datepicker.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />




				<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<script src="assets/js/ace-extra.min.js"></script>
		
				<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
			</head>
	<body>
	<!--Top Navigation Bar-->
		  <div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>
			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="<?php echo HOME_PAGE; ?>" class="navbar-brand"><small><?php echo $user_result['company']; ?></small></a>
				</div><!-- /.navbar-header -->
				<div class="navbar-header pull-right" role="navigation">
				
					<ul class="nav ace-nav">
						<li class="purple" id="notifications" >
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
					<img src="assets/img/loading.gif">
					</a>
						</li>

						<li class="green">
							<a  href="#" data-toggle="dropdown" class="dropdown-toggle">
							<!--<a data-toggle="dropdown" class="dropdown-toggle" href="message-board.php">-->
								<i class="icon-envelope icon-animated-vertical"></i>
								<span class="badge badge-success"><span id="unread-1"><?php echo $survey->unreadCounts(); ?></span></span>							</a>

							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-envelope-alt"></i>
									<span id="unread-3"><?php echo $survey->unreadCounts(); ?></span> Messages								</li>

								<?php $ur_msg_result = $survey->undreadMessageList(3); 
									  while($urMsgRow = mysql_fetch_assoc($ur_msg_result)) { 
									  $urMsgSender = $db->getUser($urMsgRow['messageAuth']);
									  ?>
								<li  class="uread_msg_popup" msg-id="<?php echo $urMsgRow['messageID']; ?>">
									<a href="javascript:void(0)">
										<img src="assets/images/profile/<?php echo $urMsgSender['profie_photo']; ?>" class="msg-photo" alt="<?php echo $urMsgSender['name'].' '.$urMsgSender['surname']; ?>" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue"><?php echo $urMsgSender['name'].' '.$urMsgSender['surname']; ?>:</span>
												<?php echo strip_tags(strlen($urMsgRow['messageText']) > 10 ? substr($urMsgRow['messageText'],0,40).'...' : $urMsgRow['messageText']); ?></span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span><?php echo date('h:i:s a',$urMsgRow['currenttime']) ?></span> </span>	</span></a>
								</li>

								<?php } ?>

								

								<li>
									<a href="message-board.php">
										See all messages
										<i class="icon-arrow-right"></i></a></li>
							</ul>
						</li>

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<span class="user-info">
									<small>Welcome,</small>
									<?php echo $user_result['name'].' '.$user_result['surname']; ?></span>

								<i class="icon-caret-down"></i></a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								
									<a href="user_profile.php">
										<i class="icon-user"></i>
										Profile</a></li>

								<li class="divider"></li>

								<li>
									<a href="logout.php">
										<i class="icon-off"></i>
										Logout</a></li>
							</ul>
						</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
	</div>
	
	<!--Top Navigation Bar End-->
	
	 <div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
