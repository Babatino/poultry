<?php
	
	namespace cliqsFrameWork\delete;
	
	//@param-class || subclass
	
	include_once('../include/settings.php');
	include_once('../class/users.php');
	
	use cliqsFrameWork\users\user as me;
	use cliqsFrameWork\users\connect as connectme;
	use cliqsFrameWork\users\performance as ivalid;
	use cliqsFrameWork\users\records as records;
	
	$me=new me();
	$connectme=new connectme();
	$checkme=new ivalid();
	$record=new records();

			$connectme->iconnect();
			$checkme->checkSys();

	
		$dv=$_POST['deleteid'];
		if($dv==1){
			//Delete A Book
			
			$bkid=(int)$_POST['bk'];
			
			$me->deleteabook($bkid);
			
			}
	


?>