<?php
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    }
}
function indo_currency($nominal)
{
    $result = number_format($nominal, 0, ',', '.');
    return $result;
}

function indo_tlp($nohp)
{
    // kadang ada penulisan no hp 0811 239 345
    $nohp = str_replace(" ", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace("(", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace(")", "", $nohp);
    // kadang ada penulisan no hp 0811.239.345
    $nohp = str_replace(".", "", $nohp);

    // cek apakah no hp mengandung karakter + dan 0-9
    if (!preg_match('/[^+0-9]/', trim($nohp))) {
        // cek apakah no hp karakter 1-3 adalah +62
        if (substr(trim($nohp), 0, 3) == '+62') {
            $nohp = trim($nohp);
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif (substr(trim($nohp), 0, 1) == '0') {
            $nohp = '62' . substr(trim($nohp), 1);
        }

        $result = $nohp;
        return $result;
    }
}
function indo_date($date)
{
    $d = substr($date, 8, 2);
    $m = substr($date, 5, 2);
    $y = substr($date, 0, 4);
    $bulan = Date($m);
    switch ($bulan) {
        case 01:
            $bulan = 'Januari';
            break;
        case 2:
            $bulan = 'Februari';
            break;
        case 3:
            $bulan = 'Maret';
            break;
        case 4:
            $bulan = 'April';
            break;
        case 5:
            $bulan = 'Mei';
            break;
        case 6:
            $bulan = 'Juni';
            break;
        case 7:
            $bulan = 'Juli';
            break;
        case 8:
            $bulan = 'Agustus';
            break;
        case 9:
            $bulan = 'September';
            break;
        case 10:
            $bulan = 'Oktober';
            break;
        case 11:
            $bulan = 'November';
            break;
        case 12:
            $bulan = 'Desember';
            break;
    }
    return $d . ' ' . $bulan . ' ' . $y;
}


if (!function_exists('number_to_words')) {
    function number_to_words($number)
    {
        $terbilang = trim(to_word($number));
        return ucwords($results = $terbilang);
    }

    function to_word($number)
    {
        $words = "";
        $arr_number = array(
            "",
            "satu",
            "dua",
            "tiga",
            "empat",
            "lima",
            "enam",
            "tujuh",
            "delapan",
            "sembilan",
            "sepuluh",
            "sebelas"
        );

        if ($number < 12) {
            $words = " " . $arr_number[$number];
        } else if ($number < 20) {
            $words = to_word($number - 10) . " belas";
        } else if ($number < 100) {
            $words = to_word($number / 10) . " puluh " . to_word($number % 10);
        } else if ($number < 200) {
            $words = "seratus " . to_word($number - 100);
        } else if ($number < 1000) {
            $words = to_word($number / 100) . " ratus " . to_word($number % 100);
        } else if ($number < 2000) {
            $words = "seribu " . to_word($number - 1000);
        } else if ($number < 1000000) {
            $words = to_word($number / 1000) . " ribu " . to_word($number % 1000);
        } else if ($number < 1000000000) {
            $words = to_word($number / 1000000) . " juta " . to_word($number % 1000000);
        } else {
            $words = "undefined";
        }
        return $words;
    }
}

function indo_month($month)
{
    $bulan = Date($month);
    switch ($bulan) {
        case 01:
            $bulan = 'Januari';
            break;
        case 02:
            $bulan = 'Februari';
            break;
        case 03:
            $bulan = 'Maret';
            break;
        case 04:
            $bulan = 'April';
            break;
        case 05:
            $bulan = 'Mei';
            break;
        case 06:
            $bulan = 'Juni';
            break;
        case 07:
            $bulan = 'Juli';
            break;
        case 8:
            $bulan = 'Agustus';
            break;
        case 9:
            $bulan = 'September';
            break;
        case 10:
            $bulan = 'Oktober';
            break;
        case 11:
            $bulan = 'November';
            break;
        case 12:
            $bulan = 'Desember';
            break;
    }
    return  $bulan;
}

function code_unique($nominal)
{
    $sub = substr($nominal, -3);
    $sub2 = substr($nominal, -2);
    $sub3 = substr($nominal, -1);

    $total =  random_string('numeric', 3);
    $total2 =  random_string('numeric', 2);
    $total3 =  random_string('numeric', 1);

    if ($sub == 0) {
        $hasil =  $nominal + $total;
        echo "No Unik :" . $total . "<br>";
        echo "Nominal Transfer : Rp. " . number_format($hasil, 0, ",", ".");
    } else if ($sub2 == 0) {
        $hasil = $nominal + $total2;
        $no = substr($hasil, -3);
        echo "No Unik :" . $no . "<br>";
        echo "Nominal Transfer : Rp. " . number_format($hasil, 0, ",", ".");
    } else if ($sub3 == 0) {
        $hasil = $nominal + $total3;
        $no = substr($hasil, -3);
        echo "No Unik :" . $no . "<br>";
        echo "Nominal Transfer : Rp. " . number_format($hasil, 0, ",", ".");
    } else {
        echo "No Unik :" . $sub . "<br>";
        echo "Nominal Transfer : Rp. " . number_format($nominal, 0, ",", ".");
    }
}

function formatBytes($size, $decimals = 0)

{

    $unit = array(

        '0' => 'Byte',

        '1' => 'KB',

        '2' => 'MB',

        '3' => 'GB',

        '4' => 'TB',

        '5' => 'PB',

        '6' => 'EB',

        '7' => 'ZB',

        '8' => 'YB'

    );



    for ($i = 0; $size >= 1024 && $i <= count($unit); $i++) {

        $size = $size / 1024;
    }



    return round($size, $decimals) . ' ' . $unit[$i];
}



// function  format bytes2

function formatBytes2($size, $decimals = 0)

{

    $unit = array(

        '0' => 'Byte',

        '1' => 'KB',

        '2' => 'MB',

        '3' => 'GB',

        '4' => 'TB',

        '5' => 'PB',

        '6' => 'EB',

        '7' => 'ZB',

        '8' => 'YB'

    );



    for ($i = 0; $size >= 1000 && $i <= count($unit); $i++) {

        $size = $size / 1000;
    }



    return round($size, $decimals) . '' . $unit[$i];
}





// function  format bites

function formatBites($size, $decimals = 0)

{

    $unit = array(

        '0' => 'Byte',

        '1' => 'KB',

        '2' => 'MB',

        '3' => 'GB',

        '4' => 'TB',

        '5' => 'PB',

        '6' => 'EB',

        '7' => 'ZB',

        '8' => 'YB'

    );



    for ($i = 0; $size >= 1000 && $i <= count($unit); $i++) {

        $size = $size / 1000;
    }



    return round($size, $decimals) . ' ' . $unit[$i];
}
function formattimemikro($dtm)
{
    if (substr($dtm, 1, 1) == "d" || substr($dtm, 2, 1) == "d") {
        $day = explode("d", $dtm)[0] . "d";
        $day = str_replace("d", "d ", str_replace("w", "w ", $day));
        $dtm = explode("d", $dtm)[1];
    } elseif (substr($dtm, 1, 1) == "w" && substr($dtm, 3, 1) == "d" || substr($dtm, 2, 1) == "w" && substr($dtm, 4, 1) == "d") {
        $day = explode("d", $dtm)[0] . "d";
        $day = str_replace("d", "d ", str_replace("w", "w ", $day));
        $dtm = explode("d", $dtm)[1];
    } elseif (substr($dtm, 1, 1) == "w" || substr($dtm, 2, 1) == "w") {
        $day = explode("w", $dtm)[0] . "w";
        $day = str_replace("d", "d ", str_replace("w", "w ", $day));
        $dtm = explode("w", $dtm)[1];
    }

    // secs
    if (strlen($dtm) == "2" && substr($dtm, -1) == "s") {
        $format = $day . " 00:00:0" . substr($dtm, 0, -1);
    } elseif (strlen($dtm) == "3" && substr($dtm, -1) == "s") {
        $format = $day . " 00:00:" . substr($dtm, 0, -1);
        //minutes
    } elseif (strlen($dtm) == "2" && substr($dtm, -1) == "m") {
        $format = $day . " 00:0" . substr($dtm, 0, -1) . ":00";
    } elseif (strlen($dtm) == "3" && substr($dtm, -1) == "m") {
        $format = $day . " 00:" . substr($dtm, 0, -1) . ":00";
        //hours
    } elseif (strlen($dtm) == "2" && substr($dtm, -1) == "h") {
        $format = $day . " 0" . substr($dtm, 0, -1) . ":00:00";
    } elseif (strlen($dtm) == "3" && substr($dtm, -1) == "h") {
        $format = $day . " " . substr($dtm, 0, -1) . ":00:00";

        //minutes -secs
    } elseif (strlen($dtm) == "4" && substr($dtm, -1) == "s" && substr($dtm, 1, -2) == "m") {
        $format = $day . " " . "00:0" . substr($dtm, 0, 1) . ":0" . substr($dtm, 2, -1);
    } elseif (strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm, 1, -3) == "m") {
        $format = $day . " " . "00:0" . substr($dtm, 0, 1) . ":" . substr($dtm, 2, -1);
    } elseif (strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm, 2, -2) == "m") {
        $format = $day . " " . "00:" . substr($dtm, 0, 2) . ":0" . substr($dtm, 3, -1);
    } elseif (strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm, 2, -3) == "m") {
        $format = $day . " " . "00:" . substr($dtm, 0, 2) . ":" . substr($dtm, 3, -1);

        //hours -secs
    } elseif (strlen($dtm) == "4" && substr($dtm, -1) == "s" && substr($dtm, 1, -2) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":00:0" . substr($dtm, 2, -1);
    } elseif (strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm, 1, -3) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":00:" . substr($dtm, 2, -1);
    } elseif (strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm, 2, -2) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":00:0" . substr($dtm, 3, -1);
    } elseif (strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm, 2, -3) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":00:" . substr($dtm, 3, -1);

        //hours -secs
    } elseif (strlen($dtm) == "4" && substr($dtm, -1) == "m" && substr($dtm, 1, -2) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":0" . substr($dtm, 2, -1) . ":00";
    } elseif (strlen($dtm) == "5" && substr($dtm, -1) == "m" && substr($dtm, 1, -3) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":" . substr($dtm, 2, -1) . ":00";
    } elseif (strlen($dtm) == "5" && substr($dtm, -1) == "m" && substr($dtm, 2, -2) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":0" . substr($dtm, 3, -1) . ":00";
    } elseif (strlen($dtm) == "6" && substr($dtm, -1) == "m" && substr($dtm, 2, -3) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":" . substr($dtm, 3, -1) . ":00";

        //hours minutes secs
    } elseif (strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm, 3, -2) == "m" && substr($dtm, 1, -4) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":0" . substr($dtm, 2, -3) . ":0" . substr($dtm, 4, -1);
    } elseif (strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm, 3, -3) == "m" && substr($dtm, 1, -5) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":0" . substr($dtm, 2, -4) . ":" . substr($dtm, 4, -1);
    } elseif (strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm, 4, -2) == "m" && substr($dtm, 1, -5) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":" . substr($dtm, 2, -3) . ":0" . substr($dtm, 5, -1);
    } elseif (strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm, 4, -3) == "m" && substr($dtm, 1, -6) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":" . substr($dtm, 2, -4) . ":" . substr($dtm, 5, -1);
    } elseif (strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm, 4, -2) == "m" && substr($dtm, 2, -4) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":0" . substr($dtm, 3, -3) . ":0" . substr($dtm, 5, -1);
    } elseif (strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm, 4, -3) == "m" && substr($dtm, 2, -5) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":0" . substr($dtm, 3, -4) . ":" . substr($dtm, 5, -1);
    } elseif (strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm, 5, -2) == "m" && substr($dtm, 2, -5) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":" . substr($dtm, 3, -3) . ":0" . substr($dtm, 6, -1);
    } elseif (strlen($dtm) == "9" && substr($dtm, -1) == "s" && substr($dtm, 5, -3) == "m" && substr($dtm, 2, -6) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":" . substr($dtm, 3, -4) . ":" . substr($dtm, 6, -1);
    } else {
        $format = $dtm;
    }
    return $format;
}

