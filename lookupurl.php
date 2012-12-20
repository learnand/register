// Function to look up a URL in the database and to return close matches for dropdown (display, value)
<?php
 
// if the 'term' variable is not sent with the request, exit
if ( !isset($_REQUEST['term']) )
    exit;
 
// connect to the database server and select the appropriate database for use
try {
    // connect to the database
    $pdo = new PDO('mysql:host=localhost;dbname=siteinfo;charset=utf8', 'siteuser', 'siteuser');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $pdo->prepare("SELECT url, lastname, firstname from siteinfo WHERE url LIKE ? order by url asc limit 0,25");
    $stmt->bindValue(1, "%{$_REQUEST['term']}%", PDO::PARAM_STR);
    $stmt->execute();
 
    // loop through each url returned and format the response for jQuery
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = array(
            'label' => $row['url'] .', '. $row['firstname'] .' '. $row['lastname'] ,
            'value' => $row['url']
        );
    }
 
    // jQuery wants JSON data
    echo json_encode($data);
    flush();


} catch(PDOException $ex) {
    $data = array();
    // jQuery wants JSON data
    echo json_encode($data);
    flush();    
}
