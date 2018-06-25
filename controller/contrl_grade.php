<?php
    session_start();
    $con = mysqli_connect("localhost","root","root","GradeManager","3306");
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
      
    $school_year = _post("school_year");
    $term = _post("term");

    function _post($str){
        $val = !empty($_POST[$str]) ? $_POST[$str] : null;
        return $val;
    }

    $sql = "select * from grade where school_year='".$school_year."' and term='".$term."'";

    $result = mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);

    if($num>0){
        while($array = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>",$array['school_year'],"&nbsp;&nbsp;&nbsp;&nbsp;",$array['term'],"</td>";
            echo "<td>",$array['cid'],"</td>";
            $sql = "select cname from course where cid='".$array['cid']."'";
            $rt = mysqli_query($con,$sql);
            $course = mysqli_fetch_array($rt);
            echo "<td>",$course['cname'],"</td>";
            echo "<td>",$array['peacetime'],"</td>";
            echo "<td>",$array['terminal'],"</td>";
            echo "<td>",$array['overall'],"</td>";
            echo "</tr>";
        }
    }else{
        echo "not_exist";
    }
    
    mysqli_close($con);
?>