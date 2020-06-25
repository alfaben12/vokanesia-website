<?php

namespace App\Http\Controllers\Customers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Validator;
use Mail;

class RegisterController extends Controller
{
  public function index()
  {
    return view('auth/register');
  }

  public function do(Request $request)
  {
    $validator = Validator::make($request->all(),
    [
      'email' => 'required|email|unique:customers,email',
      'f_name' => 'required',
      'l_name' => 'required',
      'password' => 'required|min:8',
      'c_password' => 'required|same:password|min:8',
      'no_hp' => 'required|min:9|unique:customers,no_hp',
    ],
    [
      'email.required' => 'Email is empty',
      'email.unique' => 'Email already used',
      'f_name.required' => 'First name is empty',
      'l_name.required' => 'Last name is empty',
      'password.required' => 'Password is empty',
      'password.min' => 'Password must be at least 8 character',
      'c_password.min' => 'Confirmation Password must be at least 8 character',
      'c_password.required' => 'Confirmation password confirmation is empty',
      'c_password.same' => 'Confirmation password must be same with password',
      'no_hp.required' => 'Phone number is empty',
      'no_hp.min' => 'Phone number must be at least 9 character',
      'no_hp.unique' => 'Phone already used',
    ]);

    if ($validator->passes()) {
      $randOtp = rand(111111, 999999);
      try {
        $emailSend = $this->sendSmsOTP($request, $randOtp);
        if(!$emailSend){
          return response()->json([
            'status' => 'failed',
            'message' => 'otp_not_send'
          ], 400);
        }
        $dataInput = array(
          'email' => $request->input('email'),
          'nama' => $request->input('f_name').' '.$request->input('l_name'),
          'password' => Hash::make($request->input('c_password')),
          'no_hp' => $request->input('no_hp'),
          'verivied' => 'no',
          'otp' => $randOtp
        );

        $create = Customer::create($dataInput);

        return response()->json([
          'status' => 'success',
          'message' => 'otp_sended'
        ], 200);
      } catch (\Exception $e) {
        return response()->json([
          'error' => true,
          'message' => $e->getMessage()
        ], 500);
      }

    }

    else {
      return response()->json([
        "status" => "failed",
        "message" => implode(",<br />", $validator->errors()->all())
      ]);
    }
  }
  function sendEmailOTP($request, $randOtp)
  {
      try{
        $api_token = env('MAILKETING_API_TOKEN', ''); //silahkan copy dari api token mailketing
        $from_name = env('MAILKETING_NAME_SENDER', ''); //nama pengirim
        $from_email = env('MAILKETING_EMAIL_SENDER', ''); //email pengirim
        $subject = 'Email Verifikasi Akun Vokanesia.id'; //judul email
        $content = ''; //isi email format text / html
        $content .= '<!doctype html>
        <html>
          <head>
            <meta name="viewport" content="width=device-width" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Simple Transactional Email</title>
            <style>
              /* -------------------------------------
                  GLOBAL RESETS
              ------------------------------------- */
              
              /*All the styling goes here*/
              
              img {
                border: none;
                -ms-interpolation-mode: bicubic;
                max-width: 100%; 
              }
        
              body {
                background-color: #f6f6f6;
                font-family: sans-serif;
                -webkit-font-smoothing: antialiased;
                font-size: 14px;
                line-height: 1.4;
                margin: 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%; 
              }
        
              table {
                border-collapse: separate;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                width: 100%; }
                table td {
                  font-family: sans-serif;
                  font-size: 14px;
                  vertical-align: top; 
              }
        
              /* -------------------------------------
                  BODY & CONTAINER
              ------------------------------------- */
        
              .body {
                background-color: #f6f6f6;
                width: 100%; 
              }
        
              /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
              .container {
                display: block;
                margin: 0 auto !important;
                /* makes it centered */
                max-width: 580px;
                padding: 10px;
                width: 580px; 
              }
        
              /* This should also be a block element, so that it will fill 100% of the .container */
              .content {
                box-sizing: border-box;
                display: block;
                margin: 0 auto;
                max-width: 580px;
                padding: 10px; 
              }
        
              /* -------------------------------------
                  HEADER, FOOTER, MAIN
              ------------------------------------- */
              .main {
                background: #ffffff;
                border-radius: 3px;
                width: 100%; 
              }
        
              .wrapper {
                box-sizing: border-box;
                padding: 20px; 
              }
        
              .content-block {
                padding-bottom: 10px;
                padding-top: 10px;
              }
        
              .footer {
                clear: both;
                margin-top: 10px;
                text-align: center;
                width: 100%; 
              }
                .footer td,
                .footer p,
                .footer span,
                .footer button {
                  color: #999999;
                  font-size: 12px;
                  text-align: center; 
              }
        
              /* -------------------------------------
                  TYPOGRAPHY
              ------------------------------------- */
              h1,
              h2,
              h3,
              h4 {
                color: #000000;
                font-family: sans-serif;
                font-weight: 400;
                line-height: 1.4;
                margin: 0;
                margin-bottom: 30px; 
              }
        
              h1 {
                font-size: 35px;
                font-weight: 300;
                text-align: center;
                text-transform: capitalize; 
              }
        
              p,
              ul,
              ol {
                font-family: sans-serif;
                font-size: 14px;
                font-weight: normal;
                margin: 0;
                margin-bottom: 15px; 
              }
                p li,
                ul li,
                ol li {
                  list-style-position: inside;
                  margin-left: 5px; 
              }
        
              button {
                color: #3498db;
                text-decoration: underline; 
              }
        
              /* -------------------------------------
                  BUTTONS
              ------------------------------------- */
              .btn {
                box-sizing: border-box;
                width: 100%; }
                .btn > tbody > tr > td {
                  padding-bottom: 15px; }
                .btn table {
                  width: auto; 
              }
                .btn table td {
                  background-color: #ffffff;
                  border-radius: 5px;
                  text-align: center; 
              }
                .btn button {
                  background-color: #ffffff;
                  border: solid 1px #3498db;
                  border-radius: 5px;
                  box-sizing: border-box;
                  color: #3498db;
                  cursor: pointer;
                  display: inline-block;
                  font-size: 14px;
                  font-weight: bold;
                  margin: 0;
                  padding: 12px 25px;
                  text-decoration: none;
                  text-transform: capitalize; 
              }
        
              .btn-primary table td {
                background-color: #3498db; 
              }
        
              .btn-primary button {
                background-color: #3498db;
                border-color: #3498db;
                color: #ffffff; 
              }
        
              /* -------------------------------------
                  OTHER STYLES THAT MIGHT BE USEFUL
              ------------------------------------- */
              .last {
                margin-bottom: 0; 
              }
        
              .first {
                margin-top: 0; 
              }
        
              .align-center {
                text-align: center; 
              }
        
              .align-right {
                text-align: right; 
              }
        
              .align-left {
                text-align: left; 
              }
        
              .clear {
                clear: both; 
              }
        
              .mt0 {
                margin-top: 0; 
              }
        
              .mb0 {
                margin-bottom: 0; 
              }
        
              .preheader {
                color: transparent;
                display: none;
                height: 0;
                max-height: 0;
                max-width: 0;
                opacity: 0;
                overflow: hidden;
                mso-hide: all;
                visibility: hidden;
                width: 0; 
              }
        
              .powered-by button {
                text-decoration: none; 
              }
        
              hr {
                border: 0;
                border-bottom: 1px solid #f6f6f6;
                margin: 20px 0; 
              }
        
              /* -------------------------------------
                  RESPONSIVE AND MOBILE FRIENDLY STYLES
              ------------------------------------- */
              @media only screen and (max-width: 620px) {
                table[class=body] h1 {
                  font-size: 28px !important;
                  margin-bottom: 10px !important; 
                }
                table[class=body] p,
                table[class=body] ul,
                table[class=body] ol,
                table[class=body] td,
                table[class=body] span,
                table[class=body] button {
                  font-size: 16px !important; 
                }
                table[class=body] .wrapper,
                table[class=body] .article {
                  padding: 10px !important; 
                }
                table[class=body] .content {
                  padding: 0 !important; 
                }
                table[class=body] .container {
                  padding: 0 !important;
                  width: 100% !important; 
                }
                table[class=body] .main {
                  border-left-width: 0 !important;
                  border-radius: 0 !important;
                  border-right-width: 0 !important; 
                }
                table[class=body] .btn table {
                  width: 100% !important; 
                }
                table[class=body] .btn button {
                  width: 100% !important; 
                }
                table[class=body] .img-responsive {
                  height: auto !important;
                  max-width: 100% !important;
                  width: auto !important; 
                }
              }
        
              /* -------------------------------------
                  PRESERVE THESE STYLES IN THE HEAD
              ------------------------------------- */
              @media all {
                .ExternalClass {
                  width: 100%; 
                }
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                  line-height: 100%; 
                }
                .apple-link button {
                  color: inherit !important;
                  font-family: inherit !important;
                  font-size: inherit !important;
                  font-weight: inherit !important;
                  line-height: inherit !important;
                  text-decoration: none !important; 
                }
                #MessageViewBody button {
                  color: inherit;
                  text-decoration: none;
                  font-size: inherit;
                  font-family: inherit;
                  font-weight: inherit;
                  line-height: inherit;
                }
                .btn-primary table td:hover {
                  background-color: #34495e !important; 
                }
                .btn-primary a:hover {
                  background-color: #34495e !important;
                  border-color: #34495e !important; 
                } 
              }
        
