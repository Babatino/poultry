<?php
	namespace cliqsFrameWork\upload;
	
	include_once('../include/settings.php');
	
	define('X',101);
	
	$name=strtolower($_FILES['file']['name']);
	$type=$_FILES['file']['type'];
	$size=(int)($_FILES['file']['size']);
	$tmp=$_FILES['file']['tmp_name'];
	
	
	
	if(@getimagesize($tmp)){
	
		$arraytype=array('image/jpeg','image/jpg');
		
		if(!empty($name)){
			if(in_array($type,$arraytype)){
				if($size<=(800*1024) and !empty($size)){
					$filename=time().$name;
					if(move_uploaded_file($tmp,'../uploads/pix/del/'.$filename)){
						$_SESSION['funame']=$filename;
						echo X;
						}else{
							echo "<img src='../images/cancel.png' width='auto' height='13px'>System Error: Couldn't Complete File Submission";
							}
					
					
					}else{
						echo "<img src='../images/cancel.png' width='15px' height='15px'>&nbsp;File too large, upload below 800kb";
						}
			}else{
				echo "<img src='../images/cancel.png' width='15px' height='15px'>&nbsp;Unsupported File format, Suggest Using jpeg,jpg or gif file";
				}
		}else{
			echo "<img src='../images/cancel.png' width='15px' height='15px'>&nbsp;No File Selected";
			}
	}else{
		echo "<img src='../images/cancel.png' width='15px' height='15px'>&nbsp;Please Upload A Real Image File";
		}
exit();	
?>