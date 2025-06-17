$(document).ready(function(){
        let password_error = $(".password_error")
        let confirm_error = $(".confirm_error")
        

        let array_of_errors = [$(".f_name_error"),$(".l_name_error"),$(".email_error"),$(".phone_error"),$(".city_error"),$(".street_error"),$(".select_error")];
    $(".create").on("click",function(e){
        let sheck = true;
          e.preventDefault()
          $(".error").hide()
        // all elements
        let f_name = $(".first_name").val().trim();
        let l_name = $(".last_name").val().trim();
        let email = $(".email").val();
        let password = $(".password").val();
        let confim_password = $(".confirm_password").val();
        let phone_number = $(".phone_number").val().trim();
        let city = $(".city").val().trim();
        let street = $(".street").val().trim();
        let select = $(".blood_type").val();
        let array_of_input = [f_name,l_name,email,phone_number,city,street,select];
        array_of_input.forEach((element,index) => {
            if(element == ""){
                array_of_errors[index].css("display","block");
                sheck = false;
            }else{
                array_of_errors[index].css("display","none");
            }
        })
        if(password.length < 8){
            password_error.fadeIn();
            sheck = false;
        }else{
            password_error.fadeOut();
        }
        if(confim_password.length < 8){
            confirm_error.fadeIn();
            sheck = false;
        }else{
            confirm_error.fadeOut();
        }
        console.log("we are here baby")
        if(phone_number.length < 10 || typeof Number(phone_number) != "number"){
            console.log("we are in if phone is not valid")
            console.log(phone_number.length)
            console.log(typeof Number(phone_number))
            $(".phone_error").text("phone number is not valid").fadeIn();
            sheck = false
        }else{
            $(".phone_error").fadeOut();
        }
        
        if(password != confim_password || confim_password == ""){
            confirm_error.text("both passwords need to match").fadeIn();
            password_error.text("both passwords need to match").fadeIn();
            sheck = false;
        }else{
            confirm_error.fadeOut();
            password_error.fadeOut();
        }
        
        if(sheck){
            let form_data = new FormData();
            form_data.append('f_name', f_name);
            form_data.append('l_name', l_name);
            form_data.append('email', email);
            form_data.append('password', password);
            form_data.append('phone_number', phone_number);
            form_data.append('city', city);
            form_data.append('street', street);
            form_data.append('blood_type_id', select);
            $.ajax({
                type: "POST",
                url: "/pfe/user pages/sign.php",
                data:form_data,
                contentType: false, 
                processData: false,
                success: function (response) {
                    let something = JSON.parse(response)
                    if(something.class != "done"){
                        $(something.class).text(something.message).fadeIn()
                    }else{
                        window.location.href = "../index.php"
                    }
                },
                error: function(one,two,error){
                    console.log(error)
                }
            });
        }
    })
})