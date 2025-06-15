$(document).ready(function(){
    let tempPassword;
    var user_id;
    $(".first_send").on("click",function(e){
        e.preventDefault();
        $(".errors1").text("Please wait a bit").css("color","lightgreen");
        function generateRandomPassword(length = 8) {
        const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let password = '';
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * chars.length);
            password += chars[randomIndex];
        }
        return password;
        }

        tempPassword = generateRandomPassword();
        console.log(tempPassword)
        let email = $(".send1").val().trim();
        if(email != ""){
            $.post("/pfe/user pages/password.php", {email:email,temp_password:tempPassword},
                function (response) {
                    let data = JSON.parse(response);
                    if(data.status == "ok"){
                        $(".first_form").css("display","none");
                        $(".second_form").css("display","flex");
                        user_id = data.user_id;
                    }
                    console.log(response)
                },
            );
        }else{
            console.log("email is empty")
        }
    })
    $(".second_send").on("click",function(e){
        e.preventDefault();
        let user_temp_password = $(".send2").val().trim();
        if(user_temp_password === tempPassword){
            $(".second_form").css("display","none");
            $(".last_form").css("display","flex");
        }else{
            $(".errors2").text("your password does not match the temporary password").css("color","rgb(255, 136, 136)");
        }
    })
    $(".last_send").on("click",function(e){
        e.preventDefault();
        let new_password = $(".send3").val();
        let confirm_new_password = $(".send4").val();
        if(new_password.length >= 8 || confirm_new_password.length >= 8){
            if(new_password === confirm_new_password){
                $.post("/pfe/user pages/password.php",{new_pass:new_password,confirm_pass:confirm_new_password,id:user_id},
                    function(response){
                        console.log(response)
                    }
                )
            }else{
                $(".errors3").text("passwords Do Not Match Each Other").css("color","rgb(255, 136, 136)");
            }
        }else{
            $(".errors3").text("password need to be over 8 characters").css("color","rgb(255, 136, 136)");
        } 
    })

})