<?php
function getDatabaseConnection() {
    $host = "localhost";
    $username = "Adrian";
    $password = "wsn4life";
    $dbname = "namePicker"; 
    
    // Create connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConn; 
}


$dbConn = getDatabaseConnection();

function displayUsers() {
    
    $dbConn = getDatabaseConnection(); 

    $sql = "SELECT * from student"; 
    $statement = $dbConn->prepare($sql); 
    
    $statement->execute(); 
    $records = $statement->fetchAll(); 
    
    foreach ($records as $record) {
        echo $record["first_name"]."<br>"; 
    }
}

displayUsers();


?>