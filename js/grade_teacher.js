$(document).ready(function () {
    $("li.unlock").click(function (e) { 
        e.preventDefault();
        $(this).children("form").submit();
    });
});