<!DOCTYPE html>
<?php session_start();?>
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
    <span id = "homePage" class="w3-bar-item w3-right w3-btn w3-text-white w3-wide"><i><strong>SUPERXZ</strong></i></span>
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
          <strong>
            <?php
              if(isset($_SESSION['sname']) && isset($_SESSION['sno'])){
                echo $_SESSION['sname'].'('.$_SESSION['sno'].')'; 
              } else {
                header("location:./login_student.html"); 
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
      <a href="./developing.php" class="w3-bar-item w3-button w3-padding">
        <i class="fa fa-users fa-fw"></i>  补考重修报名</a>
      <a href="./developing.php" class="w3-bar-item w3-button w3-padding">
        <i class="fa fa-eye fa-fw"></i>  学籍信息</a>
      <a href="./developing.php" class="w3-bar-item w3-button w3-padding">
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
        <i class="fa fa-cog fa-fw"></i>  毕业论文</a>
      <br>
      <br>
    </div>
  </nav>


  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu"
    id="myOverlay"></div>

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:300px;margin-top:43px;">
      <div class="w3-panel w3-center">
            <div class="w3-image w3-margin-top" style="padding-top: 100px">
                <img class="w3-spin" src="./../images/gear.png" alt="gear"/>
            </div>
            <h1>系统模块正在开发中......</h1>
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
        $(location).attr("href","./welcome.php");
      });
    });
  </script>

</body>

</html>