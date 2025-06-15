 $(window).on("resize",function(){
        if($(this).width() > 786){
            $(".side_bar").css("display","none");
            // $(".login").css("display","none")
        }else{
            //  $(".side_bar").css("display","none");
            // $(".login").css("display","block")
        }
    })
    $(".open_button").on("click",function(){
            $(".side_bar").css("display","flex");
    })
    $(".close_button").on("click",function(){
            $(".side_bar").css("display","none");
    })