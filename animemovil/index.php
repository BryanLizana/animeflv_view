<?php 

require_once('../acore/class.anime.php');

$html = classAnime::get_url_contents('https://animemovil.com/mob-psycho-100-s2-4-sub-espanol/');

$html = str_replace('"/','https://animemovil.com/',$html);


$json = classAnime::getTag($html,'episodio_info={','};',"",'pedazo');

$data_info = json_decode("{".$json."}",true);

// echo '<pre>'; var_dump( $data_info ); echo '</pre>'; die;/***HERE***/ 

$item = "cloud";
$url_info_server = $data_info['stream']['accessPoint'].$data_info['id']."/".$item."?expire=".$data_info['stream']['expire']."&callback=".$data_info['stream']['callback']."&signature=".$data_info['stream']['signature'].'&last_modify='.$data_info['stream']['last_modify'];
echo $url_info_server;

$data_info_server = file_get_contents("http:".$url_info_server);
$data_info_server = json_decode($data_info_server,true);


if ($item == 'nora') {
  
    $url_iframe = $data_info_server['result']['src'];
    echo '<iframe src="'.$url_iframe.'" frameborder="0"></iframe>';

    echo '<a href="'.$url_iframe.'">LINK</a>';
}else if($item == 'cloud'){

}


// echo '<pre>'; var_dump( $data ); echo '</pre>'; die;/***HERE***/ 

// echo '<pre>'; var_dump( $data_info_server ); echo '</pre>'; die;/***HERE***/ 
// href="'+episodio_info.stream.accessPoint+episodio_info.id+'/'+item+'?expire='+episodio_info.stream.expire+'&callback='+episodio_info.stream.callback+'&signature='+episodio_info.stream.signature+'&last_modify='+episodio_info.stream.last_modify+'" title="'+item+'" target="_blank" rel="noreferrer">'+item+'</a></li>';})}
        
//         episodio_info={
//             "id": 169045,
//             "imgCustom": 1,
//             "advertising": null,
//             "autoplay": true,
//             "static_media": "media.animemovil.com",
//             "stream": {
//                 "accessPoint": "\/\/stream-s1.animemovil.com\/",
//                 "callback": "playerWeb",
//                 "servers": [
//                     "nora",
//                     "cloud",
//                     "achede",
//                     "vizard",
//                     "copy",
//                     "minh",
//                     "fire",
//                     "meph",
//                     "sync",
//                     "openload",
//                     "mango",
//                     "gosl",
//                     "kami"
//                 ],
//                 "expire": 1552571375,
//                 "last_modify": 1548654357,
//                 "signature": "yLfbrnNj6e3%2Bp1Odj%2F9DYTljGnk7oWz07u2DeKYN2%2Bo%3D"
//             }
//         };


        