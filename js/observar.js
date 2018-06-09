$(document).ready(function() {
    var doit;

    $("#start").click(function () {
        $("#message").text('Espere un momento por favor...');

        $.get('https://www.mediafire.com/file/ub4hgw68k1z7hp1/', function(data) {
            data = data.replace("https://download", "http://download");
            pag = data.split("http://download")[1];
            pag = pag.split("\"")[0];
            url = pag.split("'")[0];
            if(url == "")
                alert("No se pudo obtener");
            else {
                $('#videoLoading').remove();
                url = "https://download" + url;

                $('#player').html('<video id="my-player" class="video-js" width="'+ $(window).width() +'" height="'+ $(window).height() +'" controls autoplay><source src="'+url+'" type="video/mp4" /></video>');
                var player = videojs('my-player');

                window.onresize = function(){
                    clearTimeout(doit);
                    doit = setTimeout(resizeVideoJS, 100);
                };

            }
        }).fail(function() {
            $("#message").text('Ha ocurrido un error, el servidor no respondio correctamente');
        });
    });
    
    function resizeVideoJS(){
        $("#my-player").width($(window).width()).height($(window).height());
    }
});