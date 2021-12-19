var processId = "";

/* process id alanı dolduruluyor - işlem yapılan kayıt */
$(document).on("click", ".add", function() {
    processId = "";
});

$(document).on("click", ".edit", function() {
    processId = $(this).closest("tr").attr("id");
    $("#id_u").val(processId);
});

$(document).on("click", ".delete", function() {
    processId = $(this).closest("tr").attr("id");
});

/* ajax post methodları */
$(document).on("click", "#add", function() {
    var data = $("#add-form").serialize();


    $.ajax({
        url: "backend/dbappointment.php",
        type: "POST",
        cache: false,
        data: data,
        success: function(dataResult) {
            $('#record-add').modal('hide');
            location.reload();

        }
    });
});

$(document).on("click", "#edit", function() {
    var data = $("#update-form").serialize();

    $.ajax({
        url: "backend/dbappointment.php",
        type: "POST",
        cache: false,
        data: data,
        success: function(dataResult) {
            $('#record-edit').modal('hide');
            location.reload();

        }
    });
});

$(document).on("click", "#delete", function() {
    var data = { type: 3, id: processId };

    $.ajax({
        url: "backend/dbappointment.php",
        type: "POST",
        cache: false,
        data: data,
        success: function(dataResult) {
            $('#confirm-delete').modal('hide');
            $("#" + dataResult).remove();

        }
    });
});