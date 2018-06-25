<?php
    session_start();
    $con = mysqli_connect("localhost","root","root","GradeManager","3306");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    $sql = "select year,term from school_year where now=1";
    $result=mysqli_query($con,$sql);
    $school_year=mysqli_fetch_array($result);
    $year=$school_year['year'];
    $term=$school_year['term'];
    $sql = "insert into grade values('"._post("sno")."','"._post("cid")."','".$year."','".$term."',"._post("peacetime").","._post("terminal").",null,"._post("overall").")";
    $result = mysqli_query($con,$sql);
    echo "success";
    function _post($str){
        $var = !empty($_POST[$str]) ? $_POST[$str] : null;
        return $var;
    }
    mysqli_close($con);
?>