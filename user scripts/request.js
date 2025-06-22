$(document).ready(function () {
    function getCurrentTime() {
    let now = new Date();
    let hours = String(now.getHours()).padStart(2, '0');
    let minutes = String(now.getMinutes()).padStart(2, '0');
    return `${hours}:${minutes}`;
}
    $.ajax({
        type: "POST",
        url: "/pfe/user pages/request.php",
        data : {data:"first_request"},
        success: function (response) {
            data = JSON.parse(response);
            let startDate = new Date();
            $("#datepicker").datepicker({
                beforeShowDay: function(date) {
                    if(data.end_date == ""){
                        return [date >= startDate];
                    }else{
                        let endDate = new Date(data.end_date);
                        return [date >= startDate && date <= endDate];
                    }
                }
            });
            
            
            
               
                $("#datepicker").on("change",function(){
                    console.log("date has change");
                    $.post("/pfe/user pages/request.php",{data:"date_change",new_date:$("#datepicker").val()},function(response){
                        console.log(response)
                        let data = JSON.parse(response)
                        let html = `<option value="">Select your preferred time</option>`;
                        console.log(data)
                        for(let i = 0;i < data.length - 1;i++){
                            if(data[i].total_requests >= data[3]){
                                html += `<option style='color:#f5bcbf' disabled value='${data[i].donation_time_stamp}'>${data[i].donation_time_stamp} -full</option>`
                            }else{
                                html += `<option  value='${data[i].donation_time_stamp}'>${data[i].donation_time_stamp} -avilibile</option>`
                            }
                        }
                        $(".time_stamp").html(html);
                    },)
                })
                $("input[type='submit']").on("click",function(e){
                    e.preventDefault();
                    console.log("hello from send")
                    if($("#datepicker").val() == ""){
                        $(".error").text("Please fill the date field").css({
                            display: "block",
                            color: "rgb(255, 136, 136)"
                        });
                    }else{
                    let sheck = true;
                    let select_value = $(".time_stamp").val();
                    let message;
                    let current_time = getCurrentTime();
                    if(select_value == ""){
                            sheck = false;
                            message = "you have to select a time stamp";
                    }
                    
                    if(sheck){
                        console.log("we are in sheck = true")
                        $.post("/pfe/user pages/request.php", {data:"ok",date:$("#datepicker").val(),time_stemp:select_value},
                            function (data) {
                                console.log('-------------------------------------')
                                console.log(data);
                                console.log('-------------------------------------')
                                console.log("all things are right we are befoe the data display");
                                let new_data = JSON.parse(data);
                                if(new_data.status == "done"){
                                    $(".error").text(new_data.message).css({
                                        display:"block",
                                        color:"lightgreen",
                                    });
                                    setTimeout(() => {
                                    window.location.href = "/pfe/index.php";
                                    }, 1000);
                                }else if(new_data.status == "error"){
                                    $(".error").text(new_data.message).css({
                                        color: "rgb(255, 136, 136)",
                                        display: "block"
                                    });
                                }
                            },
                        );
                    }else{
                        $(".error").text(message).css({
                            display:"block",
                            color: "rgb(255, 136, 136)"
                        });
                    }
                    }
                })
        }
    });
});