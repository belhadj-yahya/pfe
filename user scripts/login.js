$(document).ready(function(){
    let remove_errors = [$(".error"),$(".error1"),$(".error2")];
    $(".sign").on("click",function(e){
        e.preventDefault();
         remove_errors.forEach((element) =>{
        element.text("");
    })
        console.log("we have clicked sign")
        let data = `email=${$(".email").val()}&password=${$(".password").val()}`;
        $.ajax({
            type: "POST",
            url: "login.php",
            data: data,
            success: function (response) {
            let errors = JSON.parse(response)
                if(errors.p_class == "go"){
                    window.location.href = "/pfe/index.php"
                }else if(errors.p_class == "its admin"){
                    window.location.href = "../admin pages/index.php"
                }else{
                    $(errors.p_class).text(errors.message);
                    for(let i = 0;i <= errors.on.length;i++){
                    $(errors.on[i]).val(errors.value)
                }}
                
            }
        });
        

    })
})