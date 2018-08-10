<?php
namespace cliqsFrameWork\users;


/*	
	Encryption Type: AES
	Database Salt: cliqsdiamond
	App Provider: Cliqs Team
	User Website: realcliqs.com
	Author: Akindutire Ayomide Samuel
	Email: cliqsapp@gmail.com or akindutire33@gmail.com
	GPL Free Licience
	Contact: 08107926083
	Database Encrypted, System Trial Flag Available, And Personalized Script
	
*/


define('EXKIT','../images/exp.bmp');
define('UPKIT','../conn/update.txt');
define('SIKIT','../include/silent.bmp');
define('RELOCATEKITDIRECTORY','../images/silent.bmp');
define('X',101);

$link=mysqli_connect('localhost','root','','poultry');


class connect{
	
	public function iconnect(){
		
			global $link;
			
			if($link){
				echo "";
			}else{
				die("System Currently Not Available, Try Again Later");
				}
		}
	
}

/*This Class Checks The System Integrity*/


class performance{
	
	
	public function checkSys(){
		
		global $link;
		
		$sql=mysqli_query($link,"SELECT * FROM performancetab WHERE st='1'") or die('101xFc: Unknown Reference');
		list($id,$start,$exp,$istatus,$lastmin)=mysqli_fetch_row($sql);
	
		if(mysqli_num_rows($sql)==0 && file_exists(EXKIT)==false){ 
			
			$trial=4;
			
			$this->createTrial($trial);
		

		}else if(file_exists(EXKIT)==false){
		
		
			$this->repairTrial($exp,$lastmin);
		
		}else if($exp=='LP'){
		
			echo '';
		
		}else{
		
			$this->updateTrial($exp,$lastmin);
		
			}
	}
	
	//Inter Fc
	
	private function createTrial($trial){
		global $link;
		
		//@Db Salt;
		$salt='cliqsdiamond';
		
		
		$start=date(time());
		$exp=date(strtotime("+ $trial month"));
		
		$fd=fopen(EXKIT,'w+');
		fwrite($fd,$exp);
		
		mysqli_query($link,"INSERT INTO performancetab(id,ifr,tg,st,lm) VALUES('NULL','$start','$exp',1,'$start')");

	}
	
	private function repairTrial($exp,$lastmin){
		
		global $link;
		
		$fd=fopen(EXKIT,'w+');
		fwrite($fd,$exp);
		mysqli_query($link,"UPDATE performancetab SET lm='$lastmin' WHERE id=1 and st=1");

		
		}
	
	private function updateTrial($exp,$lastmin){
		
		global $link;
		
		$inow=date('d M Y, H:i a',time());
		
		$now=date(time());
		
			if($lastmin>$now){
				die('System/PC Time Inaccurate, Please Adjust Your Date,$inow');
			
			}else if($now>=$lastmin){
				
				file_exists(SIKIT)?'':die('Application Error: Some Modules Unable To Load');
				
				if($now>$exp){
							
					@rename(SIKIT,RELOCATEKITDIRECTORY);
					die('Unexpected Reference 101xF, Strongly Recommend Contacting App Provider.');
						
				}else{
					$new_min=date(time());
					mysqli_query($link,"UPDATE performancetab SET lm='$new_min' WHERE id=1 and st=1");
				}	
			}
		}
	
	
	public function AppWriter($data){
		
		$time=date('d M Y, H:i a',time());
		$data="[$time]->$data\n
		----------------------------------------------------------------------------------
		\n";
		
		file_exists(UPKIT)?'':die('Application Error: Some Modules Unable To Load');
		
		$fd=fopen(UPKIT,'a+');
		fwrite($fd,$data);
		fclose($fd);
		}
	//End Inter Fc
		
}//End Class SysPerformance



class user{
	
