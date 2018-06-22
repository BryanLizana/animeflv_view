<?php 
$list = array(
    'https://www.vernfonk.com/blog/announcing-make-us-laugh-winner/',
    'https://www.vernfonk.com/blog/auto-insurance-tips-new-year/',
    'https://www.vernfonk.com/blog/blogposr3/',
    'https://www.vernfonk.com/blog/blogposr5/',
    'https://www.vernfonk.com/blog/blogpost/',
    'https://www.vernfonk.com/blog/car-thefts-washington/',
    'https://www.vernfonk.com/blog/contest-started/',
    'https://www.vernfonk.com/blog/do-parking-tickets-affect-car-insurance-premiums/parking-ticket/',
    'https://www.vernfonk.com/blog/enter-vern-fonks-make-us-laugh-contest-chance-win-1000/',
    'https://www.vernfonk.com/blog/happy-fourth-july/',
    'https://www.vernfonk.com/blog/happy-halloween/',
    'https://www.vernfonk.com/blog/insurance-agency-kent-wa/',
    'https://www.vernfonk.com/blog/insurance-agency-puyallup-wa/',
    'https://www.vernfonk.com/blog/insurance-agency-shelton-wa/',
    'https://www.vernfonk.com/blog/insurance-agency-vancouver-wa/',
    'https://www.vernfonk.com/blog/insurance-agency-washington-oregon/',
    'https://www.vernfonk.com/blog/kirkland-insurance-agency/',
    'https://www.vernfonk.com/blog/last-week-to-submit-your-video/',
    'https://www.vernfonk.com/blog/love-is-in-the-air/',
    'https://www.vernfonk.com/blog/newest-vern-fonk-location/',
    'https://www.vernfonk.com/blog/new-year-auto-insurance-tips/',
    'https://www.vernfonk.com/blog/outerspace-coverage/',
    'https://www.vernfonk.com/blog/port-angeles-auto-insurance/',
    'https://www.vernfonk.com/blog/reasons-to-increase-your-homeowners-liability-insurance/father-and-daughter-swimming-underwater/',
    'https://www.vernfonk.com/blog/reasons-to-increase-your-homeowners-liability-insurance/trampoline/',
    'https://www.vernfonk.com/blog/reasons-to-increase-your-homeowners-liability-insurance/yellow-lab-lying-by-empty-food-dish/',
    'https://www.vernfonk.com/blog/seattle-car-insurance/',
    'https://www.vernfonk.com/blog/super-bowl-car-showdown/',
    'https://www.vernfonk.com/blog/vern-fonk-featured-on-web-soup/',
    'https://www.vernfonk.com/blog/vern-fonk-insurance-agency-bellingham/',
    'https://www.vernfonk.com/blog/vern-fonk-insurance-beavertontigard/',
    'https://www.vernfonk.com/blog/vern-fonk-youtube/',
    'https://www.vernfonk.com/blog/vote-favorite-video/',
    'https://www.vernfonk.com/blog/make-a-claim',
    'https://www.vernfonk.com/blog/insurance-products',
    'https://www.vernfonk.com/blog/yakima-car-insurance-98902-wa',
    'https://www.vernfonk.com/blog/yakima-car-insurance-98902-wa/'
);

?>
 <table border="1"> 
<?php
foreach ($list as $url) {
    $file_headers = @get_headers($url);
    echo "<tr><td>$url</td><td>$file_headers[0]</td></tr>";
}

  ?>
  </table> 