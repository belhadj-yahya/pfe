$(document).ready(function () {
    $(".btn1").on("click",function(){
        $(this).css("border-bottom", "3px solid #ec4899")
        $(".btn2").css("border-bottom", "3px solid transparent")
        $(".btn3").css("border-bottom", "3px solid transparent")
        $(".div3_normal").css("display","flex")
        $(".div4_events").css("display","none")
        $(".div5_info").css("display","none")
    })
    $(".btn2").on("click",function(){
        $(this).css("border-bottom", "3px solid #ec4899")
        $(".btn1").css("border-bottom", "3px solid transparent")
        $(".btn3").css("border-bottom", "3px solid transparent")
        $(".div3_normal").css("display","none")
        $(".div4_events").css("display","flex")
        $(".div5_info").css("display","none")
    })
    $(".btn3").on("click",function(){
        $(this).css("border-bottom", "3px solid #ec4899")
        $(".btn1").css("border-bottom", "3px solid transparent")
        $(".btn2").css("border-bottom", "3px solid transparent")
        $(".div3_normal").css("display","none")
        $(".div4_events").css("display","none")
        $(".div5_info").css("display","flex")
    })
    $('.open').on('click', function (e) {
        e.preventDefault();
        $('.save, .cancel').show();
        $(this).hide()
        $('.second_after_form input').prop('disabled', false);
    });
    $('.cancel').on('click', function (e) {
        e.preventDefault();
        $('.save, .cancel').hide();
        $(".open").show()
        $('.second_after_form input').prop('disabled', true);
    });
    $(".signout").on("click",function(){
        console.log("we clicked sign out");
            $.ajax({
            method:"POST",
            url:"",
            data: {delete:"ok"},
            success:function(response){
                console.log(response)
                if(response == "ok"){
                    window.location.href = "../index.php";
                }

            }
        })
    })
    $('.save').on('click', function (e) {
        e.preventDefault()
        console.log("hello from save")
        let sheck = true;
        let first_name = $(".new_f_name").val().trim();
        let last_name = $(".new_l_name").val().trim();
        let email = $(".new_email").val().trim();
        let phone = $(".new_phone").val().trim();
        let city = $(".new_city").val().trim();
        let street = $(".new_street").val().trim();
        // console.log(first_name)
        //     console.log(last_name)
        //     console.log(email)
        //     console.log(phone)
        //     console.log(city)
        //     console.log(street)
        if(!first_name || !last_name || !email || !phone || !city || !street){
            sheck = false;
            $(".error").text("all fields are requred!").css({
                display:"block",
                color: "#9e2830"
            })
        }
        if(!/^\+?\d{10,13}$/.test(phone)){
            sheck = false;
            $(".error").text("phone number not valid!").css({
                display:"block",
                color: "#9e2830"
            })
        }
        
        if(sheck){
            $.ajax({
                type: "POST",
                url: "",
                data: {f_name:first_name,l_name:last_name,new_email:email,new_phone:phone,new_city:city,new_street:street},
                success: function (response) {
                    console.log(response)
                    let response_data = JSON.parse(response);
                    if(response_data.status == "done"){
                        $(".error").text(response_data.message).css({
                            display:"block",
                            color:"lightgreen"
                        })
                        setTimeout(() => {
                            window.location.href = "/pfe/user pages/account.php";
                        }, 1200);
                    }else{
                        $(".error").text(response_data.message).css({
                            color:"red",
                            display:"block"
                        })
                    }
                }
            });
        }
    });
});