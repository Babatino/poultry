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
<title>The Poultry | MPanel</title>
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
			<h2 class="title">Choose Species of your birds and Diagnostic Type</h2>
			<!--<p class="byline"><small>Posted on August 25th, 2007 by <a href="#">admin</a> | <a href="#">Edit</a></small></p>-->
			<div class="entry">
				
               <div id="feedback" style="background:transparent; color:black; font-size:14px; padding:1px; margin:1% 32% 2px 32%; height:auto; width:350px; text-align:center; border-radius:3px;"></div>
                
                
              <form action="report.php" method="post">
              
              <input type="hidden" name="sys" value="<?php echo $_GET['cat']; ?>">
              <div class="all"><label>Species</label>
              <select name="sp" id="sp">
              
              		<?php  $sql=mysqli_query($link,"SELECT * FROM sp");
					
					while(list($id,$spc)=mysqli_fetch_row($sql)){
						
						echo "<option value='$id'>$spc</option>";
						
						}
					 ?>
              
              </select>
              </div>



<div class="all"><label>Check</label>
              <select name="dg" id="dg">
              
              			
						<option value='1'>Drug</option>
                        <option value='2'>Feeds</option>
						
		      
              </select>
              </div>
              
              
              <div class="all" id="ds" style="display:none;"><label>Disease</label><cc>
              <select name="disease" id="disease">
              
              	
                <?php
                
					$isql=mysqli_query($link,"SELECT id,disease FROM diagnostics");
					
					echo "<option value='0'>Choose A disease</option>";
					
					while(list($id,$ds)=mysqli_fetch_row($isql)){
						
						echo "<option value='$id'>$ds</option>";
						
						}
				
				?>
              			
		      
              </select></cc>
              </div>

			<div class="all"><label>Birds</label>
				<input type="number" name="birds" id="birds">
             </div>


              <div class="all"><label></label><button type="submit" id="sbcheckcat">Explore</button></div>
              <div class="all"></div>
              
              </form>  
                
                
                
                
                <!--<p><strong>Extended</strong> is a free template from <a href="http://freecsstemplates.org/">Free CSS Templates</a> released under a <a href="http://creativecommons.org/licenses/by/2.5/">Creative Commons Attribution 2.5 License</a>. You're free to use this template for both commercial or personal use. I only ask that you link back to <a href="http://freecsstemplates.org/">my site</a> in some way. Enjoy :)</p>-->
			
            
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

