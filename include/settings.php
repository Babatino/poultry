<?php
session_name('poultry345');
$project='/cphp/poultry';
session_save_path($_SERVER['DOCUMENT_ROOT']."$project/include/session");
session_start();
ini_set('expose_php','off');
define('LIVE',error_reporting(0));
$Y=date('Y',time());
///////////////////////////CONSTANTS////////////////////////////////////////////////////
define('E','The Poultry');
define('L','../images/logo.png');
define("F","The Poultry $Y, realcliqs.com");
//////////////////////////////ABOUT ME////////////////////////////////////////////////////////////
/*ABOUT THE DEVELOPER 	
 I AM AKINDUTIRE AYOMIDE SAMUEL, I AM PASSIONATE ABOUT CODING, I BUILT 
 THIS SYSTEM ON THE BASIS OF PROFESSIONALISM AND SALES, BEING THE ORIGINAL
PROGRAMMER OF THIS APP. ALL ERRORS MUST BE REPORTED TO cliqsapp@gmail.com or
VISIT MY WEBSITE realcliqs.com THIS APP CAN RUN ON ANY WINDOWS OF WINDOW XP,7,8,8.1,NT WITH 
AT LEAST 512MB RAM, 1.5GHz PROCESSOR, 80GB HDD, AN INTERNET CONNECTION 
FOR MORE USABILITY. 
JAVASCRIPT SUPPORTED DEVICE	*/
//LIVE;
?>