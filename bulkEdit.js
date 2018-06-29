$('#inputFromCategory').on("click", function() {
    var category = $(this).val();
    $("#inputChangeFrom").replaceWith('<select required class="form-control" id="inputChangeFrom" name="changeFrom"> </select>');

    $("#inputChangeFrom").children().remove();
    if (category == 'Title'){
        $("#inputChangeFrom").replaceWith('<input required type="text" class="form-control" id="inputChangeFrom" name="changeFrom">');
    }

    if (category == 'Topic') {
        $.get("getTopics.php", function(data) {
            data = $.parseJSON(data);
            var options = "";
            for (var i = 0; i < data.length; i++) {
                options += "<option>" + data[i].topic_name + "</option> \n";
            }
            $("#inputChangeFrom").append(options)
        });
    }

    if (category == 'Date') {
        $("#inputChangeFrom").replaceWith('<input required type="date" class="form-control" id="inputChangeFrom" name="changeFrom">');
    }

    if (category == 'Speaker') {
        $.get("getSpeakers.php", function(data) {
            data = $.parseJSON(data);
            var options = "";
            for (var i = 0; i < data.length; i++) {
                options += "<option>" + data[i].speaker_name + "</option> \n";
            }
            $("#inputChangeFrom").append(options)
        });

    }

    if (category == 'Building/Room') {
        var buildings;
        var rooms;
        $.get({
            url: "getBuildings.php",
            success: function(data){
                data = $.parseJSON(data);
                var optGroups = "";
                for (var i = 0; i < data.length; i++) {
                    var building = data[i].building_name;
                    optGroups += "<optgroup label='" + building + "'>" + "</optgroups> \n";
                }
                $("#inputChangeFrom").append(optGroups);
                return;
            }

        }).done(function(){
             $("#inputChangeFrom optgroup").each(function(){
                 var currlabel = ($(this));
                 $.get("getRooms.php", {building:currlabel.attr('label')}, function(data){
                     var rooms = $.parseJSON(data);
                     var options = "";
                     for (var i = 0; i < rooms.length; i++) {
                         options += "<option value= '"+currlabel.attr('label')+ "," + rooms[i].room_name + "'>" + rooms[i].room_name + "</option> \n";
                     }
                     currlabel.append(options);
                 });
             })


        });
    }
});

$('#inputToCategory').on("click", function() {
    var category = $(this).val();
    $("#inputChangeTo").replaceWith('<select required class="form-control" id="inputChangeTo" name="changeTo"> </select>');
    $("#inputChangeTo").children().remove();

    if (category == 'Title'){
        $("#inputChangeTo").replaceWith('<input required type="text" class="form-control" id="inputChangeTo" name="changeTo">');
    }

    if (category == 'Topic') {
        $.get("getTopics.php", function(data) {
            data = $.parseJSON(data);
            var options = "";
            for (var i = 0; i < data.length; i++) {
                options += "<option>" + data[i].topic_name + "</option> \n";
            }
            $("#inputChangeTo").append(options)
        });
    }

    if (category == 'Date') {
        $("#inputChangeTo").replaceWith('<input required type="date" class="form-control" id="inputChangeTo" name="changeTo">');

    }

    if (category == 'Speaker') {
        $.get("getSpeakers.php", function(data) {
            data = $.parseJSON(data);
            var options = "";
            for (var i = 0; i < data.length; i++) {
                options += "<option>" + data[i].speaker_name + "</option> \n";
            }
            $("#inputChangeTo").append(options)
        });

    }

    if (category == 'Building/Room') {
        var buildings;
        var rooms;
        $.get({
            url: "getBuildings.php",
            success: function(data){
                data = $.parseJSON(data);
                var optGroups = "";
                for (var i = 0; i < data.length; i++) {
                    var building = data[i].building_name;
                    optGroups += "<optgroup label='" + building + "'>" + "</optgroups> \n";
                }
                $("#inputChangeTo").append(optGroups);
                return;
            }

        }).done(function(){
             $("#inputChangeTo optgroup").each(function(){
                 var currlabel = ($(this));
                 $.get("getRooms.php", {building:currlabel.attr('label')}, function(data){
                     var rooms = $.parseJSON(data);
                     var options = "";
                     for (var i = 0; i < rooms.length; i++) {
                         options += "<option value= '"+currlabel.attr('label')+ "," + rooms[i].room_name + "'>" + rooms[i].room_name + "</option> \n";
                     }
                     currlabel.append(options);
                 });
             })


        });
    }
});
