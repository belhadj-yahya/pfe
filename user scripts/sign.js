$(document).ready(function(){
        let password_error = $(".password_error")
        let confirm_error = $(".confirm_error")
        let form_data;

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
            password_error.css("display","block");
            sheck = false;
        }
        if(confim_password.length < 8){
            confirm_error.css("display","block")
            sheck = false;
        }
        if(password === confim_password){
        }else{
            confirm_error.text("both passwords need to match").css("display","block")
            password_error.text("both passwords need to match").css("display","block");
            sheck = false;
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
                        $(something.class).text(something.message).css("display","block")
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