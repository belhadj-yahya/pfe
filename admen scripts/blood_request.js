$(document).ready(function() {
    let id;
    let contact_name;
    let email;
    let dialog = $("#edite")[0];
        $(document).on("click", ".respond-btn", function() {
            $(".error").hide()
            let data = $(this).data();
            let first_part = data.contact.split("|")
            id = data.id;
            contact_name = first_part[0];
            email = first_part[2];
            let dialog = $("#edite")[0];
            $("#dialog-content").html(`
                <p><strong>Hospital:</strong> ${data.hospital}</p>
                <p><strong>Contact:</strong> ${first_part[0]}</p>
                <p><strong>Blood Type:</strong> ${data.type}</p>
                <p><strong>Units Needed:</strong> ${data.units}</p>
                <p><strong>Date Needed:</strong> ${data.date}</p>
                <p><strong>Urgency:</strong> <span>${data.status}</p>
                <p><strong>Description:</strong> ${data.desc}</p>
            `);
        dialog.showModal();
        });
        $("#cancel-dialog").click(function() {
            $("#edite")[0].close();
        });

        //filtring
        $(".searsh_hospital, .status, .request_status").on("input change",function(){
            let text_value = $(".searsh_hospital").val().toLowerCase();
            let status_value = $(".status").val();
            let request_status_value = $(".request_status").val();

            $("tbody tr").each(function(){
                let name = $(this).data("name");
                let status = $(this).data("status");
                let center_status = $(this).data("center_status");
                let mach_text = !text_value || name.toLowerCase().includes(text_value);
                let mach_status = !status_value || status_value == status;
                let mach_request_status = !request_status_value || request_status_value == center_status;

                if(mach_text && mach_status && mach_request_status){
                    $(this).css("display","table-row")
                }else{
                    $(this).css("display","none")
                }
            })
        })
        
        $(".send").on("click",function(e){
            e.preventDefault();
            $(".error").text("please wait a sec").css("color","green").show()
            let new_reuqest_status = $("#response_status").val();
            let message = $("#response_msg").val().trim();
            if(!new_reuqest_status || !message){
                $(".error").text("you have to fill both fields").css("color","red").show();
                return
            }
            $.post("", {status:new_reuqest_status,message:message,id:id,name:contact_name,email:email},
                function (data, textStatus, jqXHR) {
                    let json = JSON.parse(data)
                    if(json.status == "ok"){
                        $(".tbody").html(json.new_data);
                        dialog.close()
                    }else{
                        $(".error").text(json.message).css("color","red").show()
                    }
                },
            );
            
        })

});