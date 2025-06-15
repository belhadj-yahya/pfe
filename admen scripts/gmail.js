$(document).ready(function(){
    function filter(){
        $(".errors").text();
        let name = $("#searsh_by_name").val()
        let type = $("#type").val()
        $("input[type='checkbox']").each(function(){

            let box_name = $(this).data("name");
            let box_type = $(this).data("type");
            let match_type = !type || box_type == type;
            let match_name = !name || box_name.includes(name);

            if(match_name && match_type){
                $(this).parent().css("display","flex");
            }else{
                $(this).parent().css("display","none");
            }
        })
    }
    $(".cls").on("click",function(){
        $(".subject_text").val("")
        $("textarea").val("")
    })

    $("select, #searsh_by_name").on("change input",filter);
    let span = $("span");
    let num_user = 0;
    let users_to_send = []
    let check = true;
    $("input[type='checkbox']").each(function(){
        $(this).on("change",function(){
            if($(this).is(":checked")){
                if(users_to_send.length == 0){
                    users_to_send.push([$(this).data("name"),$(this).data("email")])
                    check = false;
                }else{
                    check = true;
                    users_to_send.forEach(user => {
                        if(user[0] == $(this).data("name") && user[1] == $(this).data("email")){
                            check = false
                        }
                    })
                }
                if(check == true){
                    users_to_send.push([$(this).data("name"),$(this).data("email")])
                }
                span.text(++num_user)
            }else{
                users_to_send.forEach((user,index) => {
                    if(user[0] == $(this).data("name") && user[1] == $(this).data("email")){
                        users_to_send.splice(index,1)
                    }
                })
                span.text(--num_user)
            }
        })
    })
    $(".send").on("click",function(){
        if($(".subject_text").val().trim() == "" || $("textarea").val().trim() == ""){
            $(".errors").text("you have to fill both fields").css("color","red");
        }else if(users_to_send.length == 0){
            $(".errors").text("no user(s) was selected").css("color","red");
        }else{
            $(".errors").text("Please wait a second").css("color","green");
            $.post("", {data:users_to_send,subject:$(".subject_text").val(),content:$("textarea").val()},
                    function (data) {
                        let json_data = JSON.parse(data);
                        if(json_data.status == "ok"){
                            $(".errors").text(json_data.message).css("color","green");
                        }else{
                            $(".errors").text(json_data.message).css("color","red");
                        }
                    },
            );
        }
    })
})