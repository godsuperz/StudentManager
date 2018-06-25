$(document).ready(function () {
    $("#goback").click(function (e) {
        e.preventDefault();
        $(location).attr("href", "./grade_teacher.php");
    });
    $("#submit_grade").click(function (e) {
        e.preventDefault();
        $("#promptInfoModal").show();
    });
    $("#promptInfo_cancel").click(function (e) {
        e.preventDefault();
        $("#promptInfoModal").hide();
    });
    $("#resultModal").click(function (e) {
        e.preventDefault();
        $("#resultModal").hide();
        var banji = $("#class").val();
        var cid = $("#cid").val();
        $.post("./../controller/contrl_grade_lock.php", {
                "class": banji,
                "cid": cid
            },
            function (data, textStatus) {
                if(textStatus=="success"){
                    if(data=="success"){
                        $("#goback").trigger("click");
                    }
                }
            }
        );
    });
    $("#promptInfo_ok").click(function (e) {
        e.preventDefault();
        $("#promptInfoModal").hide();
        $("#waitingModal").show();
        var cid = $("#cid").val();
        var flag = 0;
        $("tr").each(function (i, tr) {
            var sno = "";
            var sname = "";
            var peacetime = "";
            var terminal = "";
            var overall = "";
            // element == this
            if (i == 0) {
                $(tr).children().each(function () {
                    // element == this
                });
            } else {
                $(tr).children().each(function (j, td) {
                    // element == this
                    switch (j) {
                        case 0:
                            sno = $(td).text();
                            break;

                        case 1:
                            sname = $(td).text();
                            break;

                        case 2:
                            peacetime = $(td).children().val();
                            break;

                        case 3:
                            terminal = $(td).children().val();
                            break;

                        case 4:
                            overall = $(td).children().val();
                            break;

                        default:
                            break;
                    }
                });
                $.post("./../controller/contrl_grade_add.php", {
                        "cid": cid,
                        "sno": sno,
                        "sname": sname,
                        "peacetime": peacetime,
                        "terminal": terminal,
                        "overall": overall
                    },
                    function (data, textStatus) {
                        if (textStatus == "success") {
                            if (data == "success") {
                                flag++;
                                if (flag == $("tr").length - 1) {
                                    $("#waitingModal").hide();
                                    $("#resultModal").show();
                                }
                            }
                        }
                    }
                );
            }
        });
    });
});