	public function login($usr,$pwd){
		global $link;
		
		$sql=mysqli_query($link,"SELECT * FROM users WHERE mat='".mysqli_real_escape_string($link,$usr)."' AND password='".mysqli_real_escape_string($link,$pwd)."' AND bk='0'");
		
		if(mysqli_num_rows($sql)==1){
			$data="$usr LOGGED IN Through ".$_SERVER['HTTP_USER_AGENT'].' On A '.$_SERVER['HTTP_CONNECTION'].' Connection';
			
			$_SESSION['iusr']=$usr;
			$_SESSION['ipwd']=$pwd;
			
			performance::AppWriter($data);
			echo X;
		}else{
			echo "<img src='../images/cancel.png' width='auto' height='14px'>&nbsp;Invalid Combination";
			}
		
		}
		
	public function getdata(){
		global $link;
		
			$usr=$_SESSION['iusr'];
			$pwd=$_SESSION['ipwd'];
		
		
			$sql=mysqli_query($link,"SELECT id,role FROM users WHERE mat='".mysqli_real_escape_string($link,$usr)."' AND password='".mysqli_real_escape_string($link,$pwd)."'");
		
			list($id,$role)=mysqli_fetch_row($sql);
			$_SESSION['role']=$role;
			
			return $id;
		}
		
		
	public function logout($admin){
		global $link;
		
			
			$_SESSION[]=array();
			session_unset();
			
			$usr=$_SESSION['iusr'];
			
			$data="$usr LOGOUT Through ".$_SERVER['HTTP_USER_AGENT'].' On A '.$_SERVER['HTTP_CONNECTION'].' Connection';
			
			
			performance::AppWriter($data);

		if($admin!=1){
			header('location:../');
		}else{
			header('location:../admin');
			}

		}	
		
	
	public function verifylogin($role){
		global $link;
		$usr_id=$this->getdata();
		$role=ucfirst($role);
		if($_SESSION['role']==$role){
			
			echo '';
			
		}else{
			header('location:lgt.php');
			}		
		}
		
	public function haveexternalrights(){
		global $link;
		
		$usr_id=$this->getdata();
		$sql=mysqli_query($link,"SELECT extrights FROM users WHERE id='$usr_id'");
		list($ex)=mysqli_fetch_row($sql);
			
			return $ex;
		}
		
