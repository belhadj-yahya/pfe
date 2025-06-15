$(document).ready(function () {
    function filter() {
        let selectedType = $(".type").val().toLowerCase();
        let selectedDate = $(".date").val();
        let selectedStatus = $(".status").val().toLowerCase();

        $("tbody tr").each(function () {
            let row = $(this);
            let rowType = row.data("blood_type").toLowerCase();
            let rowDate = row.data("date");
            let rowStatus = row.data("status").toLowerCase();

            let typeMatch = !selectedType || rowType.includes(selectedType);
            let dateMatch = !selectedDate || rowDate.includes(selectedDate);
            let statusMatch = !selectedStatus || rowStatus.includes(selectedStatus);

            if (typeMatch && dateMatch && statusMatch) {
                row.show();
            } else {
                row.hide();
            }
        });
    }
    $(".settings select").on("change", filter);

    // Use event delegation for double click
    $("tbody").on("dblclick", ".will_change", function () {
        $(this).hide();
        $(this).siblings("input.change_value, button.save_change_value, button.cancel_change").css("display", "block");
    });

    // Use event delegation for cancel button
    $("tbody").on("click", ".cancel_change", function () {
        $(this).hide();
        $(this).siblings("input.change_value, button.save_change_value").css("display", "none");
        $(this).siblings(".will_change").css("display", "block");
    });

    // Use event delegation for save button
    $("tbody").on("click", ".save_change_value", function () {
        let new_val = $(this).siblings(".change_value").val();
        let row_id = $(this).data("id");
        let max_units = $(this).data("max_unit");
        let min_units = $(this).data("min_units");
        if(new_val > max_units || new_val < min_units){
            $(this).siblings(".error").text("the value need to be between Maximum Amount and Minimum Amount").show();
        }else{
            $(this).siblings(".error").text("").hide();
            $.post("", {
                new_value: new_val,
                blood_supply_id: row_id,
            }, function (data) {
                console.log(data)
                $("tbody").html(data);
                filter()
            });
        }
    });
});
