<?php
    print_r($_POST);
    if(isset($_POST['student_name'])){
        $studentName = $_POST['student_name'];
        $advisorName = $_POST['advisor_name'];
        echo getAdvisor($studentName) . "<br>";
        echo getStudents($advisorName) . "<br>";
    }
    function getAdvisor($studentName){
        
        $db = getDatabaseConnection();
        $sql = "SELECT departments.advisor FROM students INNER JOIN departments ON students.department_id = departments.department_id WHERE students.first_name LIKE '%$studentName%'";
        echo "<br>";
        echo "$sql";
        $stmt =  $db->prepare($sql);
        $result = $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $index = 0;
        
        foreach($records as $a){
            echo "$records[$index]['advisor']";
            $index = $index + 1;
        }
        if(count($records)){
            $sql =  $records[0]['advisor'];
        }
        return $sql;
    }
    
    function getStudents($advisorName){
        $db = getDatabaseConnection();
        $sql = "SELECT students.first_name FROM students INNER JOIN departments ON departments.department_id = students.department_id WHERE departments.advisor LIKE '%$advisorName%'";
        echo "<br>";
        echo "$sql";
        $stmt =  $db->prepare($sql);
        $result = $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $index = 0;
        foreach($records as $a){
            echo "$records[$index]['advisor'] <br>";
            $index = $index + 1;
        }
        
        if(count($records)){
            $sql =  $records[0]['first_name'];
        }
        return $sql;
        
    }
    
    function getDatabaseConnection() {
    $host = "localhost";
    $username = "Adrian";
    $password = "wsn4life";
    $dbname = "classroom_mode"; 
    
    // Create connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConn; 
}
?>
<!DOCTYPE html>

<html>
    <head>
        
    </head>
    <body>
        
        <form method="post">
            <input name='student_name' type="text" />
            <input name='advisor_name' type="text" />
            <input type ="submit" />
        </form>
        
    </body>
</html>