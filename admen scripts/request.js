$(document).ready(function(){
    let request_id;
    let user_email; 
    let user_full_name;
    let blood_type;
    $(".new_status").on("change",function(){
        if($(this).val() == "canceled"){
        console.log($(this).val())
            $(".text").css("display","flex")
        }else{
            $(".text").css("display","none")
        }
    })
    $(".type_of_donation").on("change",function(){
        if($(this).val() == "normal"){
            $(".normal_request").css("display","table")
            $(".event_reuqest").css("display","none")
        }else{
            $(".normal_request").css("display","none")
            $(".event_reuqest").css("display","table")
        }
    })
    function filter(){
        let search_value = $(".event_search").val()
        let type_status = $(".type_status").val()
        console.log(search_value)
        console.log(type_status)

        $(".ho").each(function(){
            let data_title = $(this).data("name")
            let data_status = $(this).data("status")
            console.log(data_title)
            console.log(data_status)
            let match_title = !search_value || data_title.toLowerCase().includes(search_value.toLowerCase())
            let match_status = !type_status || data_status.toLowerCase().includes(type_status.toLowerCase())

            if(match_status && match_title){
                $(this).css("display","table-row");
            }else{
                $(this).css("display","none");
            }
        })
    }
    $(".event_search, .type_status").on("change input",filter)
    

    // change request status code start here
    $(".change").each(function(){
        $(this).on("click",function(){
            request_id = $(this).data("id")
            user_email = $(this).data("email")
            user_full_name = $(this).data("name")
            blood_type = $(this).data("blood_type")
            $("#add")[0].showModal()
        })
    })
    
        $(".close").on("click",function(){
            $("#add")[0].close()
        })
    $("#change_status").on("click",function(){
        let status_value = $(".new_status").val().trim()
        if(status_value == ""){
            $(".error1").text("please enter a valid status").css("color","red");
            return
        }
        if(status_value == "canceled"){
            let resone_value = $("#resone").val().trim()
            if(resone_value == ""){
            $(".error1").text("you have to gave a resone for the cancellation").css("color","red");
            return
            }
            $.post("", {action:"send_as_will", request_id:request_id, user_email:user_email, resone:resone_value, new_statu:status_value, user_name:user_full_name},
                function (data, textStatus, jqXHR) {
                    let new_data = JSON.parse(data)
                    if(new_data.status == "ok"){
                        $(".error1").text(new_data.message).css("color","green");
                        setTimeout(() => {
                            window.location.reload()
                        }, 1000);
                    }else{
                        $(".error1").text(new_data.message).css("color","red");
                    }
                }
            );
        }else{
             $.post("", {action:"change",request_id:request_id,new_statu:status_value,blood_type_id:blood_type},
                function (data, textStatus, jqXHR) {
                    console.log(data)
                     let new_data = JSON.parse(data)
                    if(new_data.status == "ok"){
                        $(".error1").text(new_data.message).css("color","green");
                        setTimeout(() => {
                            window.location.reload()
                        }, 1000);
                    }else{
                        $(".error1").text("Error acured").css("color","red");
                    }
                }
            );
        }
        
    })
})