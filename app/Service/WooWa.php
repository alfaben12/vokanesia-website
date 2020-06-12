<?php
namespace App\Service;

use GuzzleHttp\Client;

class WooWa {

    function __construct()
    {
        $this->token = env('WOOWA_TOKEN');
        $this->uri = 'http://116.203.92.59/api/';
    }
    
    public function sendOtp($phone_no, $otpCode)
    {
        // $pesan1 = "Hi ".$nama."
        // Kode Verivikasi Anda Untuk Vokanesia Adalah : ".$otpCode;

        $formData = array(
            'phone_no' => '+62'.$phone_no,
            'key' => $this->token,
            'message' => 'JANGAN MEMBERITAHU KODE RAHASIA INI KE SIAPAPUN termasuk pihak Vokanesia. WASPADA TERHADAP KASUS PENIPUAN! KODE VERIFIKASI untuk masuk: '.$otpCode
        );

        
        $client = new Client;
        $req = $client->request('POST', $this->uri.'send_message', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Content-Length' => strlen(json_encode($formData))
            ],
            'body' => json_encode($formData)
        ]);

        return $req->getBody();
    }

}