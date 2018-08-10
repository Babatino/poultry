<?php
	
	namespace cliqsFrameWork\search;
	
	//@param-staff || student
	
	include_once('../include/settings.php');
	include_once('../class/users.php');
	
	use cliqsFrameWork\users\user as me;
	use cliqsFrameWork\users\records as records;
	use cliqsFrameWork\users\connect as connectme;
	use cliqsFrameWork\users\performance as ivalid;
	
	$me=new me();
	$record=new records();
	$connectme=new connectme();
	$checkme=new ivalid();
	
		
		$connectme->iconnect();
		$checkme->checkSys();
		
		$searchid=(int)strip_tags(trim($_POST['searchid']));
			
			if($searchid==1){
				
				$section=strip_tags(trim($_POST['section']));
				$sort=strip_tags(trim($_POST['role']));
				$record->searchmember($section,$sort);
			
			}else if($searchid==2){
				
				$callno=(string)$_POST['callno'];
				$record->searchshelf($callno);
				
			}
			
	
			
	exit();
?>