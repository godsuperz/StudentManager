<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>验证账号密码后台程序</title>  
<meta charset="utf-8">  
    <?php  
        function get_str($str){  
            $val = ($_POST[$str])?$_POST[$str]:null;  
            return $val;  
        }  
        $user = get_str("username");  
        $pass = get_str("password");  
        if($user==null or $pass == null){?>  
            <script type="text/javascript">  
                alert("用户名或密码为空，请重新输入");  
                window.location.href="login.html";  
            </script>  
            <?php  
        }  
        $con = mysql_connect("localhost","root","root") or die("数据库链接失败");  
        if(!$con){  
    ?>  
    <script type = "text/javascript">  
        alert("连接服务器失败");  
        window.location.href = "login.html";  
    </script>  
    <?php  
        }  
        $sel = mysql_select_db("SGMSystem",$con) or die("数据库选择失败");  
        if(!$sel){  
    ?>  
    <script type = "text/javascript">  
        alert("选择数据库失败");  
        window.location.href = "login.html";  
    </script>  
    <?php  
        }  
        $sql = "select * from user_info where username = '$user'";  
        //echo $sql."<br>";  
        $info = mysql_query($sql,$con);  
        echo $info;  
        $num = mysql_num_rows($info);  
        if($num == null){  
            //没有查找到,表示要注册  
            $ins = "insert into user_info (username,password,is_manager) values('$user','$pass',0)";  
            $info1 = mysql_query($ins,$con);  
                //注册成功，返回登陆界面重新登录  
                ?>  
                <script type="text/javascript">  
                    alert("注册成功，返回登陆界面重新登录");  
                    window.location.href="login.html";  
                </script>  
                <?php  
        }     
        else{  
            //登录成功  
            $row = mysql_fetch_array($info);  
            //echo $row['password'];  
            }  
            if($row['password']==$pass){  
                if($row['is_manager'] == 1){  
                    //是管理员  
    ?>  
    <script type = "text/javascript">  
        alert("管理员登录成功");  
        window.location.href = "welcome_mag.html";  
    </script>  
    <?php }?>  
     <?php  
     if($row['is_manager'] != 1){  
         //普通用户登录  
        //直接进入查询界面（学生端的查询界面不提供返回服务选择界面的接口）  
    ?>  
     <script type = "text/javascript">  
        alert("普通用户登录成功");  
        window.location.href = "select_stu.html";  
    </script>  
    <?php }  
        }  
        else{  
    ?>  
    <script type = "text/javascript">  
        alert("密码错误");  
        window.loaction.href = "login.html";  
    </script>  
    <?php  
        }  
        mysql_close($con);  
    ?>  