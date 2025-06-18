$(document).ready(function () {
    console.log("hello")
    $(".error").hide()
    $(".btn").on("click", function (e) {
        e.preventDefault();
        console.log("we clicked")
        let values = [
            $("#name").val().trim(),
            $("#persone").val().trim(),
            $("#email").val().trim(),
            $("#phone").val().trim(),
            $("#blood_type").val(),
            $("#units").val().trim(),
            $("#date").val().trim(),
            $("#level").val().trim(),
            $("#message").val().trim(),
            $("#center").val(),
            $("#name_of_person").val().trim()

        ];

        let allFilled = values.every(val => val !== "");

        if (!allFilled) {
            $(".error").text("All fields are required").css({
                color:"red",
                display:"block"
            })
            return;
        }
            $(".error").hide()
        // If all fields are filled, prepare data for AJAX
        let postData = {
            hospital_name: values[0],
            person_name: values[1],
            email: values[2],
            phone: values[3],
            blood_type: values[4],
            units: values[5],
            date: values[6],
            level: values[7],
            message: values[8],
            center: values[9],
            in_need_name: values[10]
        };
        $.ajax({
            url:"/pfe/hospital_page/index.php",
            method: "POST",
            data: postData,
            success: function (response) {
                console.log("we enter success");
                let data = JSON.parse(response);
                console.log(data)
                if(data.status == "done"){
                    console.log("we are in done")
                    $(".error").text(data.message).css({
                        color:"green",
                        display:"block"
                    })
                }else if(data.status == "error"){
                    console.log("we are in error")
                    $(".error").text(data.message).css({
                        color:"red",
                        display:"block"
                    })
                }
                console.log("Server response:", response);
            },
            error: function () {
                alert("Something went wrong.");
            }
        });
    });
});
