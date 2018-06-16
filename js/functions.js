$(document).ready(function() {
    var search_opts = {
        callback: function(value) {
            searchy(value);
        },
        wait: 500,
        highlight: true,
        allowSubmit: false,
        captureLength: 2
    }
    $("#search-anime").typeWatch(search_opts);
    $("#search-anime").on('input', function() {
        var searchTerm = $(this).val();
        if (searchTerm.length > 1) {
            $('.Search').addClass('On');
            $(".ListResult").html('<li class="Loading"><img src="/assets/images/preloader_white.gif" alt="Loading" /> Buscando...</li>');
        } else
            $('.Search').removeClass('On');
    });

    function searchy(value) {
        if (value.length < 2)
            return;
        $.post('https://animeflv.net/api/animes/search', {
            value: value
        }, function(data) {
            $('.Search').addClass('On');
            $(".ListResult").empty();
            var data_len = data.length;
            if (data_len) {
                for (var i = 0; i < data_len; i++) {
                    // console.log(data[i]);
                    if (i >= 5) {
                        $(".ListResult").append('<li class="MasResultados"><a href="/search?q=' + encodeURI(value) + '">Más Resultados</a></li>');
                        return false;
                    }
                    var ttext = "ANIME";
                    if (data[i].type == "movie")
                        ttext = "PELICULA";
                    else if (data[i].type == "ova")
                        ttext = "OVA";
                    $(".ListResult").append('<li><figure><a href="interna.php?url=/anime/' + data[i].last_id + '/' + data[i].slug + '"><img src="https://animeflv.net/uploads/animes/covers/80x80/' + data[i].id + '.jpg" alt=""></a></figure> <a href="interna.php?url=/anime/' + data[i].last_id + '/' + data[i].slug + '"><span class="title">' + data[i].title + '</span></a> <span class="Type ' + data[i].type + '">' + ttext + '</span> </li>');
                }
            } else {
                $(".ListResult").append('<li class="Loading">No se encontraron resultados</li>');
            }
        }, "json");
    }
    $('.Search').click(function(e) {
        e.stopPropagation();
    });
    $(document).click(function() {
        $('.Search').removeClass('On');
    });
    
});