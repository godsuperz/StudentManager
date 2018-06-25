<?php
    session_start();
    $con = mysqli_connect("localhost","root","root","GradeManager","3306");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    $sql = "update schedule set islocked=1 where class='"._post("class")."' and cid='"._post("cid")."'";
    if(mysqli_query($con,$sql)){
        echo "success";
    }else {
        echo "error_sql";
    }
    
    function _post($str){
        $var = !empty($_POST[$str]) ? $_POST[$str] : null;
        return $var;
    }
    mysqli_close($con);
?>