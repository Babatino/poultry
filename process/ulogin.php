<?php
	
	namespace cliqsFrameWork\login;
	
	include_once('../include/settings.php');
	include_once('../class/users.php');
	
	use cliqsFrameWork\users\user as me;
	use cliqsFrameWork\users\connect as connectme;
	use cliqsFrameWork\users\performance as ivalid;
	
	$me=new me();
	$connectme=new connectme();
	$checkme=new ivalid();
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		$mat=stripslashes(strip_tags(trim($_POST['usr'])));
		$pwd=sha1(stripslashes(strip_tags($_POST['pwd'])));
		
	
		if(is_string($mat) && is_string($pwd)){
			
			$connectme->iconnect();
			$checkme->checkSys();
			$me->login($mat,$pwd);
			
		}else{
			echo "<img src='../images/cancel.png' width='auto' height='14px'>&nbsp;Incorrect Field Format";
		}
	}
	exit();
?>