<?php
    session_start();
    $con = mysqli_connect("localhost","root","root","GradeManager","3306");
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
      
    $sno = _post("sno");
    $spassword = _post("spassword");

    function _post($str){
        $val = !empty($_POST[$str]) ? $_POST[$str] : null;
        return $val;
    }

    $sql = "select * from student where sid = '".$sno."'";

    $result = mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);

    if($num>0){
        $target = mysqli_fetch_array($result);
        if($target["spassword"]==$spassword){
            $_SESSION['sno'] = $target['sid'];
            $_SESSION['sname'] = $target['sname'];
            echo "success_login";
        }else{
            echo "error_password";
        }
    }else{
        echo "not_exist";
    }
    
    mysqli_close($con);
?>