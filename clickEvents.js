$('#bulk_edit').on('click', function() {
    $("#navbar").find("li .active").attr("class","nav-link");
    $(this).attr("class","nav-link active");
    $('#bulkbtnTrigger').click();

});

$("#load").on('click', function() {
    $("#navbar").find("li .active").attr("class","nav-link");
    $(this).attr("class","nav-link active");
    $.ajax({
        url: 'load.php',
        method: 'Post',
        success: function(msg) {
            alert("Successfully loaded");
            $("#view").click();
        }
    })
});

$("#view").on('click', function() {
    $("#navbar").find("li .active").attr("class","nav-link");
    $(this).attr("class","nav-link active");
    $.ajax({
        url: 'view.php',
        method: 'Post',
        success: function(msg) {
            $(".table_body").empty();
            $(".table_body").append(msg);
        }
    })
    $(".table").css("visibility", "visible");

});
$("#edit").on('click', function() {
    $("#navbar").find("li .active").attr("class","nav-link");
    $(this).attr("class","nav-link active");
    alert("Click on a table row to edit!");
    $.ajax({
        url: 'edit.php',
        method: 'Post',
        success: function(msg) {
            $(".table_body").empty();
            $(".table_body").append(msg);
        }

    })
});