function sendmsg($target, $message)
{
    $ci = get_instance();
    $whatsapp = $ci->db->get('whatsapp')->row_array();

    if ($whatsapp['vendor'] == 'WAblas') {
        if ($whatsapp['version'] == 0) {
            $curl = curl_init();
            $token = $whatsapp['token'];

            $data = [
                'phone' => indo_tlp($target),
                'message' => $message,
                'secret' => false, // or true
                'priority' => true, // or true
            ];

            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array(
                    "Authorization: $token",
                )
            );
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/send-message");
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            $result = curl_exec($curl);
            $result = json_decode($result, true);
            curl_close($curl);
        } else {
            $token = $whatsapp['token'];
            $curl = curl_init();

            $data = [
                'phone' => indo_tlp($target),
                'message' => $message,
                'secret' => false,
                'retry' => false,
                'isGroup' => false
            ];

            $payload[] = [
                'phone' => indo_tlp($target),
                'message' => $message,
                'secret' => false,
                'retry' => false,
                'isGroup' => false
            ];
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$whatsapp[domain_api]/api/v2/send-message",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode(['data' => $payload]),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $token,
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            // echo $response;
        }

        // if ($result['status'] == 1) {
        //     $ci->session->set_flashdata('success-sweet', $result['message'] . '<br> Sisa Kuota : ' . $result['data']['quota']);
        // }
    }
    if ($whatsapp['vendor'] == 'Starsender') {
        $apikey = $whatsapp['api_key'];
        $tujuan = indo_tlp($target);
        $pesan = $message;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://starsender.online/api/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'apikey: ' . $apikey
            ),
        ));


        $result = curl_exec($curl);
        $result = json_decode($result, true);
        curl_close($curl);
        // if ($result['status'] == 1) {
        //     $ci->session->set_flashdata('success-sweet', $result['message']);
        // } else {
        //     $ci->session->set_flashdata('error-sweet', $result['message']);
        // }
    }
    if ($whatsapp['vendor'] == 'Other') {
        $apikey = $whatsapp['token'];
        $sender = $whatsapp['username'];
        $data = [
            'api_key' => $apikey,
            'sender' => $sender,
            'number' => $target,
            'message' => $message
        ];



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  "$whatsapp[domain_api]/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        // if ($result['status'] == 'true') {
        //     $ci->session->set_flashdata('success', $result['msg']);
        // } else {
        //     $ci->session->set_flashdata('error', $result['msg']);
        // }
    }
    if ($whatsapp['vendor'] == 'Ruangwa') {
        $apikey = $whatsapp['api_key'];
        $phone = indo_tlp($target); //atau bisa menggunakan 62812xxxxxxx
        $message = $message;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token=' . $apikey . '&number=' . $phone . '&message=' . $message,
        ));
        $response = curl_exec($curl);
        $result = json_decode($response, true);
        curl_close($curl);
        // echo $response;
        // if ($result['status'] == 'sent') {
        //     $ci->session->set_flashdata('success', $result['message']);
        // } else {
        //     $ci->session->set_flashdata('error', $result['message']);
        // }
    }
}
function sendmsgbill($target, $message, $invoice)
{
    $ci = get_instance();
    $whatsapp = $ci->db->get('whatsapp')->row_array();

    if ($whatsapp['vendor'] == 'WAblas') {
        if ($whatsapp['version'] == 0) {
            $curl = curl_init();
            $token = $whatsapp['token'];

            $data = [
                'phone' => indo_tlp($target),
                'message' => $message,
                'secret' => false, // or true
                'priority' => true, // or true
            ];

            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array(
                    "Authorization: $token",
                )
            );
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/send-message");
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            $result = curl_exec($curl);
            $result = json_decode($result, true);
            curl_close($curl);
        } else {
            $token = $whatsapp['token'];
            $curl = curl_init();

            $data = [
                'phone' => indo_tlp($target),
                'message' => $message,
                'secret' => false,
                'retry' => false,
                'isGroup' => false
            ];

            $payload[] = [
                'phone' => indo_tlp($target),
                'message' => $message,
                'secret' => false,
                'retry' => false,
                'isGroup' => false
            ];
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$whatsapp[domain_api]/api/v2/send-message",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode(['data' => $payload]),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $token,
                    'Content-Type: application/json'
                ),
            ));
            $result = curl_exec($curl);
            $result = json_decode($result, true);
            curl_close($curl);
            if ($result['status'] == 1) {
                $ci->db->set('send_bill',  date('Y-m-d H:i:s'));
                $ci->db->where('invoice', $invoice);
                $ci->db->update('invoice');
            } else {
            }
        }
    }
    if ($whatsapp['vendor'] == 'Starsender') {
        $apikey = $whatsapp['api_key'];
        $tujuan = indo_tlp($target);
        $pesan = $message;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://starsender.online/api/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'apikey: ' . $apikey
            ),
        ));


        $result = curl_exec($curl);
        $result = json_decode($result, true);
        curl_close($curl);
        if ($result['status'] == 1) {
            $ci->db->set('send_bill', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        }
    }
    if ($whatsapp['vendor'] == 'Other') {
        $apikey = $whatsapp['token'];
        $sender = $whatsapp['username'];
        $data = [
            'api_key' => $apikey,
            'sender' => $sender,
            'number' => $target,
            'message' => $message
        ];



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  "$whatsapp[domain_api]/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response, true);
        if ($result['status'] == 'sent') {
            $ci->db->set('send_bill', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        }
    }
    if ($whatsapp['vendor'] == 'Ruangwa') {
        $apikey = $whatsapp['api_key'];
        $phone = indo_tlp($target); //atau bisa menggunakan 62812xxxxxxx
        $message = $message;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token=' . $apikey . '&number=' . $phone . '&message=' . $message,
        ));
        $response = curl_exec($curl);
        $result = json_decode($response, true);
        curl_close($curl);
        echo $response;
        if ($result['status'] == 'sent') {
            $ci->db->set('send_bill', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        }
    }
}
function sendmsgpaid($target, $message, $invoice)
{
    $ci = get_instance();
    $whatsapp = $ci->db->get('whatsapp')->row_array();

    if ($whatsapp['vendor'] == 'WAblas') {
        if ($whatsapp['version'] == 0) {
            $curl = curl_init();
            $token = $whatsapp['token'];

            $data = [
                'phone' => indo_tlp($target),
                'message' => $message,
                'secret' => false, // or true
                'priority' => true, // or true
            ];

            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array(
                    "Authorization: $token",
                )
            );
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/send-message");
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($curl, CURLOPT_TIMEOUT, 12);
            $response = curl_exec($curl);
            if ($response === false) {
                log_message('error', 'Paid invoice WhatsApp notification failed: ' . curl_error($curl));
                $result = null;
            } else {
                $result = json_decode($response, true);
            }
            curl_close($curl);
        } else {
            $token = $whatsapp['token'];
            $curl = curl_init();

            $data = [
                'phone' => indo_tlp($target),
                'message' => $message,
                'secret' => false,
                'retry' => false,
                'isGroup' => false
            ];

            $payload[] = [
                'phone' => indo_tlp($target),
                'message' => $message,
                'secret' => false,
                'retry' => false,
                'isGroup' => false
            ];
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$whatsapp[domain_api]/api/v2/send-message",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_TIMEOUT => 12,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode(['data' => $payload]),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $token,
                    'Content-Type: application/json'
                ),
            ));
            $result = curl_exec($curl);
            if ($result === false) {
                log_message('error', 'Paid invoice WhatsApp notification failed: ' . curl_error($curl));
                $result = null;
            } else {
                $result = json_decode($result, true);
            }
            curl_close($curl);
        }

        if (is_array($result) && ($result['status'] ?? null) == 1) {
            $ci->db->set('send_paid', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        }
    }
    if ($whatsapp['vendor'] == 'Starsender') {
        $apikey = $whatsapp['api_key'];
        $tujuan = indo_tlp($target);
        $pesan = $message;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://starsender.online/api/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 12,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'apikey: ' . $apikey
            ),
        ));

        $result = curl_exec($curl);
        if ($result === false) {
            log_message('error', 'Paid invoice WhatsApp notification failed: ' . curl_error($curl));
            $result = null;
        } else {
            $result = json_decode($result, true);
        }
        curl_close($curl);
        if (is_array($result) && ($result['status'] ?? null) == 1) {
            $ci->db->set('send_paid', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        }
    }
    if ($whatsapp['vendor'] == 'Other') {
        $apikey = $whatsapp['token'];
        $sender = $whatsapp['username'];
        $data = [
            'api_key' => $apikey,
            'sender' => $sender,
            'number' => $target,
            'message' => $message
        ];



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  "$whatsapp[domain_api]/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 12,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        if ($response === false) {
            log_message('error', 'Paid invoice WhatsApp notification failed: ' . curl_error($curl));
            $result = null;
        } else {
            $result = json_decode($response, true);
        }
        curl_close($curl);
        if (is_array($result) && ($result['status'] ?? null) == 'sent') {
            $ci->db->set('send_paid', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        }
    }
    if ($whatsapp['vendor'] == 'Ruangwa') {
        $apikey = $whatsapp['api_key'];
        $phone = indo_tlp($target); //atau bisa menggunakan 62812xxxxxxx
        $message = $message;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 12,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token=' . $apikey . '&number=' . $phone . '&message=' . $message,
        ));
        $response = curl_exec($curl);
        if ($response === false) {
            log_message('error', 'Paid invoice WhatsApp notification failed: ' . curl_error($curl));
            $result = null;
        } else {
            $result = json_decode($response, true);
        }
        curl_close($curl);
        // echo $response;
        if (is_array($result) && ($result['status'] ?? null) == 'sent') {
            $ci->db->set('send_paid', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        }
    }
}
function sendmsgschbill($target, $message, $time, $invoice)
{
    $ci = get_instance();
    // $bill = $ci->db->get_where('invoice', ['invoice' => $invoice])->row_array();
    $whatsapp = $ci->db->get('whatsapp')->row_array();
    $APIkey = $whatsapp['api_key'];
    if ($whatsapp['vendor'] == 'WAblas') {
        if ($whatsapp['version'] == 0) {
            if ($whatsapp['period'] == 0) {
                $curl = curl_init();
                $token = $whatsapp['token'];
                $dateex = date('Y-m-d', $time);
                $timeex = date('H:i', $time);
                $data = [
                    'phone' => $target,
                    'message' => $message,
                    'date' => $dateex,
                    'time' => $timeex,
                ];

                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/schedule");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);
                if ($result['status'] == 1) {
                    $ci->db->set('send_bill', $time);
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                }
            } else {
                $curl = curl_init();
                $token = $whatsapp['token'];

                $data = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false, // or true
                    'priority' => true, // or true
                ];

                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/send-message");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);

                if ($result['status'] == 1) {
                    $ci->db->set('send_bill', date('Y-m-d H:i:s'));
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                }
            }
        } else {
            if ($whatsapp['period'] == 0) {
                $curl = curl_init();
                $token =  $whatsapp['token'];
                $payload = [
                    "data" => [
                        [
                            'category' => 'text',
                            'phone' => $target,
                            'scheduled_at' => $time,
                            'text' => $message,
                        ],
                    ]
                ];
                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                        "Content-Type: application/json"
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/v2/schedule");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

                $result = curl_exec($curl);
                $result = json_decode($result, true);
                // var_dump($result);
                // die;
                curl_close($curl);
                if ($result['status'] == 1) {
                    $ci->db->set('send_bill',  $time);
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                    $ci->session->set_flashdata('error-sweet', $result['message']);
                }
            } else {
                $token = $whatsapp['token'];
                $curl = curl_init();

                $data = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false,
                    'retry' => false,
                    'isGroup' => false
                ];

                $payload[] = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false,
                    'retry' => false,
                    'isGroup' => false
                ];
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$whatsapp[domain_api]/api/v2/send-message",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(['data' => $payload]),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: ' . $token,
                        'Content-Type: application/json'
                    ),
                ));

                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);
                if (is_array($result) && ($result['status'] ?? null) == 1) {
                    $ci->db->set('send_bill',  date('Y-m-d H:i:s'));
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                    $ci->session->set_flashdata('error-sweet', $result['message']);
                }
            }
        }
    }
    if ($whatsapp['vendor'] == 'Starsender') {
        if ($whatsapp['period'] == 0) {
            $apikey = $APIkey;
            $tujuan = $target;
            $pesan = $message;
            $jadwal = $time;
            echo $jadwal;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://starsender.online/api/v2/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net') . '&jadwal=' . rawurlencode($jadwal),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'apikey: ' . $apikey
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $result = json_decode($response, true);
            if ($result['status'] == 1) {
                $ci->db->set('send_bill', $time);
                $ci->db->where('invoice', $invoice);
                $ci->db->update('invoice');
            } else {
                $ci->session->set_flashdata('error-sweet', $result['message']);
            }
        } else {
            $apikey = $whatsapp['api_key'];
            $tujuan = indo_tlp($target);
            $pesan = $message;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://starsender.online/api/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'apikey: ' . $apikey
                ),
            ));


            $result = curl_exec($curl);
            $result = json_decode($result, true);
            curl_close($curl);

            if ($result['status'] == 1) {
                $ci->db->set('send_bill', date('Y-m-d H:i:s'));
                $ci->db->where('invoice', $invoice);
                $ci->db->update('invoice');
            }
        }
    }
    if ($whatsapp['vendor'] == 'Other') {
        $apikey = $whatsapp['token'];
        $sender = $whatsapp['username'];
        $data = [
            'api_key' => $apikey,
            'sender' => $sender,
            'number' => $target,
            'message' => $message
        ];



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  "$whatsapp[domain_api]/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        $result = json_decode($response, true);
        if ($result['status'] == 'sent') {
            $ci->db->set('send_bill', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        }
    }
    if ($whatsapp['vendor'] == 'Ruangwa') {
        $apikey = $whatsapp['api_key'];
        $phone = indo_tlp($target); //atau bisa menggunakan 62812xxxxxxx
        $message = $message;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token=' . $apikey . '&number=' . $phone . '&message=' . $message,
        ));
        $response = curl_exec($curl);
        $result = json_decode($response, true);
        curl_close($curl);
        // echo $response;
        if ($result['status'] == 'sent') {
            $ci->db->set('send_bill', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        } else {
            $ci->session->set_flashdata('error-sweet', $result['message']);
        }
    }
}
function sendmsgschbillpaid($target, $message, $time, $invoice)
{
    $ci = get_instance();
    // $bill = $ci->db->get_where('invoice', ['invoice' => $invoice])->row_array();
    $whatsapp = $ci->db->get('whatsapp')->row_array();
    $APIkey = $whatsapp['api_key'];
    if ($whatsapp['vendor'] == 'WAblas') {
        if ($whatsapp['version'] == 0) {
            if ($whatsapp['period'] == 0) {
                $curl = curl_init();
                $token = $whatsapp['token'];
                $dateex = date('Y-m-d', $time);
                $timeex = date('H:i', $time);
                $data = [
                    'phone' => $target,
                    'message' => $message,
                    'date' => $dateex,
                    'time' => $timeex,
                ];

                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/schedule");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);
                if ($result['status'] == 1) {
                    $ci->db->set('send_paid', $time);
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                    $ci->session->set_flashdata('error-sweet', $result['message']);
                }
            } else {
                $curl = curl_init();
                $token = $whatsapp['token'];

                $data = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false, // or true
                    'priority' => true, // or true
                ];

                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/send-message");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);

                if ($result['status'] == 1) {
                    $ci->db->set('send_paid', date('Y-m-d H:i:s'));
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                    $ci->session->set_flashdata('error-sweet', $result['message']);
                }
            }
        } else {
            if ($whatsapp['period'] == 0) {
                $curl = curl_init();
                $token =  $whatsapp['token'];
                $payload = [
                    "data" => [
                        [
                            'category' => 'text',
                            'phone' => $target,
                            'scheduled_at' => $time,
                            'text' => $message,
                        ],
                    ]
                ];
                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                        "Content-Type: application/json"
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/v2/schedule");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);
                if ($result['status'] == 1) {
                    $ci->db->set('send_paid',  $time);
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                    $ci->session->set_flashdata('error-sweet', $result['message']);
                }
            } else {
                $token = $whatsapp['token'];
                $curl = curl_init();

                $data = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false,
                    'retry' => false,
                    'isGroup' => false
                ];

                $payload[] = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false,
                    'retry' => false,
                    'isGroup' => false
                ];
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$whatsapp[domain_api]/api/v2/send-message",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(['data' => $payload]),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: ' . $token,
                        'Content-Type: application/json'
                    ),
                ));
                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);
                if ($result['status'] == 1) {
                    $ci->db->set('send_paid',  date('Y-m-d H:i:s'));
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                    $ci->session->set_flashdata('error-sweet', $result['message']);
                }
            }
        }
    }
    if ($whatsapp['vendor'] == 'Starsender') {
        if ($whatsapp['period'] == 0) {
            $apikey = $APIkey;
            $tujuan = $target;
            $pesan = $message;
            $jadwal = $time;
            echo $jadwal;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://starsender.online/api/v2/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net') . '&jadwal=' . rawurlencode($jadwal),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'apikey: ' . $apikey
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $result = json_decode($response, true);
            if ($result['status'] == 1) {
                $ci->db->set('send_paid', $time);
                $ci->db->where('invoice', $invoice);
                $ci->db->update('invoice');
            } else {
                $ci->session->set_flashdata('error-sweet', $result['message']);
            }
        } else {
            $apikey = $whatsapp['api_key'];
            $tujuan = indo_tlp($target);
            $pesan = $message;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://starsender.online/api/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'apikey: ' . $apikey
                ),
            ));


            $result = curl_exec($curl);
            $result = json_decode($result, true);
            curl_close($curl);

            if ($result['status'] == 1) {
                $ci->db->set('send_paid', date('Y-m-d H:i:s'));
                $ci->db->where('invoice', $invoice);
                $ci->db->update('invoice');
            }
        }
    }
    if ($whatsapp['vendor'] == 'Other') {
        $apikey = $whatsapp['token'];
        $sender = $whatsapp['username'];
        $data = [
            'api_key' => $apikey,
            'sender' => $sender,
            'number' => $target,
            'message' => $message
        ];



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  "$whatsapp[domain_api]/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        $result = json_decode($response, true);
        if ($result['status'] == 'sent') {
            $ci->db->set('send_paid', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        }
    }
    if ($whatsapp['vendor'] == 'Ruangwa') {
        $apikey = $whatsapp['api_key'];
        $phone = indo_tlp($target); //atau bisa menggunakan 62812xxxxxxx
        $message = $message;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token=' . $apikey . '&number=' . $phone . '&message=' . $message,
        ));
        $response = curl_exec($curl);
        $result = json_decode($response, true);
        curl_close($curl);
        // echo $response;
        if ($result['status'] == 'sent') {
            $ci->db->set('send_paid', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        } else {
            $ci->session->set_flashdata('error-sweet', $result['message']);
        }
    }
}
function sendmsgsch($target, $message, $time)
{
    $ci = get_instance();
    $whatsapp = $ci->db->get('whatsapp')->row_array();
    $APIkey = $whatsapp['api_key'];

    if ($whatsapp['vendor'] == 'WAblas') {
        if ($whatsapp['version'] == 0) {
            if ($whatsapp['period'] == 0) {
                $curl = curl_init();
                $token = $whatsapp['token'];
                $dateex = date('Y-m-d', $time);
                $timeex = date('H:i', $time);
                $data = [
                    'phone' => $target,
                    'message' => $message,
                    'date' => $dateex,
                    'time' => $timeex,
                ];

                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/schedule");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                $result = curl_exec($curl);
                curl_close($curl);
            } else {
                $curl = curl_init();
                $token = $whatsapp['token'];

                $data = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false, // or true
                    'priority' => true, // or true
                ];

                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/send-message");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);
            }
        } else {
            if ($whatsapp['period'] == 0) {
                $curl = curl_init();
                $token =  $whatsapp['token'];
                $payload = [
                    "data" => [
                        [
                            'category' => 'text',
                            'phone' => $target,
                            'scheduled_at' => $time,
                            'text' => $message,
                        ],
                    ]
                ];
                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                        "Content-Type: application/json"
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/v2/schedule");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);
            } else {
                $token = $whatsapp['token'];
                $curl = curl_init();

                $data = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false,
                    'retry' => false,
                    'isGroup' => false
                ];

                $payload[] = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false,
                    'retry' => false,
                    'isGroup' => false
                ];
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$whatsapp[domain_api]/api/v2/send-message",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(['data' => $payload]),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: ' . $token,
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
            }
        }
    }
    if ($whatsapp['vendor'] == 'Starsender') {
        if ($whatsapp['period'] == 0) {
            $apikey = $APIkey;
            $tujuan = $target;
            $pesan = $message;
            $jadwal = $time;
            echo $jadwal;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://starsender.online/api/v2/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net') . '&jadwal=' . rawurlencode($jadwal),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'apikey: ' . $apikey
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
        } else {
            $apikey = $whatsapp['api_key'];
            $tujuan = indo_tlp($target);
            $pesan = $message;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://starsender.online/api/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'apikey: ' . $apikey
                ),
            ));


            $result = curl_exec($curl);
            $result = json_decode($result, true);
            curl_close($curl);
            // if ($result['status'] == 1) {
            //     $ci->session->set_flashdata('success-sweet', $result['message']);
            // } else {
            //     $ci->session->set_flashdata('error-sweet', $result['message']);
            // }
        }
    }
    if ($whatsapp['vendor'] == 'Ruangwa') {
        $apikey = $whatsapp['api_key'];
        $phone = indo_tlp($target); //atau bisa menggunakan 62812xxxxxxx
        $message = $message;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token=' . $apikey . '&number=' . $phone . '&message=' . $message,
        ));
        $response = curl_exec($curl);
        $result = json_decode($response, true);
        curl_close($curl);
        // echo $response;
        // if ($result['status'] == 'sent') {
        //     $ci->session->set_flashdata('success', $result['message']);
        // } else {
        //     $ci->session->set_flashdata('error', $result['message']);
        // }
    }
    if ($whatsapp['vendor'] == 'Other') {
        $apikey = $whatsapp['token'];
        $sender = $whatsapp['username'];
        $data = [
            'api_key' => $apikey,
            'sender' => $sender,
            'number' => $target,
            'message' => $message
        ];



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  "$whatsapp[domain_api]/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        // if ($result['status'] == 'true') {
        //     $ci->session->set_flashdata('success', $result['msg']);
        // } else {
        //     $ci->session->set_flashdata('error', $result['msg']);
        // }
    }
}

