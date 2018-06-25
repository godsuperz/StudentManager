$(document).ready(function () {
    $("button").click(function (e) {
        e.preventDefault();

        var id = $.trim($("input[name='id']").val());
        var password = $.trim($("input[name='password']").val());
        if (id != null && id != "") {
            $.post("./../controller/contrl_login.php", {
                    sno: id,
                    spassword: password
                },
                function (data, textStatus) {
                    if (textStatus == "success") {
                        switch ($.trim(data)) {
                            case "not_exist":
                                $("#promptInfo").html("该学号不存在，如确认无误请及时联系管理员！");
                                break;
                            case "error_password":
                                $("#promptInfo").html("密码错误！");
                                break;
                            case "success_login":
                                $("#loginStudent").attr("action", "./../view/welcome.php");
                                $("#loginStudent").submit();
                                break;
                            default:
                                $("#promptInfo").html("未知错误！" + data);
                                break;
                        }
                    }
                }
            );

        } else {
            $("#promptInfo").html("学号不能为空！");
        }
    });
});