            </style>
          </head>
          <body class="">
            <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
              <tr>
                <td>&nbsp;</td>
                <td class="container">
                  <div class="content">
        
                    <!-- START CENTERED WHITE CONTAINER -->
                    <table role="presentation" class="main">
        
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                        <td class="wrapper">
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
                                <p>Hi '. $request->f_name ." ". $request->l_name .',</p>
                                <p>Selamat datang di Vokanesia, Edu-tech Vokasi Terbaik di Indonesia.</p>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                  <tbody>
                                    <tr>
                                      <td align="left">
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                          <tbody>
                                            <tr>
                                              <td> <button>'. $randOtp .'</button> </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                                <p>Silahkan masukkan kode diatas sebagai verifikasi anda di Vokanesia.</p>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
        
                    <!-- END MAIN CONTENT AREA -->
                    </table>
                    <!-- END CENTERED WHITE CONTAINER -->
        
                    <!-- START FOOTER -->
                    <div class="footer">
                      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="content-block">
                            <span class="apple-link">Copyright © 2020 Vokanesia. All Right Reserved</span>
                            <br> info lebih lanjut email ke <a href="mailto:halo@vokanesia.id">halo@vokanesia.id</a>.
                          </td>
                        </tr>
                      </table>
                    </div>
                    <!-- END FOOTER -->
        