	public function addmember($telormat,$name,$dpt,$addr,$sex,$ipwd,$role){
		global $link;

		/* ******** Checking Member Existence *********************** */
		$exc=mysqli_query($link,"SELECT * FROM users WHERE mat='$telormat'");
		if(mysqli_num_rows($exc)>0 && !empty($teleormat)){
			die('This User has been registered, try another ID');
		}
		
		/* ********  Member Registration *********************** */
		$sql=mysqli_prepare($link,"INSERT INTO users(id,role,name,mat,password,pix,regdate,expire,sex,bk,dpt,addr,extrights) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
		
		/* ************************Parameters***************************** */
		$passport=$_SESSION['funame'];
		$e='';
		$bk=0;
		$pwd=sha1($ipwd);
		$exp=date(strtotime('+1 year'));
		$rgdt=date('D, M Y: H:i:s a',time());
		
		
		/***************Binding Parameters****/
		mysqli_stmt_bind_param($sql,'issssssssissi',$e,$role,$name,$telormat,$pwd,$passport,$rgdt,$exp,$sex,$bk,$dpt,$addr,$bk);
		if(mysqli_stmt_execute($sql)){
		
		$usr=$_SESSION['iusr'];	
		$data="$usr REGISTERED A MEMBER Through ".$_SERVER['HTTP_USER_AGENT'].' On A'.$_SERVER['HTTP_CONNECTION'].' Connection';
			
			/**********Logging user Event********************/
			
			performance::AppWriter($data);
			$uid=mysqli_stmt_insert_id($sql);
			mysqli_query($link,"INSERT INTO rec(id,uid,sh,encoded) VALUES(NULL,'$uid','$pwd','$ipwd')");
			
			@rename("../uploads/pix/del/$passport","../uploads/pix/$passport");
			echo "<img src='../images/accept.png' height='14px' width='auto'>&nbsp;Successfully Added A Member";
			}else{
				echo "<img src='../images/cancel.png' width='auto' height='14px'>&nbsp;Registration FAILED ,Please Retry";
				}
		}
	
	//Add to Library
	public function additem(){
		global $link;
		
		/**************Checking Book Existence*********/
		
		$isbnsql=mysqli_query($link,"SELECT * FROM table WHERE xxxxx='$xxxx'");
		if(mysqli_num_rows($isbnsql)>0 && !empty($isbn)){
			die('This book has been registered, try another isbn');
			}
		
		/**************Validations**********************/


		
		
		/*----------------------*********Registering Book by Preparing A Query*************************-----------*/
		
		$sql=mysqli_prepare($link,"INSERT INTO library(id,) VALUES()");
		
		
		$e='';
		$date=date('D, M Y: H:i:s a',time());
		$id=$this->getdata();
		
		
		//mysqli_stmt_bind_param($sql,'',);
		if(mysqli_stmt_execute($sql)){
		
		$usr=$_SESSION['iusr'];
		$data="$usr REGISTERED A BOOK Through ".$_SERVER['HTTP_USER_AGENT'].' On A '.$_SERVER['HTTP_CONNECTION'].' Connection';
			
		/*****************Log User Event*************/	
			
			performance::AppWriter($data);
			
			}else{
				echo "<img src='../images/cancel.png' width='auto' height='14px'>&nbsp;Registration FAILED ,Please Retry";
				}

		}

	//Add to Catalog
	public function addclass($classname,$acr){
		global $link;

		}
		
		
	public function addsubclass($classid,$sbname,$acr){
		global $link;
		
		}

	public function deleteabook($bk){
		global $link;
	
		}
	
	
	public function borrow($bid){
		global $link;
		
	
		}
		
	public function acceptrequest($i){
		global $link;
	
		}

	public function declinerequest($i){
		global $link;
	
		}
	
	public function returntolib($i){
		global $link;
		
		
		
		}

}//End Class User


class records{
	
	public function profile(){
		global $link;
		
		$usr_id=user::getdata();
		
		$sql=mysqli_query($link,"SELECT * FROM users WHERE id='$usr_id'");
		list($e,$role,$name,$telormat,$pwd,$passport,$rgdt,$exp,$sex,$bk,$dpt,$addr,$bk)=mysqli_fetch_row($sql);
		$exp=date('D, M Y: H:i:s a',$exp);
		$role=strtoupper($role);
		echo "
		
		<p><a><img src='../uploads/pix/$passport'></a></p> 
        <p style='font-family:amble; color:green; font-size:14px;'><a><b>$role</b></a></p>
		 
        <p style='font-family:amble; color:blue;'><a>$name</a></p>
        <p style='font-family:amble; color:blue;'><a>$telormat</a></p>
        <p style='font-family:amble; color:blue;'><a>$sex</a></p>
        <p style='font-family:amble; color:blue;'><a>$dpt</a></p>
		<p style='font-family:amble; color:blue;'><a>$addr</a></p>
        <p style='font-family:amble; color:blue;'><a>Registered On $rgdt</a></p>
        <p style='font-family:amble; color:blue;'><a>Account will Expire on $exp</a></p>
       
		
		";
		
		}
	
