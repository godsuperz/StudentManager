$(document).ready(function () {
    $(".unlock").click(function (e) { 
        e.preventDefault();
        $(this).children("form").submit();
    });
});