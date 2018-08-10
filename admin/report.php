<?php
	include_once('../class/users.php');
	include_once('../include/settings.php');

	use cliqsFrameWork\users\user as me;
	use cliqsFrameWork\users\connect as connectme;
	use cliqsFrameWork\users\performance as ivalid;
	use cliqsFrameWork\users\records as records;
	
	$me=new me();
	$connectme=new connectme();
	$checkme=new ivalid();
	$record=new records();
	
	$r='Staff';
	$me->verifylogin($r);
	
	
	

header('Content-Type:text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>The Poultry |Report</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="../js/check.js"></script>



<style>
@import "../css/forms.css";
@import "../css/interim.css";
@import "../css/default.css";
@import "../css/slider.css";

</style>

</head>
<body>
<!-- start header -->
<div id="header" style="width:100%; background:url(../images/imgg.gif) no-repeat center; margin-top: 1%;">
	
</div>
<!-- end header -->
<!-- start menu --><!-- end menu -->
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		
        
        <h1 class="pagetitle">c Panel</h1>
		<a href="#" id="rss-posts"></a>
		<div class="post">
			<h2 class="title">Report</h2>
			<!--<p class="byline"><small>Posted on August 25th, 2007 by <a href="#">admin</a> | <a href="#">Edit</a></small></p>-->
			<div class="entry">
				
               <div id="feedback" style="background:transparent; color:black; font-size:14px; padding:1px; margin:1% 32% 2px 32%; height:auto; width:350px; text-align:center; border-radius:3px;"></div>
                
    <?php
    		if($_SERVER['REQUEST_METHOD']=='POST'){
					
					$sp=$_POST['sp'];
					$dgfd=$_POST['dg'];
					$dis=$_POST['disease'];
					$bds=$_POST['birds'];
				
						
					if($dis!=0){
								
						$dsql=mysqli_query($link,"SELECT * FROM diagnostics WHERE id='$dis'");
						list($id,$ds,$grug,$qty,$spc,$sys)=mysqli_fetch_row($dsql);
						
						echo "<p><b>$ds</b>($bds Birds)</p>";
						
						
					}else{
						
						if($sp==1){
							//Broiler
							$spcgroupfeeds='Starter Or Finisher Top Feeds';
						
						}else if($sp==2){
							//Layers
							$spcgroupfeeds='Layers Top Feeds';
							
						}else if($sp==3){
							//Cockrell
							$spcgroupfeeds='Growers Top Feed';
							
						}
						
						
							$sql=mysqli_query($link,"SELECT * FROM rcmd WHERE id=1");
							list($id,$sys,$rec,$qty)=mysqli_fetch_row($sql);
									
							$qty=floor($bds*$qty);
							echo "<p><strong>Recommend:</strong> <b>$qty</b> Cups of <b>$spcgroupfeeds</b></p>";			


							$opsql=mysqli_query($link,"SELECT * FROM rcmd WHERE id=2");
							list($id,$sys,$rec,$qty)=mysqli_fetch_row($opsql);

									
							$qty=floor($bds*$qty);
							echo "<p><strong>AND</strong> <b>$qty</b> Grams of <b>Water</b></p>";			
									
						
					}
				
				}
	
	
	?>            
              
                
                
                
            
            </div>
			
		</div>
		
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li>
				<h2>Menu</h2>
				<ul>
					<li><a href="cpanel.php">Home</a></li>
					<li><a href="lgt.php">Logout</a></li>
					
				</ul>
			</li>
			<li>
				<h2>Category</h2>
				<ul>
					<li><a href="#">Intensive System</a></li>
					<li><a href="#">Extensive System</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<!-- end sidebar -->
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->
<div id="footer">
	<p>2015 ,Realcliqs.com</p>
</div>
<div align=center></div></body>
</html>

