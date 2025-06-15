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
            $("#center").val()
        ];

        let allFilled = values.every(val => val !== "");

        if (!allFilled) {
            $(".error").text("All fields are required").css("color","red").show()
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
        };
        $.ajax({
            url:"",
            method: "POST",
            data: postData,
            success: function (response) {
                console.log(response)
                let data = JSON.parse(response);
                if(data.status == "done"){
                    $(".error").text(data.message).css("color","green").show()
                }else{
                    $(".error").text(data.message).css("color","red").show()
                }
                console.log("Server response:", response);
            },
            error: function () {
                alert("Something went wrong.");
            }
        });
    });
});
