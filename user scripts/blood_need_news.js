$(document).ready(function () {

    function toggleTabs(activeBtn, inactiveBtn, showSection, hideSection) {
        $(activeBtn).css("border-bottom", "3px solid #ec4899");
        $(inactiveBtn).css("border-bottom", "3px solid transparent");
        $(showSection).css("display", "flex");
        $(hideSection).css("display", "none");
    }

    $(".btn1").on("click", function () {
        toggleTabs(".btn1", ".btn2", ".events_and_news", ".events_and_news1");
    });
    $(".btn2").on("click", function () {
        toggleTabs(".btn2", ".btn1", ".events_and_news1", ".events_and_news");
    });
    $(".donait").on("click", function () {
        const center_id = $(this).val();
        $.post("/pfe/user pages/blood_need_news.php", { id: center_id }, function (response) {
            if (response === "done") {
                window.location.href = "/pfe/user pages/request.php";
            }
        });
    });
});
