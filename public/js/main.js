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

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


    $(".btn-text").on("click", function() {
        var formId = "#commentForm-" + $(this).val();

        if($(formId).attr("hidden")) {
            $(formId).removeAttr("hidden");
        } else {
            $(formId).attr("hidden", true);
        }
    });

    
  
})