<?php
    session_start();
    $con = mysqli_connect("localhost","root","root","GradeManager","3306");
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
      
    $tid = _post("tid");
    $tpassword = _post("tpassword");

    function _post($str){
        $val = !empty($_POST[$str]) ? $_POST[$str] : null;
        return $val;
    }

    $sql = "select * from teacher where tid = '".$tid."'";

    $result = mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);

    if($num>0){
        $target = mysqli_fetch_array($result);
        if($target["tpassword"]==$tpassword){
            $_SESSION['tid'] = $target['tid'];
            $_SESSION['tname'] = $target['tname'];
            echo "success_login";
        }else{
            echo "error_password";
        }
    }else{
        echo "not_exist";
    }
    
    mysqli_close($con);
?>