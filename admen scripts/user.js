$(document).ready(function(){
    let currentUserId = null;
    $(".add").on("click",function(){
        // console.log("we press add button")
        console.log($("#add"))
        $("#add")[0].showModal();
    })
    $(".close").on("click",function(){
        $("#add")[0].close()
        $("#edite")[0].close()
    })
    function filterUsers() {
        let name = $(".searsh_by_name").val().toLowerCase().trim();
        let type = $("select[name='type']").val().toLowerCase();

        $("tbody tr").each(function () {
            let userName = $(this).data("name").toLowerCase();
            let userType = $(this).data("type").toLowerCase();

            let matchesName = userName.includes(name);
            let matchesType = type === "" || userType === type;

            if (matchesName && matchesType) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
    $(".searsh_by_name").on("input", filterUsers);
    $("select[name='type']").on("change", filterUsers);

      $(".last_div button").on("click", function () {
        let fullName = $("#full_name").val().trim();
        let bloodType = $("select[name='add_type']").val();
        let phone = $("#phone").val().trim();
        let email = $("#em").val().trim();
        let password = $("#pass").val().trim();
        let confirmPassword = $("#con_pass").val().trim();
        let location = $("#loc").val().trim();
        let errorElement = $(".error1");

        errorElement.text("").hide();
        if (!fullName || !bloodType || !phone || !email || !password || !confirmPassword || !location) {
            errorElement.text("Please fill in all fields.").show();
            return;
        }

        if (password !== confirmPassword) {
            errorElement.text("Passwords do not match.").show();
            return;
        }

        if (password.length < 8) {
            errorElement.text("Password must be at least 8 characters long.").show();
            return;
        }
        if(phone.length != 10){
            errorElement.text("phone number must be 10 characters long.").show();
            return;
        }
        console.log("before we enter ajax")
        $.ajax({
            url: "", 
            method: "POST",
            data: {
                action: "add_user",
                full_name: fullName,
                type: bloodType,
                phone: phone,
                email: email,
                password: password,
                location: location
            },
            success: function (response) {
                console.log("at the start of success function in ajax")
                console.log(response)
                let data = JSON.parse(response)
                console.log(data)
                if (data.status == "done") {
                    console.log("in done")
                    $(".error1").text(data.message).css("color","lightgreen").show();
                    window.location.reload()
                } else if(data.status == "error") {
                    console.log("in error")
                    $(".error1").text(data.message).css("color","red").show();
                }
            }
        });
    });

    $(".adite").on("click", function () {
        console.log("we click edite")
    const row = $(this).closest("tr");

    currentUserId = row.find('input[name="user_id"]').val();

    $("#new_full_name").val(row.find(".name").text());
    $("#new_em").val(row.find(".email").text());
    $("#new_phone").val(row.find(".phone").text());
    $("#new_loc").val(row.find(".city").text());
    let bloodId = row.find(".blood_type").data("blood_type");
    $("#new_type").val(bloodId);

    $("#edite")[0].showModal();
});
$("#confirmEdit").on("click", function () {
    const name = $("#new_full_name").val().trim();
    const email = $("#new_em").val().trim();
    const phone = $("#new_phone").val().trim();
    const city = $("#new_loc").val().trim();
    const blood_type = $("#new_type").val().trim();
    let errorElement = $(".error2");
    console.log(name)
    console.log(email)
    console.log(phone)
    console.log(city)
    console.log(blood_type)
    console.log(currentUserId)

    // Check for empty values
    if (!name || !email || !phone || !city || !blood_type) {
        alert("Please fill in all fields.");
        return;
    }

    if(phone.length != 10){
        errorElement.text("phone number must be 10 characters long.").show();
        return;
    }
    $.ajax({
        url: "",
        method: "POST",
        data: {
            action: "update_user",
            user_id: currentUserId,
            name:name,
            email:email,
            phone:phone,
            city:city,
            blood_type:blood_type
        },
        success: function (response) {
            console.log(response)
            let data = JSON.parse(response);
            if(data.status == "error"){
                $(".error2").text(data.message).css("color","red");
            }else if(data.status == "done"){
                $(".error2").text(data.message).css("color","lightgreen");
                window.location.reload()
            }
        }
    });
});
$(document).on("click", ".delete-user-btn", function () {
    if (!confirm("Are you sure you want to delete this user?")) {
        return;
    }

    let row = $(this).closest("tr");
    let user_id = row.find('input[name="user_id"]').val();

    $.ajax({
        url: "",
        method: "POST",
        data: {
            action: "delete_user",
            user_id: user_id
        },
        success: function (response) {
            let data = JSON.parse(response);
            if (data.status === "done") {
                alert("User deleted successfully.");
                row.remove();
            } else {
                alert("Error: " + res.message);
            }
        },
        error: function () {
            alert("An unexpected error occurred.");
        }
    });
});


})
