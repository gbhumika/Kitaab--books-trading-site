$('form').keydown(function() {
    var condition = $("#searchCondition").val();
    var key = e.which;
    if (key == 13) {
        if (condition == "") {
            return;
        } else {
            $('form').submit();
            alert("hasdfhasdfh");
        }
        return false;
    }
});
