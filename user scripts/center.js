$(document).ready(function () {
    let id = "";
        $(".first_div").on("click",function(){
            $(".first_div").css("border","5px solid transparent");
            $(".first_div").find(".icon1").css("visibility","hidden")
            $(this).css("border","5px solid #ec4899")
            $(this).find(".icon1").css("visibility","visible")
            id = $(this).find("input[type='hidden']").val();
        })

        $(".send").on("click",function(e){
            e.preventDefault();
            if(id !== ""){
                console.log(id)
                $.ajax({
                type: "POST",
                url: "/pfe/user pages/select_center.php",
                data: {id:id},
                success: function (response) {
                    console.log(response)
                    if(response == "done"){
                        window.location.href = "/pfe/user pages/request.php";
                    }
                },
                error:function(one,two,three){
                    console.log(three)
                }
                
            });
            }
        })
});