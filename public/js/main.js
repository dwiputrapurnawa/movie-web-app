$(function() {

    feather.replace();

    const date = new Date().getFullYear();

    $(".copyright-date").html("&copy; " + date + " Movie, Inc");

    $("#content").keypress(function(event) {
        if(event.keyCode === 13 && !event.shiftKey) {
            event.preventDefault();
            $("#commentForm").submit();
        }
    })
    
})