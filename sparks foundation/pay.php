<?php
session_start();

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_756d79af911f930ee41ddb5bfab",
                  "X-Auth-Token:test_536514d9fba06334b546809c331"));
$payload = Array(
    'purpose' => 'Donation',
    'amount' => '500',
    'phone' => '9999999999',
    'buyer_name' => 'Ananya Srivastava',
    'redirect_url' => 'http://localhost/redirect.php/',
    'send_email' => true,
    'send_sms' => true,
    'email' => 'arcsri1995@gmail.com',
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 

$response= json_decode($response);
$_SESSION['TID']=$response->payment_request->id;
header('location:'.$response->payment_request->longurl);
die();
?>