	public function member(){
		global $link;
		
		$usr_id=user::getdata();
		$sql=mysqli_query($link,"SELECT extrights FROM users WHERE id='$usr_id'");
		list($ex)=mysqli_fetch_row($sql);
		
		
			if($ex==1){
				$sql=mysqli_query($link,"SELECT * FROM users WHERE role='Staff'");
				}else{
					$sql=mysqli_query($link,"SELECT * FROM users WHERE role='Student'");
					}
		
		echo "	<tr>
              	<th>Matric/Tel No</th>
                <th>Name</th>
                <th>Department</th>
				<th>Registered On</th>
                <th>Sex</th>
				<th>Location</th>
		      </tr>";
			
		
			
	$actions=array(
			
	'renewreg'=>'<a id="renewreg" title="Renew User Registration"><img src="../images/renew.png" width="auto" height="14px"</a>',
	
	'deletereg'=>'<a id="deletereg" title="Delete User"><img src="../images/cancel.png" width="auto" height="14px"></a>'
	
	);
			
		while(list($id,$role,$name,$telormat,$pwd,$passport,$regdate,$expire,$sex,$bk,$dpt,$addr,$bk)=mysqli_fetch_row($sql)){
			
           $color=$role=='Staff'?'rgba(0, 168, 0, 0.95)':'rgba(75, 75, 255, 0.92)';   
		   $dpt=$dpt==''?'No Department':$dpt;
		    
			 
			 
        echo "  <tr style='color:$color'>
              	<td><a href='../uploads/pix/$passport'><img src='../uploads/pix/$passport' height='20px' width='auto'></a>&nbsp;$telormat</td>
                <td>$name</td>
                <td>$dpt</td>
				<td>$regdate</td>
                <td>$sex</td>
				<td>$addr</td>
				</tr>";

			
			
			}
		}

	public function searchmember($i,$ss){
		global $link;
		
			$sql=mysqli_query($link,"SELECT * FROM users WHERE role='$ss' AND (name LIKE '%$i%' OR dpt LIKE '%$i%' OR mat LIKE '%$i%')");
		
		echo "	<tr>
              	<th>Matric/Tel No</th>
                <th>Name</th>
                <th>Department</th>
				<th>Registered On</th>
                <th>Sex</th>
				<th>Location</th>
              </tr>";

		while(list($id,$role,$name,$telormat,$pwd,$passport,$regdate,$e,$sex,$bk,$dpt,$addr,$bk)=mysqli_fetch_row($sql)){
			
           $color=$role=='Staff'?'rgba(0, 168, 0, 0.95)':'rgba(75, 75, 255, 0.92)';   
		   $dpt=$dpt==''?'No Department':$dpt;
		    
			 
			 
        echo "  <tr style='color:$color'>
              	<td><a href='../uploads/pix/$passport'><img src='../uploads/pix/$passport' height='20px' width='auto'></a>&nbsp;$telormat</td>
                <td>$name</td>
                <td>$dpt</td>
				<td>$regdate</td>
                <td>$sex</td>
				<td>$addr</td>
			   	</tr>";

			}
		} 

	public function searchshelf($callno){
		global $link;
		$callno=strtoupper($callno);
		$sql=mysqli_query($link,"SELECT * FROM library WHERE callno LIKE '%$callno%'");
		
		if(mysqli_num_rows($sql)==0){
			die("No Book Found");
			}
		
		
		$action=$_SESSION['role']=='Staff'?
		""
		:
		""
		;
		
		while(list($bkid,$cls,$title,$isbn,$uid,$pdf,$pubdate,$author,$callno,$pub_by,$added_on,$sbcls)=mysqli_fetch_row($sql)){
			$ext=strtolower(pathinfo($pdf,PATHINFO_EXTENSION));
			
			if($ext=='pdf'){
				$thumb='../uploads/library/thumbnails/pdf.jpg';
			}else if($ext=='doc' || $ext=='docx'){
				$thumb='../uploads/library/thumbnails/doc.jpg';
			}else if($ext=='ppt'){
				$thumb='../uploads/library/thumbnails/ppt.jpg';
			}else{
				$thumb='../uploads/library/thumbnails/any.jpg';
				}

			
			echo "
			
		<ul style='display:inline-block;' id='outerlist'>
        	<li id='bks'><img src='$thumb' height='auto'></li>
        	<li id='bks'>$title</li>
        	<li id='bks'>Author: $author</li>
        	<li id='bks'>Published By $pub_by</li>
        	<li id='bks'>Call No.: $callno</li>";
			if($_SESSION['role']=='Staff'){
				echo "<li id='bks'><a id='removebook' style='cursor:pointer;' data-id='$bkid' title='Remove From Shelf'><u>Remove</u></a></li>";
			}else{
				echo "<li id='bks'><a id='readbook' title='Read' href='../uploads/library/all/$pdf' target='_new'><b>Read</b></a></li>";
			}
        echo "</ul>";

		}
	}

