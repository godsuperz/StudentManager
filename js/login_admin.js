$(document).ready(function () {
    $("button").click(function (e) {
        e.preventDefault();

        var id = $.trim($("input[name='tid']").val());
        var password = $.trim($("input[name='tpassword']").val());
        if (id != null && id != "") {
            $.post("./../controller/contrl_login_admin.php", {
                    tid: id,
                    tpassword: password
                },
                function (data, textStatus) {
                    if (textStatus == "success") {
                        switch ($.trim(data)) {
                            case "not_exist":
                                $("#promptInfo").html("该账号不存在");
                                break;
                            case "error_password":
                                $("#promptInfo").html("密码错误！");
                                break;
                            case "success_login":
                                $("#loginAdmin").attr("action", "./welcome_admin.php");
                                $("#loginAdmin").submit();
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