<!DOCTYPE html>
<?php
    session_start();
    $con = mysqli_connect("localhost","root","root","GradeManager","3306");
    if (!$con)
    {
    die('Could not connect: ' . mysql_error());
    }
?>
<html>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="../images/student.ico" type="image/x-icon">
<title>成绩管理系统</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="../css/w3.css" />
<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="../js/jquery-3.3.1.js"></script>

<style>
  html,
  body,
  h1,
  h2,
  h3,
  h4,
  h5 {
    font-family: "RobotoDraft", "Roboto", sans-serif, "微软雅黑"
  }
</style>

<body class="w3-light-grey">

  <!-- Top container -->
  <div class="w3-bar w3-top w3-blue w3-large w3-card" style="z-index:4">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();">
      <i class="fa fa-bars"></i>  Menu</button>
    <span id = "homePage" class="w3-bar-item w3-right w3-btn w3-text-white w3-wide" onclick=""><i><strong>SUPERXZ</strong></i></span>
  </div>

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar">
    <br>
    <div class="w3-container w3-row">
      <div class="w3-col s4">
        <img src="./../images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
      </div>
      <div class="w3-col s8 w3-bar">
        <span>
          <strong>欢迎您,
            <?php
              if(isset($_SESSION['name']) && isset($_SESSION['id'])){
                echo $_SESSION['name'].'('.$_SESSION['id'].')'; 
              } else {
                header("location:./login_teacher.html"); 
              }
            ?>
          </strong>
        </span>
        <br>
        <a href="#" class="w3-bar-item w3-button">
          <i class="fa fa-envelope"></i>
        </a>
        <a href="#" class="w3-bar-item w3-button">
          <i class="fa fa-user"></i>
        </a>
        <a href="#" class="w3-bar-item w3-button">
          <i class="fa fa-cog"></i>
        </a>
      </div>
    </div>
    <hr>
    <div class="w3-container">
      <h5><strong>我的</strong></h5>
    </div>
    <div class="w3-bar-block">
      <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu">
        <i class="fa fa-remove fa-fw"></i>  Close Menu</a>
      <a href="./grade_admin.php" class="w3-bar-item w3-button w3-padding">
        <i class="fa fa-users fa-fw"></i>  成绩管理</a>
      <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding">
        <i class="fa fa-eye fa-fw"></i>  发布公告</a>
      <!-- <a href="./developing.php" class="w3-bar-item w3-button w3-padding">
        <i class="fa fa-users fa-fw"></i>  我的预警</a>
      <a href="./developing.php" class="w3-bar-item w3-button w3-padding">
        <i class="fa fa-bullseye fa-fw"></i>  我的课表</a>
      <a href="./developing.php" class="w3-bar-item w3-button w3-padding">
        <i class="fa fa-diamond fa-fw"></i>  选课</a>
      <a href="./developing.php" class="w3-bar-item w3-button w3-padding">
        <i class="fa fa-bell fa-fw"></i>  我的考试</a>
      <a href="./grade.php" class="w3-bar-item w3-button w3-padding">
        <i class="fa fa-bank fa-fw"></i>  我的成绩</a>
      <a href="./developing.php" class="w3-bar-item w3-button w3-padding">
        <i class="fa fa-history fa-fw"></i>  校外考试</a>
      <a href="./developing.php" class="w3-bar-item w3-button w3-padding">
        <i class="fa fa-cog fa-fw"></i>  毕业论文</a> -->
      <br>
      <br>
    </div>
  </nav>


  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu"
    id="myOverlay"></div>

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:300px;margin-top:43px;">

    <!-- Header -->
    <header class="w3-container" style="padding-top:22px">
      <h5 class="w3-left">
        <b>
          <i class="fa fa-dashboard"></i> 成绩管理
          <i class="fa fa-angle-right"></i> 锁定分数</b>
      </h5>
      <button id="goback" class="w3-button w3-grey w3-hover-blue w3-round w3-hover-shadow w3-right">返回</button>
    </header>

    <div class="w3-container">
      <table class="w3-table-all w3-centered">
        <tr>
          <th>学号</th>
          <th>姓名</th>
          <th>平时成绩</th>
          <th>期末成绩</th>
          <th>最终成绩</th>
        </tr>
        <?php
          function _post($str){
            $var = !empty($_POST[$str]) ? $_POST[$str] : null;
            return $var;
          }
          echo '<input id="class" type="hidden" value="'._post('class').'">';
          echo '<input id="cid" type="hidden" value="'._post('cid').'">';
          $sql = "select sid,sname from student where sid like '____"._post('class')."%'";
          $result = mysqli_query($con,$sql);
          while ($array=mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>",$array['sid'],"</td>";
            echo "<td>",$array['sname'],"</td>";
            echo '<td><input class="w3-input w3-round" type="number" name="" id=""></td>';
            echo '<td><input class="w3-input w3-round" type="number" name="" id=""></td>';
            echo '<td><input class="w3-input w3-round" type="number" name="" id=""></td>';
            echo "</tr>";
          }
        ?>
      </table>

      <div class="w3-margin" style="height:100px;">
        <button id="submit_grade" class="w3-button w3-blue w3-hover-blue w3-round w3-hover-shadow w3-right">提交</button>
      </div>

    </div>

    <div id="promptInfoModal" class="w3-modal">
      <div class="w3-modal-content w3-animate-bottom w3-card-4 w3-round w3-display-container" style="width: 360px;height: 200px;">
        <div class="w3-display-middle w3-center">
          <h5>确认要锁定分数吗？</h5>
        </div>
        <div class="w3-container w3-display-bottommiddle w3-margin-bottom" style="width: 220px">
          <button id="promptInfo_cancel" class="w3-button w3-blue w3-hover-blue w3-round w3-hover-shadow w3-left">取消</button>
          <button id="promptInfo_ok" class="w3-button w3-blue w3-hover-blue w3-round w3-hover-shadow w3-right">确定</button>
        </div>
      </div>
    </div>

    <div id="waitingModal" class="w3-modal">
      <div class="w3-modal-content w3-animate-bottom w3-card-4 w3-round w3-display-container" style="width: 360px;height: 200px;">
        <div class="w3-display-middle w3-center">
          <img class="w3-spin" src="./../images/gear.png" alt="上传中......">
          <h3>上传中······</h3>
        </div>
      </div>
    </div>

    <div id="resultModal" class="w3-modal">
      <div class="w3-modal-content w3-animate-bottom w3-card-4 w3-round w3-display-container" style="width: 360px;height: 200px;">
        <div class="w3-display-middle w3-center">
          <h3 id="resultInfo">上传成功！</h3>
        </div>
      </div>
    </div>

    <!-- End page content -->
  </div>

  <script>
    // Get the Sidebar
    var mySidebar = document.getElementById("mySidebar");

    // Get the DIV with overlay effect
    var overlayBg = document.getElementById("myOverlay");

    // Toggle between showing and hiding the sidebar, and add overlay effect
    function w3_open() {
      if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
      } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
      }
    }

    // Close the sidebar with the close button
    function w3_close() {
      mySidebar.style.display = "none";
      overlayBg.style.display = "none";
    }

    $(document).ready(function () {
      $("#homePage").click(function (e) { 
        e.preventDefault();
        $(location).attr("href","./welcome_admin.php");
      });
    });
  </script>

</body>
<?php
    mysqli_close($con);
?>
</html>