	public function libraryclass(){
		global $link;
		
		$sql=mysqli_query($link,"SELECT * FROM libclass ORDER BY acry");
		while(list($id,$class,$acr)=mysqli_fetch_row($sql)){
			$class=strtoupper($class);
			$acr=strtoupper($acr);
			echo "<p style='font-family:amble; cursor:pointer;'><a id='lib' data-group='$id'>$acr-&nbsp;&nbsp;$class</a></p>";
			
			}
		
		}
	
	public function librarysbclass($class){

		global $link;
		
		$cv=mysqli_query($link,"SELECT acry,class FROM libclass WHERE id='$class'");
		list($mainacr,$clsd)=mysqli_fetch_row($cv);
		
		
		$sql=mysqli_query($link,"SELECT * FROM sbclass WHERE classid='$class' ORDER BY acry");
		
		echo "<p style='font-family:amble; color:rgba(0, 45, 133, 0.9);'><a href='catalog.php' title='Up Directory'><img src='../images/back.gif' vspace='-1px'></a></b>&nbsp;&nbsp;&nbsp;<b>$clsd</b></p><br>";
		
		if(mysqli_num_rows($sql)!=0){
			
		while(list($id,$clsid,$sbclass,$sbacr)=mysqli_fetch_row($sql)){
		
			$sbclass=strtoupper($sbclass);
			$sbacr=strtoupper($sbacr);
		
			echo "<p style='font-family:amble;'><a>$mainacr$sbacr-&nbsp;&nbsp;$sbclass</a></p>";
			
			}
		}else{
			echo "<p style='font-family:amble;'><a>No SubClass</a></p>";
			
			}
		}
	
	public function shelf($class,$sbclass){
		global $link;
		
		$sql=mysqli_query($link,"SELECT * FROM library WHERE cls='$class' AND sbcls='$sbclass' ORDER BY callno");
		
		if(mysqli_num_rows($sql)==0){
			die("No Book In This Catalog");
			}
		
		
		$action=$_SESSION['role']=='Staff'?
		""
		:
		""
		;
		
		while(list($bkid,$cls,$title,$isbn,$uid,$pdf,$pubdate,$author,$callno,$pub_by,$added_on,$sbcls)=mysqli_fetch_row($sql)){
			
			$ext=strtolower(pathinfo($pdf,PATHINFO_EXTENSION));
			
			if($ext=='pdf'){
				$thumb='../uploads/library/thumbnails/pdf.jpg';
			}else if($ext=='doc' || $ext=='docx'){
				$thumb='../uploads/library/thumbnails/doc.jpg';
			}else if($ext=='ppt'){
				$thumb='../uploads/library/thumbnails/ppt.jpg';
			}else{
				$thumb='../uploads/library/thumbnails/any.jpg';
				}
			
			echo "
			
		<ul style='display:inline-block;' id='outerlist'>
        	<li id='bks'><img src='$thumb' width='150px' height='auto'></li>
        	<li id='bks'>$title</li>
        	<li id='bks'>Author: $author</li>
        	<li id='bks'>Published By $pub_by</li>
        	<li id='bks'>Call No.: $callno</li>";
			$usr_id=user::getdata();
			
			
			if($_SESSION['role']=='Staff'){
				echo "<li id='bks'><a id='removebook' style='cursor:pointer;' data-id='$bkid' title='Remove From Shelf'><u>Remove</u></a></li>";
			}else{
				$rt=mysqli_query($link,"SELECT callno from borrower WHERE lib_id='$usr_id' and callno='$callno'");
				
				if(mysqli_num_rows($rt)==0){
				
				echo "<li id='bks'><a id='readbook' title='Read' href='../uploads/library/all/$pdf' download><b>Read</b></a>&nbsp;|&nbsp;<a id='bwbk' data-idr='$bkid' style='cursor:pointer;' title='Make A Borrower Request'><b><bv>Borrow</bv></b></a></li>";
					}else{
					echo "<li id='bks'><a id='readbook' title='Read' href='../uploads/library/all/$pdf' download><b>Read</b></a>";
						}
			}
        echo "</ul>";
			
			}
		}
		
