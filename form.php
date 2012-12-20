<!DOCTYPE html>
<meta charset=utf-8>
<html lang=en>
<head>
<title>Web Site Launch</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<link rel="stylesheet" type="text/css" href="main.css">

 <!-- load jQuery core and tools -->
<script src="jquery/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="jquery/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
<script src="jquery/jquery.validate.min.js" type="text/javascript"></script>
<script src="jquery/jquery.maskedinput-1.3.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="jquery/css/jquery-ui-1.9.2.custom.min.css">
</head>

<body>

<div id="pageBody" style="background-color: #E2E2E2; width: 800px;">
<span class="pageTitle">Register Web Site Action</span>

<br />	

<form id="edit" name="edit" method="post" action="saveinfo.php">
<div id="error" style="display: none;"></div>

<p class="steps">Step 1: What is the URL for the site?</p>
<div class="control-group">
	<label class="control-label" for="siteurl">Site URL:</label>
	<div class="control">
	<input  class="required url" name="url" type="text" id="url" value="" size="50" tabindex="1" />&nbsp;[http://mysite.com]
	</div>
</div>
<br />
<p  class="steps">Step 2: What is happening with the site?</p>
<div class="control-group">
	<label class="control-label" for="requesttype">It is a:</label>
	<div class="control">
	<input name="requesttype" type="radio" id="changenew" value="N" checked tabindex="2" />&nbsp;New Site
	<input name="requesttype" type="radio" id="changeupd" value="U" tabindex="2" />&nbsp;Re-launch of an existing Site
	</div>
	<!-- new launch shows editable description, re-launch shows r/o description and original launch date -->
</div>
<br />
<p class="steps">Step 3: When?</p>
<div class="control-group">
	<label class="control" for="newdate">Launch Date:</label>
	<div class="control">
	<input  class="required date" name="newdate" type="text" id="newdate" value="" size="10" tabindex="3" />&nbsp;<a href="#" id="dpicon" ><img class="newdateicon" src="images/datepick.jpg" border="0" /></a>
	</div>
</div>
<br />
<p class="steps">Step 4: Information about the site and the person registering this event.</p>
<div class="control-group">
	<label class="control-label" for="description">Site Description:</label>
	<div class="control">
	<textarea class="required" id="description" name="description" style="display: block;" cols="55" tabindex="5">
		
	</textarea>
	<span id="showdescription" style="display: none;"></span>
	</div>
</div>
<br />
<div class="control-group">
	<label class="control-label" for="firstname">First Name:</label>
	<div class="control">
	<input  class="required" name="firstname" type="text" id="firstname" value="" size="50"  tabindex="6"/>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="lastname">Last Name:</label>
	<div class="control">
	<input  class="required" name="lastname" type="text" id="lastname" value="" size="50" tabindex="7"/>
	</div>
</div>
<br />

<div class="control-group">
	<label class="control-label" for="email">Email:</label>
	<div class="control">
	<input  class="required email" name="email" type="text" id="email" value="" size="50" tabindex="8"/>
	</div>
</div>
<br />
<div class="control-group">
	<label class="v" for="phone">Phone:</label>
	<div class="control">
	<input class="phone" name="phone" type="text" id="phone" value="" size="25" tabindex="9" />
	</div>
</div>
<br />

<!-- shown if re-launch -->
<div id="relaunch" style="display: none;">
	<div class="control-group ui-widget">
		<label class="control-label" for="changes">Description of Changes:</label>
		<div class="control">
		<textarea  class="required" id="changes" name="changes" cols="55" tabindex="10">
		
		</textarea>
		</div>
	</div>
	<br />
	<div class="control-group">
		<label class="control-label" for="originallaunchdate">Date of Original Launch:</label>
		<div class="control">
		  <span id="originallaunchdate"></span>
		</div>
	</div>
	<br />
</div>
<!-- re-launch section -->

<div align="center">

<input name="savebutton" type="submit" id="savebutton" value="  Save " tabindex="11"/>

</div>
 
</form>
</div>  <!--  pagebody -->

<script language="javascript">
	$(document).ready(function() {

        $("#edit").validate();              // form validation
		$( "#newdate" ).datepicker({ altField: '#newdate', 
									 buttonImage: 'images/datepick.jpg',
									 buttonImageOnly: false }
									 );        
        $( "#newdate" ).datepicker();    //date
        $("#dpicon").click(function() { 
   			$("#newdate").datepicker( "show" ); });     

        // handle switch between new and re-launch requests
        $("input[id='changeupd']").click(function() {
        	$("#relaunch").show();
        	$("#description").hide();  
        	$("#showdescription").show();      	
        });
        $("input[id='changenew']").click(function() {
        	$("#relaunch").hide();
        	$("#description").show();
        	$("#showdescription").hide();
        });
       	// provide a formatting mask for phone numbers; US assumed
         $("input.phone").mask("(999) 999-9999? x99999");  

        // autocomplete on the URL field
        $('#url').autocomplete(
        	{source:'lookupurl.php', 
        	minLength:9,
        	select: function(event, ui) {
        		//  ajax to get all the fields, populate the form
        		$.ajax({ url: 'geturlrecord.php',
        		data: {url: ui.item.value},
         		type: 'get',
         		success: function(output) {
         			var res = jQuery.parseJSON(output);
                    loadFormData(res);
                  }
			});
            }
		});        

        $("#url").focus();   
    });

function loadFormData(data) {       
	// record exists, so this is an update
    $("#changeupd").prop('checked',true);
    $("#description").hide();  	
    $("#relaunch").show();
    $("#showdescription").show();    
    // other fields
    $("#showdescription").html(data['description']).show();
    $("#description").val(data['description']).show();    
    $("#firstname").val(data['firstname']);
    $("#lastname").val(data['lastname']);
    $("#email").val(data['email']);
    $("#phone").val(data['phone']);
    $("#changes").val(data['changes']);
    $("#originallaunchdate").html(data['original_launch_date']);
}
</script>
 
</body>
</html>