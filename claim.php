<?php
function get($result) {
    $hasil = explode('<div class="alert alert-success">', $result);
    $hasil = explode(' was sent to ', $hasil[1]);
    return $hasil[0];
}
function claim($link) {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $link);
    curl_setopt($c, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:56.0) Gecko/20100101 Firefox/56.0');
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($c);
    return $result;
}
echo "\e[93mAUTOCLAIM (autoclaim.win) Auto Claim
\e[36m===========\e[91m>>>>>>>>>>\n\e[36mAuthor : Azis Fikri
\e[36m===========\e[91m>>>>>>>>>>";
echo "\n\e[36mURL / LINK : ";
$link = trim(fgets(STDIN, 1024));
while (true) {
    $result = claim($link);
    $time = explode('<p>Time until next payout: ', $result);
    $time = explode(' seconds.</p>', $time[1]);
    echo "\e[36mTime : ".$time[0]."\n";
    if ($time[0] == 1) {
        sleep(1);
        echo "You get : ".get(claim($link))."\n\n";
    }
}
?>
