// Function to save an instance of a siteinfo record in the mySQL database
<?php
 
// if the 'url' variable is not sent with the request, exit
if ( !isset($_REQUEST['url']) )
    exit;

	// success message the thank you message to return to the user
	$resultoutput = '';
try {
	// connect to the database
	$pdo = new PDO('mysql:host=localhost;dbname=siteinfo;charset=utf8', 'siteuser', 'siteuser');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	// prep the date
	$adate = explode('/', $_REQUEST['newdate']);
	$time = mktime(0,0,0,$adate[0],$adate[1],$adate[2]);
	$mysqldate = date( 'Y-m-d H:i:s', $time );
	// build the appropriate update statement 
	if (isset($_REQUEST['requesttype']) AND $_REQUEST['requesttype'] == 'N')  {
		// build an insert statement to save the information
		$stmt = $pdo->prepare("INSERT INTO siteinfo (url,description,lastname,firstname,email,phone,original_launch_date,last_update_date) VALUES(:url,:desc,:lastname,:firstname,:email,:phone, :launch,NOW())");
		$stmt->execute(array(':url' => $_REQUEST['url'], ':desc' => $_REQUEST['description'], ':lastname' => $_REQUEST['lastname'], ':firstname' => $_REQUEST['firstname'], ':email' => $_REQUEST['email'], ':phone' => $_REQUEST['phone'], ':launch' => $mysqldate ));
		$affected_rows = $stmt->rowCount();

	} else {	
		// build an update statement to save the information
		$stmt = $pdo->prepare("UPDATE siteinfo Set lastname = :lastname, firstname = :firstname, email = :email, phone = :phone, changes = :changes, update_date = :relaunch, last_update_date = NOW() WHERE url = :url");
		$stmt->execute(array(':lastname' => $_REQUEST['lastname'], ':firstname' => $_REQUEST['firstname'], ':email' => $_REQUEST['email'], ':phone' => $_REQUEST['phone'], ':changes' => $_REQUEST['changes'], ':relaunch' => $mysqldate, ':url' => Trim($_REQUEST['url'])) );
		$affected_rows = $stmt->rowCount();
	}

	// if success, show the thank you page
	header("Location: http://localhost:8084/register/thankyou.php");
} catch(PDOException $ex) {
    $resultoutput = "<div class='result'>An error has occurred. Please try again.</div>";
    $resultoutput = $ex->getMessage();
    //some_logging_function($ex->getMessage());
    echo $resultoutput;
}

