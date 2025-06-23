$(document).ready(function(){
    //filtering part
    function filter(){
        let title = $(".event_search").val()
        let type = $(".type_for_event").val()
        console.log(title)
        console.log(type)
        $(".event_tr").each(function(){
            let data_title = $(this).data("event_title");
            let data_type = $(this).data("event_blood_type");
            let title_match = !title || data_title.toLowerCase().includes(title.toLowerCase());
            let type_match = !type || data_type.toLowerCase().includes(type.toLowerCase());
            if(title_match && type_match){
                $(this).css("display","table-row")
            }else{
                $(this).css("display","none")
            }
        })
    }
    $(".event_search, .type_for_event").on("change input",filter);
    $(".news_search").on("input",function(){
        let title = $(".news_search").val()
        console.log(title)
        $(".news_tr").each(function(){
            let data_title = $(this).data("news_title");
            let title_match = !title || data_title.toLowerCase().includes(title.toLowerCase());
            if(title_match){
                $(this).css("display","table-row")
            }else{
                $(this).css("display","none")
            }
        })
    })


    // travling part
    $(".add_news").on("click",() => {
        $("#add")[0].showModal()
    })
    $(".add_event").on("click",() => {
        $("#edite")[0].showModal()
    })
    $(".close").on("click",() => {
        $("#add")[0].close()
        $("#edite")[0].close()
    })
    $(".blood_need_switch").on("click",function(){
        $(this).css({
            backgroundColor:"black",
            color:"white"
        })
        $(".news_switch").css({
            backgroundColor:"white",
            color:"black",
            border: "1px solid rgba(0, 0, 0, 0.08)"
        })
        $(".after_main").css("display","block")
        $(".after_main2").css("display","none")
        filter()

    })
    $(".news_switch").on("click",function(){
        $(this).css({
            backgroundColor:"black",
            color:"white"
        })
        $(".blood_need_switch").css({
            backgroundColor:"white",
            color:"black",
            border: "1px solid rgba(0, 0, 0, 0.08)"
        })
        $(".after_main").css("display","none")
        $(".after_main2").css("display","block")
        filter()
    })

    function response(data,class_to,table_class,dailog_to_close){
        json_data = JSON.parse(data)
        if(json_data.status == "done"){
            console.log("done")
            $(class_to).text(json_data.message).css("color","green");
            $(table_class).html(json_data.data)
            setTimeout(() => {
                $(dailog_to_close)[0].close()                        
            }, 500);
        }else{
            $(class_to).text(json_data.message).css("color","red")
        }
    }
    //code for deleting events
    $("tbody").on("click", ".delete", function () {
        $("input").each(function(){
            $(this).val("")
        })
    let id = $(this).data("event_id");
    let class_to_change = $(this).data("table");
    console.log(id);
    $.post("", { action: "delete", id: id, table: class_to_change }, function (data) {
        console.log(data);
        let json_data = JSON.parse(data);
        console.log(json_data);
        if (json_data.status === "done") {
            $(class_to_change).html(json_data.data);
        }
    });
})




    // code for insurting and deleting 
    $("#confirmEdit").on("click",function(){
        let event_title = $(".event_title").val().trim();
        let event_des = $(".event_content").val().trim();
        let event_blood_type_in_need = $(".blood_type_in_need").val().trim()
        let event_date_of_need = $(".date_of_need").val().trim()
        let blood_units = $(".units").val().trim()
        let data_of_need = new Date(event_date_of_need)
        let data_of_now = new Date()
        

        if(event_blood_type_in_need == "" || event_title == "" || event_des == "" || event_date_of_need == ""){
            console.log(event_blood_type_in_need);
            console.log(event_title);
            console.log(event_des);
            console.log(event_date_of_need)
            $(".error2").text("All fileds are required").css("color","red")
            return;
        }
        if(data_of_need <= data_of_now){
            $(".error2").text("Enter a valid date please").css("color","red")
            return;
        }

        $.post("", {action:"events",event_title:event_title,event_content:event_des,event_blood_type:event_blood_type_in_need,event_date:event_date_of_need,units:blood_units},
            function (data) {
                response(data,".error2",".events_tbody","#edite");
                $("input").each(function(){
                    $(this).val("")
                })       
            },
        );
    })
    $("#add_news_button").on("click",function(){
        let news_title = $("#full_name").val().trim()
        let news_content = $("#news_content").val().trim()
        if(news_title == "" || news_content == ""){
            $(".error2").text("All fileds are required").css("color","red");
        }
        $.post("",{action:"news",news_title:news_title,news_content:news_content},
            function(data){
                response(data,".error1",".news_tbody","#add");
                $("input").each(function(){
                    $(this).val("")
                })
            },
        )
    })
})