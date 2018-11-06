$('#images').on('change', function () {
    var total_file = document.getElementById('images').files.length;
    for (var i = 0; i < total_file; i++) {
        $('#image_preview').append("<div class='col-md-3'><img width='100%' class='img-responsive' src='" + URL.createObjectURL(event.target.files[i]) + "'></div>");
    }
});
