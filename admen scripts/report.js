$(document).ready(function(){
     $(".title").keyup(function (e) { 
            $(".pdf_div h1").text($(this).val())
        });
        $("textarea").keyup(function (e) { 
            $(".pdf_div p").text($(this).val())

        });
        $(".cls").on("click",function(){
            $(".title").val("")
            $("textarea").val("")
            $(".pdf_div h1").text("Title")
            $(".pdf_div p").text("Content....")
        })
    $(".down").on("click",function(){ 
        if($(".title").val() == "" || $("textarea").val() == ""){
            $(".errors").text("you have to fill both fields").css("color","red")
            return
        }
        let div = $(".pdf_div")
         html2pdf().from(div[0]).save();
        $(".errors").text("")

    
    })
})