$(document).ready(function(){
    $(".open").on("click",function(){
        $("aside").css({
            display:"flex",
            position:"absolute",
            top:"0",
        })
        $(".a").on("click",function(){
            $("aside").css("display","none")
        })
    })
     $(window).on("resize", function () {
    if (window.innerWidth > 700) {
        $("aside").css({
            display: "flex",
            position: "relative",
        });
    } else {
        $("aside").css({
            display: "none",
            position: "absolute",
        });
    }
});
})