function sendmsgschduedate($target, $message, $time, $invoice)
{
    $ci = get_instance();
    // $bill = $ci->db->get_where('invoice', ['invoice' => $invoice])->row_array();
    $whatsapp = $ci->db->get('whatsapp')->row_array();
    $APIkey = $whatsapp['api_key'];
    if ($whatsapp['vendor'] == 'WAblas') {
        if ($whatsapp['version'] == 0) {
            if ($whatsapp['period'] == 0) {
                $curl = curl_init();
                $token = $whatsapp['token'];
                $dateex = date('Y-m-d', $time);
                $timeex = date('H:i', $time);
                $data = [
                    'phone' => $target,
                    'message' => $message,
                    'date' => $dateex,
                    'time' => $timeex,
                ];

                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/schedule");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);
                if ($result['status'] == 1) {
                    $ci->db->set('send_due', date('Y-m-d H:i:s'));
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                }
            } else {
                $curl = curl_init();
                $token = $whatsapp['token'];

                $data = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false, // or true
                    'priority' => true, // or true
                ];

                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/send-message");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);

                if ($result['status'] == 1) {
                    $ci->db->set('send_due', date('Y-m-d H:i:s'));
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                }
            }
        } else {
            if ($whatsapp['period'] == 0) {
                $curl = curl_init();
                $token =  $whatsapp['token'];
                $payload = [
                    "data" => [
                        [
                            'category' => 'text',
                            'phone' => $target,
                            'scheduled_at' => $time,
                            'text' => $message,
                        ],
                    ]
                ];
                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                        "Content-Type: application/json"
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/v2/schedule");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);
                if ($result['status'] == 1) {
                    $ci->db->set('send_due', $time);
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                }
            } else {
                $token = $whatsapp['token'];
                $curl = curl_init();

                $data = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false,
                    'retry' => false,
                    'isGroup' => false
                ];

                $payload[] = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false,
                    'retry' => false,
                    'isGroup' => false
                ];
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$whatsapp[domain_api]/api/v2/send-message",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(['data' => $payload]),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: ' . $token,
                        'Content-Type: application/json'
                    ),
                ));
                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);
                if ($result['status'] == 1) {
                    $ci->db->set('send_due', date('Y-m-d H:i:s'));
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                }
            }
        }
    }
    if ($whatsapp['vendor'] == 'Starsender') {
        if ($whatsapp['period'] == 0) {
            $apikey = $APIkey;
            $tujuan = $target;
            $pesan = $message;
            $jadwal = $time;
            echo $jadwal;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://starsender.online/api/v2/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net') . '&jadwal=' . rawurlencode($jadwal),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'apikey: ' . $apikey
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $result = json_decode($response, true);
            if ($result['status'] == 1) {
                $ci->db->set('send_due', date('Y-m-d H:i:s'));
                $ci->db->where('invoice', $invoice);
                $ci->db->update('invoice');
            } else {
            }
        } else {
            $apikey = $whatsapp['api_key'];
            $tujuan = indo_tlp($target);
            $pesan = $message;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://starsender.online/api/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'apikey: ' . $apikey
                ),
            ));


            $result = curl_exec($curl);
            $result = json_decode($result, true);
            curl_close($curl);

            if ($result['status'] == 1) {
                $ci->db->set('send_due', date('Y-m-d H:i:s'));
                $ci->db->where('invoice', $invoice);
                $ci->db->update('invoice');
            }
        }
    }
    if ($whatsapp['vendor'] == 'Other') {
        $apikey = $whatsapp['token'];
        $sender = $whatsapp['username'];
        $data = [
            'api_key' => $apikey,
            'sender' => $sender,
            'number' => $target,
            'message' => $message
        ];



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  "$whatsapp[domain_api]/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        $result = json_decode($response, true);
        if ($result['status'] == 'sent') {
            $ci->db->set('send_due', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        }
    }
    if ($whatsapp['vendor'] == 'Ruangwa') {
        $apikey = $whatsapp['api_key'];
        $phone = indo_tlp($target); //atau bisa menggunakan 62812xxxxxxx
        $message = $message;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token=' . $apikey . '&number=' . $phone . '&message=' . $message,
        ));
        $response = curl_exec($curl);
        $result = json_decode($response, true);
        curl_close($curl);
        // echo $response;
        if ($result['status'] == 'sent') {
            $ci->db->set('send_due', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        }
    }
}
function sendmsgschbeforedue($target, $message, $time, $invoice)
{
    $ci = get_instance();
    // $bill = $ci->db->get_where('invoice', ['invoice' => $invoice])->row_array();
    $whatsapp = $ci->db->get('whatsapp')->row_array();
    $APIkey = $whatsapp['api_key'];
    if ($whatsapp['vendor'] == 'WAblas') {
        if ($whatsapp['version'] == 0) {
            if ($whatsapp['period'] == 0) {
                $curl = curl_init();
                $token = $whatsapp['token'];
                $dateex = date('Y-m-d', $time);
                $timeex = date('H:i', $time);
                $data = [
                    'phone' => $target,
                    'message' => $message,
                    'date' => $dateex,
                    'time' => $timeex,
                ];

                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/schedule");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);
                if ($result['status'] == 1) {
                    $ci->db->set('send_before_due', $time);
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                }
            } else {
                $curl = curl_init();
                $token = $whatsapp['token'];

                $data = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false, // or true
                    'priority' => true, // or true
                ];

                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/send-message");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);

                if ($result['status'] == 1) {
                    $ci->db->set('send_before_due',  date('Y-m-d H:i:s'));
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                }
            }
        } else {
            if ($whatsapp['period'] == 0) {
                $curl = curl_init();
                $token =  $whatsapp['token'];
                $payload = [
                    "data" => [
                        [
                            'category' => 'text',
                            'phone' => $target,
                            'scheduled_at' => $time,
                            'text' => $message,
                        ],
                    ]
                ];
                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                        "Content-Type: application/json"
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
                curl_setopt($curl, CURLOPT_URL, "$whatsapp[domain_api]/api/v2/schedule");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);
                if ($result['status'] == 1) {
                    $ci->db->set('send_before_due', $time);
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                }
            } else {
                $token = $whatsapp['token'];
                $curl = curl_init();

                $data = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false,
                    'retry' => false,
                    'isGroup' => false
                ];

                $payload[] = [
                    'phone' => indo_tlp($target),
                    'message' => $message,
                    'secret' => false,
                    'retry' => false,
                    'isGroup' => false
                ];
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$whatsapp[domain_api]/api/v2/send-message",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(['data' => $payload]),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: ' . $token,
                        'Content-Type: application/json'
                    ),
                ));
                $result = curl_exec($curl);
                $result = json_decode($result, true);
                curl_close($curl);
                if ($result['status'] == 1) {
                    $ci->db->set('send_before_due',  date('Y-m-d H:i:s'));
                    $ci->db->where('invoice', $invoice);
                    $ci->db->update('invoice');
                } else {
                }
            }
        }
    }
    if ($whatsapp['vendor'] == 'Starsender') {
        if ($whatsapp['period'] == 0) {
            $apikey = $APIkey;
            $tujuan = $target;
            $pesan = $message;
            $jadwal = $time;
            echo $jadwal;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://starsender.online/api/v2/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net') . '&jadwal=' . rawurlencode($jadwal),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'apikey: ' . $apikey
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $result = json_decode($response, true);
            if ($result['status'] == 1) {
                $ci->db->set('send_before_due', $time);
                $ci->db->where('invoice', $invoice);
                $ci->db->update('invoice');
            } else {
            }
        } else {
            $apikey = $whatsapp['api_key'];
            $tujuan = indo_tlp($target);
            $pesan = $message;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://starsender.online/api/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'apikey: ' . $apikey
                ),
            ));


            $result = curl_exec($curl);
            $result = json_decode($result, true);
            curl_close($curl);

            if ($result['status'] == 1) {
                $ci->db->set('send_before_due', date('Y-m-d H:i:s'));
                $ci->db->where('invoice', $invoice);
                $ci->db->update('invoice');
            }
        }
    }
    if ($whatsapp['vendor'] == 'Other') {
        $apikey = $whatsapp['token'];
        $sender = $whatsapp['username'];
        $data = [
            'api_key' => $apikey,
            'sender' => $sender,
            'number' => $target,
            'message' => $message
        ];



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  "$whatsapp[domain_api]/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;



        $result = json_decode($response, true);
        if ($result['status'] == 'sent') {
            $ci->db->set('send_before_due', date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        }
    }
    if ($whatsapp['vendor'] == 'Ruangwa') {
        $apikey = $whatsapp['api_key'];
        $phone = indo_tlp($target); //atau bisa menggunakan 62812xxxxxxx
        $message = $message;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token=' . $apikey . '&number=' . $phone . '&message=' . $message,
        ));
        $response = curl_exec($curl);
        $result = json_decode($response, true);
        curl_close($curl);
        // echo $response;
        if ($result['status'] == 'sent') {
            $ci->db->set('send_before_due',  date('Y-m-d H:i:s'));
            $ci->db->where('invoice', $invoice);
            $ci->db->update('invoice');
        } else {
        }
    }
}
function isolir($noservices, $router)
{
    $ci = get_instance();
    $customer = $ci->db->get_where('customer', ['no_services' => $noservices])->row_array();
    $router = $ci->db->get_where('router', ['id' => $router])->row_array();
    $ip = $router['ip_address'];
    $user = $router['username'];
    $pass = $router['password'];
    $port = $router['port'];
    $API = new Mikweb();
    $usermikrotik = $customer['user_mikrotik'];

    $connected = $API->connect($ip, $user, $pass, $port);
    // DISABLE HOTSPOT
    if ($customer['mode_user'] == 'Hotspot') {
        if ($customer['action'] == 0) {
            $getuser = $API->comm("/ip/hotspot/user/print", array(
                "?name" => $usermikrotik,
                '?disabled' => 'no'
            ));
            $id = $getuser[0]['.id'];
            $API->comm("/ip/hotspot/user/disable", array(
                ".id" => $id,
            ));

            $getactive = $API->comm("/ip/hotspot/active/print", array(
                "?user" => $usermikrotik,
            ));
            $idactive = $getactive[0]['.id'];
            $API->comm("/ip/hotspot/active/remove", array(
                ".id" => $idactive,
            ));
        } else {
            $cekprofile = $API->comm("/ip/hotspot/user/profile/print", array(
                '?name' => 'EXPIRED',
            ));

            $getuser = $API->comm("/ip/hotspot/user/print", array(
                "?name" => $usermikrotik,

            ));
            $id = $getuser[0]['.id'];
            $API->comm("/ip/hotspot/user/set", array(
                ".id" => $id,
                "profile" => 'EXPIRED',
            ));

            $getactive = $API->comm("/ip/hotspot/active/print", array(
                "?user" => $usermikrotik,
            ));
            $idactive = $getactive[0]['.id'];
            $API->comm("/ip/hotspot/active/remove", array(
                ".id" => $idactive,
            ));
        }
    }
    // DISABLE PPPOE
    if ($customer['mode_user'] == 'PPPOE') {
        if ($customer['action'] == 0) {
            $getuser = $API->comm("/ppp/secret/print", array(
                '?service' => 'pppoe',
                '?name' => $usermikrotik,

            ));
            $id = $getuser[0]['.id'];
            $API->comm("/ppp/secret/disable", array(
                ".id" =>  $id,
            ));
            $getactive = $API->comm("/ppp/active/print", array(
                '?name' => $usermikrotik,
            ));
            $idactive = $getactive[0]['.id'];
            $API->comm("/ppp/active/remove", array(
                ".id" =>  $idactive,
            ));
        } else {
            // PPPOE STATIC
            if ($customer['type_ip'] == 1) {
                $getuser = $API->comm("/ppp/secret/print", array(
                    '?service' => 'pppoe',
                    '?name' => $usermikrotik,
                ));
                $ipstatic = $getuser[0]['remote-address'];
                $API->comm("/ip/firewall/address-list/add", array(
                    'list' => 'EXPIRED',
                    'address' => $ipstatic,
                    'comment' => 'ISOLIR|' . $customer['no_services'] . '',

                ));
            } else {
                $cekprofile = $API->comm("/ppp/profile/print", array(
                    '?name' => 'EXPIRED',
                ));
                if (count($cekprofile) == 0) {
                    echo "Profile EXPIRED tidak terdaftar !";
                    $ci->session->set_flashdata('error', 'Profile EXPIRED tidak terdaftar !');
                } else {
                    $getuser = $API->comm("/ppp/secret/print", array(
                        '?service' => 'pppoe',
                        '?name' => $usermikrotik,

                    ));
                    $id = $getuser[0]['.id'];
                    $API->comm("/ppp/secret/set", array(
                        ".id" =>  $id,
                        "profile" => 'EXPIRED',
                    ));
                    $getactive = $API->comm("/ppp/active/print", array(
                        '?name' => $usermikrotik,
                    ));
                    $idactive = $getactive[0]['.id'];
                    $API->comm("/ppp/active/remove", array(
                        ".id" =>  $idactive,
                    ));
                }
            }
        }
    }
    // DISABLE STATIC
    if ($customer['mode_user'] == 'Static') {
        if (!$connected) {
            return [
                'success' => false,
                'message' => 'Tidak dapat terhubung ke router pelanggan.',
            ];
        }

        $simplequeue = $API->comm("/queue/simple/print", array('?name' => $usermikrotik));
        if (!empty($simplequeue['!trap']) || !empty($simplequeue['!fatal'])) {
            return [
                'success' => false,
                'message' => 'Router menolak pemeriksaan Simple Queue. Periksa izin API dan log router.',
            ];
        }
        if (empty($simplequeue[0]['target'])) {
            return [
                'success' => false,
                'message' => 'Simple Queue "' . htmlspecialchars($usermikrotik, ENT_QUOTES, 'UTF-8') . '" tidak ditemukan atau Target-nya kosong di router pelanggan.',
            ];
        }

        $target = trim($simplequeue[0]['target']);
        if (strpos($target, ',') !== false) {
            return [
                'success' => false,
                'message' => 'Target Simple Queue berisi lebih dari satu alamat (' . htmlspecialchars($target, ENT_QUOTES, 'UTF-8') . '). Isolir dibatalkan agar tidak salah memblokir.',
            ];
        }

        $ipqueue = trim(explode('/', $target, 2)[0]);
        if (filter_var($ipqueue, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false) {
            return [
                'success' => false,
                'message' => 'Target Simple Queue bukan alamat IPv4 yang valid: ' . htmlspecialchars($target, ENT_QUOTES, 'UTF-8'),
            ];
        }

        $comment = 'ISOLIR|' . $customer['no_services'];
        if ($customer['action'] == 0) {
            $existingRules = $API->comm("/ip/firewall/filter/print", array("?comment" => $comment));
            if (!empty($existingRules['!trap']) || !empty($existingRules['!fatal'])) {
                return [
                    'success' => false,
                    'message' => 'Router menolak pemeriksaan Firewall Filter. Periksa izin API dan log router.',
                ];
            }

            $filterRules = $API->comm("/ip/firewall/filter/print");
            if (!empty($filterRules['!trap']) || !empty($filterRules['!fatal'])) {
                return [
                    'success' => false,
                    'message' => 'Router menolak pemeriksaan urutan Firewall Filter.',
                ];
            }
            $placeBefore = !empty($filterRules[0]['.id']) ? $filterRules[0]['.id'] : null;

            foreach (['src-address' => $ipqueue, 'dst-address' => $ipqueue] as $addressField => $address) {
                $rule = [
                    'chain' => 'forward',
                    $addressField => $address,
                    'action' => 'drop',
                    'comment' => $comment,
                ];
                if ($placeBefore !== null) {
                    $rule['place-before'] = $placeBefore;
                }

                $response = $API->comm("/ip/firewall/filter/add", $rule);
                if (!empty($response['!trap']) || !empty($response['!fatal'])) {
                    $routerError = $response['!trap'][0]['message'] ?? $response['!fatal'][0]['message'] ?? 'Router menolak perintah.';
                    return [
                        'success' => false,
                        'message' => 'Gagal memblokir akses ' . ($addressField === 'src-address' ? 'dari' : 'ke') . ' IP ' . $ipqueue . ': ' . htmlspecialchars($routerError, ENT_QUOTES, 'UTF-8'),
                    ];
                }
            }

            $verify = $API->comm("/ip/firewall/filter/print", array("?comment" => $comment));
            $blockedDirections = [];
            foreach ($verify as $rule) {
                if (($rule['action'] ?? '') === 'drop' && ($rule['chain'] ?? '') === 'forward') {
                    foreach (['src-address', 'dst-address'] as $field) {
                        $ruleAddress = explode('/', $rule[$field] ?? '', 2)[0];
                        if ($ruleAddress === $ipqueue) {
                            $blockedDirections[$field] = true;
                        }
                    }
                }
            }
            if (empty($blockedDirections['src-address']) || empty($blockedDirections['dst-address'])) {
                return [
                    'success' => false,
                    'message' => 'Router belum mengonfirmasi kedua rule isolir untuk IP ' . $ipqueue . '.',
                ];
            }

            $keptDirections = [];
            foreach ($verify as $rule) {
                if (empty($rule['.id'])) {
                    continue;
                }
                foreach (['src-address', 'dst-address'] as $field) {
                    $ruleAddress = explode('/', $rule[$field] ?? '', 2)[0];
                    if (
                        ($rule['action'] ?? '') === 'drop'
                        && ($rule['chain'] ?? '') === 'forward'
                        && $ruleAddress === $ipqueue
                    ) {
                        if (empty($keptDirections[$field])) {
                            $keptDirections[$field] = true;
                        } else {
                            $response = $API->comm("/ip/firewall/filter/remove", array(".id" => $rule['.id']));
                            if (!empty($response['!trap']) || !empty($response['!fatal'])) {
                                $routerError = $response['!trap'][0]['message'] ?? $response['!fatal'][0]['message'] ?? 'Router menolak perintah.';
                                return [
                                    'success' => false,
                                    'message' => 'Rule isolir sudah aktif, tetapi rule duplikat gagal dibersihkan: ' . htmlspecialchars($routerError, ENT_QUOTES, 'UTF-8'),
                                ];
                            }
                        }
                        break;
                    }
                }
            }
        } else {
            $response = $API->comm("/ip/firewall/address-list/add", array(
                'list' => 'EXPIRED',
                'address' => $ipqueue,
                'comment' => $comment,
            ));
            if (!empty($response['!trap']) || !empty($response['!fatal'])) {
                $routerError = $response['!trap'][0]['message'] ?? $response['!fatal'][0]['message'] ?? 'Router menolak perintah.';
                return [
                    'success' => false,
                    'message' => 'Gagal menambahkan IP ke address-list EXPIRED: ' . htmlspecialchars($routerError, ENT_QUOTES, 'UTF-8'),
                ];
            }

            $verify = $API->comm("/ip/firewall/address-list/print", array("?comment" => $comment));
            if (empty($verify[0]['.id'])) {
                return [
                    'success' => false,
                    'message' => 'Router tidak mengonfirmasi IP pada address-list EXPIRED.',
                ];
            }
        }

        $ci->db->set('connection', 1);
        $ci->db->where('no_services', $noservices);
        $ci->db->update('customer');
        return [
            'success' => true,
            'message' => 'Isolir berhasil diterapkan di router untuk IP ' . $ipqueue . '.',
        ];
    }
    if ($ci->agent->is_browser()) {
        $agent = $ci->agent->browser() . ' ' . $ci->agent->version();
    } elseif ($ci->agent->is_mobile()) {
        $agent = $ci->agent->mobile();
    }
    if ($ci->session->userdata('name') != '') {

        $sessionname = $ci->session->userdata('name');
    } else {
        $sessionname = 'System';
    }
    if ($ci->session->userdata('id') != '') {
        $iduser = $ci->session->userdata('id');
    } else {
        $iduser = '0';
    }
    if ($ci->session->userdata('role_id') != '') {
        $roleid = $ci->session->userdata('role_id');
    } else {
        $roleid = 0;
    }
    // $params = [
    //     'datetime' => time(),
    //     'category' => 'Activity',
    //     'user_id' => $iduser,
    //     'role_id' => $roleid,
    //     'name' => $sessionname,
    //     'remark' => 'Isolir Pelanggan ' . $customer['no_services'] . ' A/N ' . $customer['name'] . ' ' . date('d-m-Y H:i:s') . ' ' . 'dari' . ' ' . $ci->agent->platform() . ' ' . $ci->input->ip_address() . ' ' . $agent,
    // ];
    // $ci->db->insert('logs', $params);
    $bot = $ci->db->get('bot_telegram')->row_array();
    $tokens = $bot['token']; // token bot
    $owner = $bot['id_telegram_owner'];
    if ($ci->session->userdata('name') != '') {

        $sessionname = $ci->session->userdata('name');
    } else {
        $sessionname = 'System';
    }
    // $sendmessage = [
    //     'reply_markup' => json_encode(['inline_keyboard' => [
    //         [
    //             // ['text' => '✅ Open Isolir', 'url' => base_url('router/openisolir/' . $no_services)],
    //         ]
    //     ]]),
    //     'resize_keyboard' => true,
    //     'parse_mode' => 'html',
    //     'text' => "<b>ISOLIR PELANGGAN</b>\nNama : $customer[name]\nNo Layanan : $noservices\nRouter : $router[alias]\nAction : $actionisolir\nMode : $modeuser\nUser : $customer[user_mikrotik]\nAction By : $sessionname\n",
    //     'chat_id' => $owner
    // ];

    // file_get_contents("https://api.telegram.org/bot$tokens/sendMessage?" . http_build_query($sendmessage));
    $ci->db->set('connection', 1);
    $ci->db->where('no_services', $noservices);
    $ci->db->update('customer');
}
function openisolir($noservices, $router)
{
    $ci = get_instance();
    $customer = $ci->db->get_where('customer', ['no_services' => $noservices])->row_array();
    $router = $ci->db->get_where('router', ['id' => $router])->row_array();
    $ip = $router['ip_address'];
    $user = $router['username'];
    $pass = $router['password'];
    $port = $router['port'];
    $API = new Mikweb();
    $usermikrotik = $customer['user_mikrotik'];
    $API->connect($ip, $user, $pass, $port);
    $usermikrotik = $customer['user_mikrotik'];

    $API->connect($ip, $user, $pass, $port);
    if ($customer['mode_user'] == 'PPPOE') {

        $getuser = $API->comm("/ppp/secret/print", array('?service' => 'pppoe', '?name' => $usermikrotik, '?disabled' => 'yes',));
        $id = $getuser[0]['.id'];
        $API->comm("/ppp/secret/enable", array(
            ".id" =>  $id,
        ));
        $getuserex = $API->comm("/ppp/secret/print", array('?service' => 'pppoe', '?name' => $usermikrotik, '?profile' => 'EXPIRED'));
        if (count($getuserex) > 0) {
            $id = $getuserex[0]['.id'];
            $API->comm("/ppp/secret/set", array(
                ".id" =>  $id,
                "profile" =>  $customer['user_profile'],
            ));
            $getactive = $API->comm("/ppp/active/print", array(
                '?name' => $usermikrotik,
            ));
            $idactive = $getactive[0]['.id'];
            $API->comm("/ppp/active/remove", array(
                ".id" =>  $idactive,
            ));
        }

        $getuserfirewall = $API->comm("/ip/firewall/address-list/print", array("?comment" => 'ISOLIR|' . $customer['no_services'] . ''));
        $id = $getuserfirewall[0]['.id'];
        $API->comm("/ip/firewall/address-list/remove", array(
            ".id" => $id,
        ));
        $ci->db->set('connection', 0);
        $ci->db->where('no_services', $noservices);
        $ci->db->update('customer');
    }
    if ($customer['mode_user'] == 'Hotspot') {
        if ($customer['action'] == 0) {
            $getuser = $API->comm("/ip/hotspot/user/print", array(
                "?name" => $usermikrotik,
                '?disabled' => 'yes'
            ));
            $id = $getuser[0]['.id'];
            $API->comm("/ip/hotspot/user/enable", array(
                ".id" => $id,
            ));
            $ci->db->set('connection', 0);
            $ci->db->where('no_services', $noservices);
            $ci->db->update('customer');
        } else {
            $cekprofile = $API->comm("/ip/hotspot/user/profile/print", array(
                '?name' => $customer['user_profile'],
            ));
            // var_dump(count($cekprofile));
            // die;

            $getuser = $API->comm("/ip/hotspot/user/print", array(
                "?name" => $usermikrotik,
                "?profile" => 'EXPIRED',

            ));
            $id = $getuser[0]['.id'];
            $API->comm("/ip/hotspot/user/set", array(
                ".id" => $id,
                "profile" => $customer['user_profile'],
            ));
            $ci->db->set('connection', 0);
            $ci->db->where('no_services', $noservices);
            $ci->db->update('customer');
        }
    }
    if ($customer['mode_user'] == 'Static') {
        if ($customer['action'] == 0) {
            $getuser = $API->comm("/ip/firewall/filter/print", array("?comment" => 'ISOLIR|' . $customer['no_services'] . ''));
            foreach ($getuser as $rule) {
                if (!empty($rule['.id'])) {
                    $API->comm("/ip/firewall/filter/remove", array(
                        ".id" => $rule['.id'],
                    ));
                }
            }
            $ci->db->set('connection', 0);
            $ci->db->where('no_services', $noservices);
            $ci->db->update('customer');
        } else {
            $getuser = $API->comm("/ip/firewall/address-list/print", array("?comment" => 'ISOLIR|' . $customer['no_services'] . ''));
            $id = $getuser[0]['.id'];
            $API->comm("/ip/firewall/address-list/remove", array(
                ".id" => $id,
            ));
            $ci->db->set('connection', 0);
            $ci->db->where('no_services', $noservices);
            $ci->db->update('customer');
        }
    }
    if ($ci->agent->is_browser()) {
        $agent = $ci->agent->browser() . ' ' . $ci->agent->version();
    } elseif ($ci->agent->is_mobile()) {
        $agent = $ci->agent->mobile();
    }
    if ($ci->session->userdata('name') != '') {

        $sessionname = $ci->session->userdata('name');
    } else {
        $sessionname = 'System';
    }
    if ($ci->session->userdata('id') != '') {
        $iduser = $ci->session->userdata('id');
    } else {
        $iduser = '0';
    }
    if ($ci->session->userdata('role_id') != '') {
        $roleid = $ci->session->userdata('role_id');
    } else {
        $roleid = 0;
    }
    // $params = [
    //     'datetime' => time(),
    //     'category' => 'Activity',
    //     'user_id' => $iduser,
    //     'role_id' => $roleid,
    //     'name' => $sessionname,
    //     'remark' => 'Open Isolir Pelanggan ' . $customer['no_services'] . ' A/N ' . $customer['name'] . ' ' . date('d-m-Y H:i:s') . ' ' . 'dari' . ' ' . $ci->agent->platform() . ' ' . $ci->input->ip_address() . ' ' . $agent,
    // ];
    // $ci->db->insert('logs', $params);
    $bot = $ci->db->get('bot_telegram')->row_array();
    $tokens = $bot['token']; // token bot
    $owner = $bot['id_telegram_owner'];
    // $sendmessage = [
    //     'reply_markup' => json_encode(['inline_keyboard' => [
    //         [
    //             // ['text' => '✅ Konfirmasi', 'url' => base_url('confirmdetail/' . $post['no_invoice'])],

    //         ]
    //     ]]),
    //     'resize_keyboard' => true,
    //     'parse_mode' => 'html',
    //     'text' => "<b>OPEN ISOLIR</b>\nNama : $customer[name]\nNo Layanan : $noservices\nRouter : $router[alias]\nAction : $actionisolir\nMode : $modeuser\nUser : $customer[user_mikrotik]\nAction By : $sessionname\n",
    //     'chat_id' => $owner
    // ];

    // file_get_contents("https://api.telegram.org/bot$tokens/sendMessage?" . http_build_query($sendmessage));




}
function countusage($noservices, $router)
{
    $ci = get_instance();

    // Hapus Pemakaian 3 bln ke belakang

    $monthlampau = date('Y-m-d', strtotime(date('Y-m-d') . '- 3 month'));
    $ci->db->where("customer_usage.date_usage BETWEEN '" . ('2018-01-01') . "' AND '" . ($monthlampau) . "'");
    $ci->db->delete('customer_usage');
    $customer = $ci->db->get_where('customer', ['no_services' => $noservices])->row_array();
    $router = $ci->db->get_where('router', ['id' => $router])->row_array();
    $ip = $router['ip_address'];
    $user = $router['username'];
    $pass = $router['password'];
    $port = $router['port'];
    $API = new Mikweb();
    $userclient = $customer['user_mikrotik'];
    $API->connect($ip, $user, $pass, $port);
    if ($customer['mode_user'] == 'PPPOE') {
        $getusage = $API->comm("/interface/print", array(
            "?name" => "<pppoe-$userclient>",
        ));
        $usage = $getusage['0']['tx-byte'] + $getusage['0']['rx-byte'];

        $today = date('Y-m-d');
        $cekusage = $ci->db->get_where('customer_usage', ['date_usage' => $today, 'no_services' => $noservices])->row_array();
        if ($cekusage > 0) {
            if ($usage != 0) {
                $params = [
                    'count_usage' =>  $cekusage['count_usage'] + $usage,
                    'last_update' =>  time(),
                ];
                $ci->db->where('id', $cekusage['id']);
                $ci->db->update('customer_usage', $params);
            }
        } else {
            $params = [
                'no_services' => $noservices,
                'count_usage' =>  $usage,
                'date_usage' =>  $today,
                'last_update' =>  time(),
            ];
            $ci->db->insert('customer_usage', $params);
        }
        if ($ci->db->affected_rows() > 0) {
            if ($customer['mode_user'] == 'PPPOE') {
                $cekscript = $API->comm("/system/script/print", array('?name' => "reset-pppoe-$userclient"));
                $id = $cekscript[0]['.id'];
                if (count($cekscript) == 0) {
                    $API->comm("/system/script/add", array(
                        "name" =>  "reset-pppoe-$userclient",
                        "source" => "/interface reset-counters <pppoe-$userclient>",
                    ));
                } else {
                    $API->comm("/system/script/run", array(
                        ".id" => $id,
                    ));
                }
            }
        }
    }
    if ($customer['mode_user'] == 'Hotspot') {
        $getuser = $API->comm("/ip/hotspot/user/print", array("?name" => $userclient));
        $usage = $getuser['0']['bytes-out'] + $getuser['0']['bytes-in'];
        $today = date('Y-m-d');
        $cekusage = $ci->db->get_where('customer_usage', ['date_usage' => $today, 'no_services' => $noservices])->row_array();
        if ($cekusage > 0) {
            if ($usage != 0) {
                $params = [
                    'count_usage' =>  $cekusage['count_usage'] + $usage,
                    'last_update' =>  time(),
                ];
                $ci->db->where('id', $cekusage['id']);
                $ci->db->update('customer_usage', $params);
            }
        } else {
            $params = [
                'no_services' => $noservices,
                'count_usage' =>  $usage,
                'date_usage' =>  $today,
                'last_update' =>  time(),
            ];
            $ci->db->insert('customer_usage', $params);
        }
        if ($ci->db->affected_rows() > 0) {
            $id = $getuser[0]['.id'];
            $API->comm("/ip/hotspot/user/reset-counters", array(
                ".id" => $id,
            ));
        }
    }
    if ($customer['mode_user'] = 'Static') {
        $getuser = $API->comm("/queue/simple/print", array('?name' => $userclient));
        $byte = $getuser['0']['bytes'];
        $updl = explode("/", $byte);
        $up = $updl['0'];
        $dl = $updl['1'];
        $usage =  $up + $dl;
        $today = date('Y-m-d');
        $cekusage = $ci->db->get_where('customer_usage', ['date_usage' => $today, 'no_services' => $noservices])->row_array();
        if ($cekusage > 0) {
            if ($usage != 0) {
                $params = [
                    'count_usage' =>  $cekusage['count_usage'] + $usage,
                    'last_update' =>  time(),
                ];
                $ci->db->where('id', $cekusage['id']);
                $ci->db->update('customer_usage', $params);
            }
        } else {
            $params = [
                'no_services' => $noservices,
                'count_usage' =>  $usage,
                'date_usage' =>  $today,
                'last_update' =>  time(),
            ];
            $ci->db->insert('customer_usage', $params);
        }
        if ($ci->db->affected_rows() > 0) {
            $id = $getuser[0]['.id'];
            $API->comm("/queue/simple/reset-counters", array(
                ".id" =>  $id,
            ));
        }
    }
}
function jumlah_hari($bulan = 0, $tahun = 0)
{

    $bulan = $bulan > 0 ? $bulan : date("m");
    $tahun = $tahun > 0 ? $tahun : date("Y");

    switch ($bulan) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            return 31;
            break;
        case 4:
        case 6:
        case 9:
        case 11:
            return 30;
            break;
        case 2:
            return $tahun % 4 == 0 ? 29 : 28;
            break;
    }
}
function kick($noservices, $router)
{
    $ci = get_instance();
    $customer = $ci->db->get_where('customer', ['no_services' => $noservices])->row_array();
    $router = $ci->db->get_where('router', ['id' => $router])->row_array();
    $ip = $router['ip_address'];
    $user = $router['username'];
    $pass = $router['password'];
    $port = $router['port'];
    $API = new Mikweb();
    $usermikrotik = $customer['user_mikrotik'];
    $API->connect($ip, $user, $pass, $port);
    $usermikrotik = $customer['user_mikrotik'];



    $API->connect($ip, $user, $pass, $port);
    if ($customer['mode_user'] == 'PPPOE') {

        $getactive = $API->comm("/ppp/active/print", array(
            '?name' => $usermikrotik,
        ));
        $idactive = $getactive[0]['.id'];
        $API->comm("/ppp/active/remove", array(
            ".id" =>  $idactive,
        ));
    }
}
