// Function to read a record from the siteinfo database and return data as JSON
<?php
 
// if the 'url' variable is not sent with the request, exit
if ( !isset($_REQUEST['url']) )
    exit;
 
// connect to the database server and select the appropriate database for use
try {
    // connect to the database
    $pdo = new PDO('mysql:host=localhost;dbname=siteinfo;charset=utf8', 'siteuser', 'siteuser');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $pdo->prepare("SELECT * from siteinfo WHERE url = ?");
    $stmt->bindValue(1, $_REQUEST['url'], PDO::PARAM_STR);
    $stmt->execute();
 
    // if we got a row match, send back the data
    if ( $row = $stmt->fetch()) {
        echo json_encode($row);
        flush();
    }
} catch(PDOException $ex) {
    $data = array();
    // jQuery wants JSON data
    echo json_encode($data);
    flush();    
}