	public function requests(){
		global $link;
		$id=user::getdata();
		
		$rsql=mysqli_query($link,"SELECT * FROM br WHERE uid='$id'");
		$pd=mysqli_num_rows($rsql);
		
		
		$sql=mysqli_query($link,"SELECT requeststatus FROM borrower WHERE lib_id='$id' AND requeststatus='1'");
		list($rq)=mysqli_fetch_row($sql);
		$bd=mysqli_num_rows($sql);
		
		if($pd!=0){
			
			echo "<center>$pd Pending Request, $bd Books Borrowed </center>";
			
		}else{
			
			echo "<center>No Pending Or Borrower Request </center>";
			}
		}

	public function pendingrequests(){
		global $link;
		$id=user::getdata();
		
		      echo "<tr>
              	<th>Matric No.</th>
                <th>Name</th>
                <th>Department</th>
                <th>Call No.</th>
                <th>Action</th>
              </tr>";

		
		
		$rsql=mysqli_query($link,"SELECT * FROM br");
		$pd=mysqli_num_rows($rsql);
		echo "<center>$pd Borrow Request</center>";
		
		if($pd!=0){
		$cur=time();
		while(list($eid,$uid,$event,$xtime)=mysqli_fetch_row($rsql)){
			
		if($cur>$xtime){
				mysqli_query($link,"DELETE FROM br WHERE id='$eid'");
				mysqli_query($link,"DELETE FROM borrower WHERE pid='$eid'");
				
		}else{
			
			
			$sql=mysqli_query($link,"SELECT name,mat,dpt FROM users WHERE id='$uid'");
			list($name,$mat,$dpt)=mysqli_fetch_row($sql);
			
			$fsql=mysqli_query($link,"SELECT callno FROM borrower WHERE pid='$eid'");
			list($callno)=mysqli_fetch_row($fsql);
			
			
			
			echo "
			<tr style='font-family:amble;'>
              	<td>$mat</td>
                <td>$name</td>
                <td>$dpt</td>
                <td>$callno</td>
				<td><a id='acprq' data-prq='$eid' style='cursor:pointer;' title='Accept'><img src='../images/accept.png' height='14px' width='auto'></a>&nbsp;|&nbsp;
				
				<a id='decrq' data-drq='$eid' style='cursor:pointer;' title='Decline'><img src='../images/cancel.png' height='14px' width='auto'></td>
              </tr>
			
			";
			}
			}//end loop
		}else{
			echo "";
			}
		}
	
	public function borrowers(){
		global $link;
			
			echo "<tr>
              	<th>Matric No.</th>
                <th>Name</th>
                <th>Department</th>
                <th>Call No.</th>
                <th>Borrowed On</th>
				<th>Return Date</th>
				<th>Action</th>
              </tr>";
			
			
			$sql=mysqli_query($link,"SELECT * FROM borrower");
			while(list($id,$callno,$date,$stud,$return,$rqst,$pid)=mysqli_fetch_row($sql)){
			
			$rtd=date('D M Y',$return);
			$brd=date('D M Y',$date);
			
			$insql=mysqli_query($link,"SELECT name,mat,dpt FROM users WHERE id='$stud'");
			list($name,$mat,$dpt)=mysqli_fetch_row($insql);
			
			echo "
			<tr style='font-family:amble;'>
              	<td>$mat</td>
                <td>$name</td>
                <td>$dpt</td>
                <td>$callno</td>
				<td>$brd</td>
				<td>$rtd</td>
				<td>
				<a id='delbr' data-bk='$id' style='cursor:pointer;' title='Return Book'><img src='../images/bck.png' height='14px' width='auto'></a>;
				</td>
              </tr>
			
			";

			}
		}
		


}//End Of Records




?>