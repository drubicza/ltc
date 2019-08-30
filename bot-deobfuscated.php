<?php
$ijo    = "\e[1;32m";
$kuning = "\e[1;33m";
$merah  = "\e[1;31m";
$cyan   = "\e[1;36m";
$blue   = "\e[1;34m";
$cyanbg = "\e[0;30;46m";
$color  = "\e[0m";

system('clear');
set_time_limit(0);
date_default_timezone_set('Asia/Jakarta');
error_reporting(1);

function get_between($string, $start, $end)
{
    $string = " ".$string;
    $ini    = strpos($string,$start);

    if ($ini == 0) return "";

    $ini += strlen($start);
    $len  = strpos($string,$end,$ini) - $ini;

    return substr($string,$ini,$len);
}

function login($obid, $loginuth)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://photon-pong.firebaseio.com/CoinbaseUsers/'.$obid.'/.json?print=pretty&auth='.$loginuth.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "");
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers   = array();
    $headers[] = 'Accept: */*';
    $headers[] = 'Cache-Control: no-cache';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Host: photon-pong.firebaseio.com';
    $headers[] = 'User-Agent: Firebase/5/3.0.0/28/Android';
    $headers[] = 'cache-control: no-cache';

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        return 'ALFREDO GANTENG';
    }

    curl_close ($ch);
    return $result;
}

function gandakan($obid, $crd, $data, $pnjg)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://photon-pong.firebaseio.com/CoinbaseUsers/'.$obid.'/.json?print=pretty&auth='.$crd.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ''.$data.'');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers   = array();
    $headers[] = 'Content-Length: '.$pnjg.'';
    $headers[] = 'Content-Type: application/json; charset=utf-8';

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    curl_close ($ch);
    return $result;
}

function balance($obid, $loginuth)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://photon-pong.firebaseio.com/CoinbaseUsers/'.$obid.'/photon_accu/.json?print=pretty&auth='.$loginuth.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "");
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers   = array();
    $headers[] = 'Accept: */*';
    $headers[] = 'Cache-Control: no-cache';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    $headers[] = 'Host: photon-pong.firebaseio.com';
    $headers[] = 'User-Agent: Firebase/5/3.0.0/28/Android';
    $headers[] = 'cache-control: no-cache';

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        return 'ALFREDO GANTENG';
    }

    curl_close ($ch);
    return $result;
}

$end        = "\033[0m";
$black      = "\033[0;30m";
$blackb     = "\033[1;30m";
$white      = "\033[0;37m";
$whiteb     = "\033[1;37m";
$red        = "\033[0;31m";
$redb       = "\033[1;31m";
$green      = "\033[0;32m";
$greenb     = "\033[1;32m";
$yellow     = "\033[0;33m";
$yellowb    = "\033[1;33m";
$blue       = "\033[0;34m";
$blueb      = "\033[1;34m";
$purple     = "\033[0;35m";
$purpleb    = "\033[1;35m";
$lightblue  = "\033[0;36m";
$lightblueb = "\033[1;36m";
$banner     = "{$greenb}
    ##  #        #              ##
    # # ### ### ### ### ##      # # ### ##  ###
    ##  # # # #  #  # # # #     ##  # # # # # #
    #   # # ###  ## ### # #     #   ### # #  ##
    #                           #           ###
{$end}";

require("config.php");
$login = json_decode(login($obid,$cred));
@system("clear");

echo $banner;
echo "\n\033[1;31m[ \033[1;33mSubscribe Channel \033[1;31m] ";
echo "\033[1;31m[ \033[1;36mAneuk Cabak\033[1;31m ]\n";
echo "\033[1;31m[ \033[1;33mSubscribe Channel \033[1;31m] ";
echo "\033[1;31m[ \033[1;36mAneuk Bawang \033[1;31m]\n\n";
echo "{$yellow}Login.";
sleep(1);
echo ".";
sleep(1);
echo ".\n";

if ($login->error == true) {
    print"{$greenb}[".date('G:i:s')."]{$end} - {$redb}Data tidak valid, silahkan capture ulang.{$end}\r\n";
} else {
    print"{$yellow}Login Sukses...{$end}\n";
    print"{$greenb}Balance Agan {$white}: {$yellow}{$login->photon_accu} {$blue}Litoshi{$end}\n\n";

    while (true) {
        $data    = json_decode(login($obid,$cred));
        $z       = json_encode(array(
                               "email"=>$data->email,
                               "last_claimed"=>$data->last_claimed,
                               "objectId"=>$data->objectId,
                               "photon_accu"=>$data->photon_accu + 10,
                               "photon_total_claimed"=>$data->photon_total_claimed,
                               "referral_accu"=>$data->referral_accu + 360,
                               "score"=>$data->score));
        $panjang = strlen($z);
        $ganda   = json_decode(gandakan($obid, $cred, $z, $panjang));

        if ($ganda->photon_accu == true) {
            print"{$greenb}[".date('G:i:s')."]{$end} - {$lightblueb}Update Balance {$white}: {$yellow}{$ganda->photon_accu} {$blue}Litoshi{$end}\n";
            sleep(5);
        } else {
            print"{$greenb}[".date('G:i:s')."]{$end} - {$redb}Capture ulang, ganti cred..!!{$end}\n";
            exit();
        }
    }
}
?>
