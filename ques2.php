<?php
$servername = "localhost";
    $dbname = "testDB";
    $username = "phpmyadmin";
    $password = "ttn";
$search_value=$_POST["search"];
$con=new mysqli($servername,$username,$password,$dbname);
if($con->connect_error){
    echo 'Connection Faild: '.$con->connect_error;
    }else{
        $sql="select * from test2 where firstname like '%$search_value%'";

        $res=$con->query($sql);

        while($row=$res->fetch_assoc()){
            // echo 'First_name:  '.$row["firstname"];
            echo '<table border=2>';

    echo '<td>'. $row["firstname"]. '</td>';
    echo '<td>'. $row["lastname"]. '</td>';
    echo '<td>'. $row["email_id"]. '</td>';
    echo '<td>'. $row["contact_no"]. '</td>';
    echo '</table>';

            }       

        }
?>