                  </div>
                </td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </body>
        </html>
        ';
        $recipient = $request->input('email'); //penerima email
        $params = [
        'from_name' => $from_name,
        'from_email' => $from_email,
        'recipient' => $recipient,
        'subject' => $subject,
        'content' => $content,
        'api_token' => $api_token
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('MAILKETING_ENDPOINT', ''));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec ($ch);
        curl_close ($ch);
        return true;
      }catch (Exception $e){
          return false;
      }
  }

  function sendSmsOTP($request, $otp){
    ob_start();
		// setting 
		$apikey      = '6b58a94d445a9f96f14fec2d59b3ba87'; // api key 
		$urlendpoint = 'http://sms114.xyz/sms/api_sms_otp_send_json.php'; // url endpoint api
		$callbackurl = ''; // url callback get status sms 

		// create header json  
		$senddata = array(
			'apikey' => $apikey,  
			'callbackurl' => $callbackurl, 
			'datapacket'=>array()
		);

		// create detail data json 
		// data 1
		$number = '62'. $request->no_hp;
		$message = 'Hi '.$request->f_name.',%0a'.$otp.' adalah kode untuk verifikasi akun Vokanesia.id kamu.%0aDO NOT GIVE IT TO ANYONE';
		array_push($senddata['datapacket'],array(
			'number' => trim($number),
			'message' => $message
		));
		// sending  
		$data=json_encode($senddata);
		$curlHandle = curl_init($urlendpoint);
		curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Content-Length: ' . strlen($data))
		);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
		curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 30);
		$respon = curl_exec($curlHandle);
		curl_close($curlHandle);
		header('Content-Type: application/json');
		return true;
  }
}
