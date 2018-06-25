$(document).ready(function () {
    $("button").click(function (e) {
        e.preventDefault();

        var id = $.trim($("input[name='tid']").val());
        var password = $.trim($("input[name='tpassword']").val());
        if (id != null && id != "") {
            $.post("./../controller/contrl_login_teacher.php", {
                    tid: id,
                    tpassword: password
                },
                function (data, textStatus) {
                    if (textStatus == "success") {
                        switch ($.trim(data)) {
                            case "not_exist":
                                $("#promptInfo").html("该工号不存在，如确认无误请及时联系管理员！");
                                break;
                            case "error_password":
                                $("#promptInfo").html("密码错误！");
                                break;
                            case "success_login":
                                $("#loginTeacher").attr("action", "./../view/welcome_teacher.php");
                                $("#loginTeacher").submit();
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