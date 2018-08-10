// JavaScript Document
$(function(){
	x=101;
	
	login=function(e){
		e.preventDefault();
		var pwd=$('#pwd').val(),
		usr=$('#usr').val(),
		url=$(this).closest('form').attr('action');
		$('#feedback').html('<center><img src="../images/r.gif" width="20px"></center>');
		$.post(url,{'usr':usr,'pwd':pwd},function(data){
			if(data==x){
				window.location=e.data.referer;
			}else{
				$('div #feedback').html(data);
				}
			});
		
		}
	
	addmember=function(e){
		e.preventDefault();
		var name=$('#name').val(),
		tel=$('#tel').val(),
		pwd=$('#pwd').val(),
		sex=$('#sex').val(),
		addr=$('#addr').val(),
		dpt=$('#dpt').val(),
		role=$('#role').val(),
		url=$(this).closest('form').attr('action');
		//alert(name);
		
		$('#feedback').html('<center><img src="../images/r.gif" width="20px">	Creating Account...</center>');
		$.post(url,{'role':role,'name':name,'tel':tel,'pwd':pwd,'sex':sex,'addr':addr,'dpt':dpt},function(data){
			
				$('#feedback').html(data);		
			});
		
		}
	
	memberpassport=function(event){
			event.preventDefault();
			var fdta=new FormData($('form:file')[0]);
			$.each($('#pfile')[0].files,function(i,file){
				fdta.append('file',file);
				});
				//fdta.serialize();
			
				$.ajax({
					url: '../process/uaskl.php',
           			type: 'POST',
            		data: fdta,
					contentType:false,
					processData:false,
					cache:false,
					beforeSend:function(evt){
						
							
								$('#feedback').html('<center><img src="../images/r.gif" width="20px"></center>');
								
						},
					error:function(){
						alert('An Error Occured, Try Again');
						},
            		success: function (data) {
						if(data==x){
							$('#feedback').empty().html('<b><img src="../images/r.gif" width="20px">&nbsp;<span style="color:green;">File Ready</span>:Waiting For Other Fields For Submission.</b>');
							
						}else{
							$('#feedback').html(data);
							}
					}
        			});
			}
			
	hidex=function(){
		
		var diagnose=$(this).val();
		
			if(diagnose==1){
				
				$('#ds').css({'visibility':'visible'}).show();
				
			}else{
				
				$('#ds').hide();
				
				
				}
		
		}
	
	
	

/************************End Function*************************************/


/* **********************|Binders|****************************************** */
	
	$('#sblogin').bind('click',{referer:'cpanel.php'},login);
	$('#dg').bind('click change',hidex);
//	$('#pfile').bind('change',memberpassport);
//	$('#class').bind('click change',getsubclass);
//	$('#hfile').bind('change',adddoctolibrary);
//	$('#additem').bind('click',additem);
//	$('#gsearch').bind('keyup',isearch);
//	$('#addclass').bind('click',addtocatalog);
//	$('p > a').bind('click',opensubclass);
//	$('#addsubclass').bind('click',addsubclass);
//	$('#exploreshelf').bind('click submit',shelf);
//	$('#right cc').on('click','a',removefromshelf);
//	$('#callno').bind('keyup',searchusingcallno);
//	$('#right cc').on('click','#bwbk',iborrow);
//	$('#acprq').bind('click',acceptrequest);
//	$('#dcrrq').bind('click',declinerequest);
//	$('#delbr').bind('click',returntolib);
	
	
	
});