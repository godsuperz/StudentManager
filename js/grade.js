$(document).ready(function () {
    // 当下拉框选项改变时
    $(".w3-select").change(function (e) {
        e.preventDefault();
        $.post("./../controller/contrl_grade.php", {
                school_year: $(this).val(),
                term: $(".w3-radio:checked").val()
            },
            function (data, textStatus) {
                if (textStatus == "success") {
                    if (data == "not_exist") {
                        $("#grade_table").empty();
                        $("#grade_table").append("<tr><th>学年学期</th><th>课程代码</th><th>课程名称</th><th>平时分数</th><th>期末成绩</th><th>总评成绩</th></tr>");
                    } else {
                        $("#grade_table").empty();
                        $("#grade_table").append("<tr><th>学年学期</th><th>课程代码</th><th>课程名称</th><th>平时分数</th><th>期末成绩</th><th>总评成绩</th></tr>");
                        $("#grade_table").append(data);
                    }
                } else {
                    alert(textStatus);
                }
            }
        );
    });
    // 当单选钮改变时
    $(".w3-radio").change(function (e) {
        e.preventDefault();
        if ($(":selected").val() != -1) {
            $.post("./../controller/contrl_grade.php", {
                    school_year: $(":selected").val(),
                    term: $(this).val()
                },
                function (data, textStatus) {
                    if (textStatus == "success") {
                        if (data == "not_exist") {
                            $("#grade_table").empty();
                            $("#grade_table").append("<tr><th>学年学期</th><th>课程代码</th><th>课程名称</th><th>平时分数</th><th>期末成绩</th><th>总评成绩</th></tr>");
                        } else {
                            $("#grade_table").empty();
                            $("#grade_table").append("<tr><th>学年学期</th><th>课程代码</th><th>课程名称</th><th>平时分数</th><th>期末成绩</th><th>总评成绩</th></tr>");
                            $("#grade_table").append(data);
                        }
                    } else {
                        alert(textStatus);
                    }
                }
            );
        } else {
            alert("请选择学年!");
        }
    });
});