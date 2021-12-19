var processId = "";

/* process id alanı dolduruluyor - işlem yapılan kayıt */
$(document).on("click", ".add", function() {
    processId = "";
    trainerSelect(0, 1);
});

$(document).on("click", ".edit", function() {
    processId = $(this).closest("tr").attr("id");

    var branchId = $(this).closest("tr").find("[data-branch-id]").data("branch-id");
    var trainerId = $(this).closest("tr").find("[data-trainer-id]").data("trainer-id");
    var date = $(this).closest("tr").find("[data-date]").data("date");

    $("#record-edit [name='branch_id']").val(branchId);
    $("#record-edit [name='trainer_id']").val(trainerId);

    var m = new Date(date);
    var dateString =
        m.getUTCFullYear() + "-" +
        ("0" + (m.getUTCMonth() + 1)).slice(-2) + "-" +
        ("0" + m.getUTCDate()).slice(-2) + "T" +
        ("0" + m.getUTCHours()).slice(-2) + ":" +
        ("0" + m.getUTCMinutes()).slice(-2) + ":" +
        ("0" + m.getUTCSeconds()).slice(-2);
    $("#record-edit [name='date']").val(dateString);

    trainerSelect(branchId, 2);
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

/* branç select'inin değişme durumu */

$(document).on("change", "#record-add [name='branch_id']", function() {
    var selectedBranch = $("#record-add [name='branch_id'] option:selected").val();
    trainerSelect(selectedBranch, 1)
});

$(document).on("change", "#record-edit [name='branch_id']", function() {
    var selectedBranch = $("#record-edit [name='branch_id'] option:selected").val();
    trainerSelect(selectedBranch, 2)
});

function trainerSelect(branchid, type) {

    var elem;
    if (type == 1) { elem = $("#record-add"); } else if (type == 2) { elem = $("#record-edit"); }

    $(elem).find("[name='trainer_id']").val("0");
    $(elem).find("[name='trainer_id'] option[data-branch-id]").css("display", "none");
    $(elem).find("[name='trainer_id'] option[data-branch-id='" + branchid + "']").css("display", "block");

}