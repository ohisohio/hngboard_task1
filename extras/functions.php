<?php

require_once 'config/conn.php';
$conn = OpenCon();

//CSV import function
function csvimport(){
    if (isset($_POST["import"])) {
        global $conn;
    
        $fileName = $_FILES["file"]["tmp_name"];
        
        if ($_FILES["file"]["size"] > 0) {
            
            $file = fopen($fileName, "r");
            
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                
                $fullname = "";
                if (isset($column[0])) {
                    $fullname = mysqli_real_escape_string($conn, $column[0]);
                }
                $username = "";
                if (isset($column[1])) {
                    $username = mysqli_real_escape_string($conn, $column[1]);
                }
                $email = "";
                if (isset($column[2])) {
                    $email = mysqli_real_escape_string($conn, $column[2]);
                }
                $points = "";
                if (isset($column[3])) {
                    $points = mysqli_real_escape_string($conn, $column[3]);
                }

                $sqlInsert = "INSERT into board (fullname,username,email,point)
                   values ('$column[0]','$column[1]','$column[2]','$column[3]')";
           
            $run = mysqli_query($conn, $sqlInsert);
            
            if (! empty($run)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
               

            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
      
}

//JSON import function
function jsonimport(){
    if(isset($_POST['import'])) {

        $fileName = $_FILES["file"]["tmp_name"];        
        $data = file_get_contents($fileName);
        $content = json_decode($data,true);
        global $conn;
        $name = $content['fullname'];
        $username = $content['username'];
        $email = $content['email'];
        $point = $content['point'];

        foreach ($content as $row){
            $sqlInsert = "INSERT into board (fullname,username,email,point)
        values ('.$row[$name]','.$row[$username]','.$row[$email]','.$row[$point]')"; 
        $run = mysqli_query($conn, $sqlInsert);
        }

       

 
 if (! empty($run)) {
    $type = "success";
    $message = "JSON Data Imported into the Database";
   

} else {
    $type = "error";
    $message = "Problem in Importing JSON Data"; 
}
}
}

?>

