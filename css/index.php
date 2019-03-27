<?php
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'key: mMAnvMIaP7zPHnF7hBi23ebGyIU6sp2eWRfdi08yNWOo8wRXPAWgCol'; // // Replace key value for API key OpenCart (Only numbers and letters)

$data = [ 
			'name' => 'WallaTest', 
			'image' => 'http://images.tcdn.com.br/img/img_prod/494337/penka_cover_gugu_82_1_20180109114439.jpg', 
			'sort_order' => '0'
		];

$ch = curl_init();
curl_setopt_array($ch, [
	CURLOPT_URL            => 'http://localhost/syswallababie/api.php/syw_manufacturer/', // Replace domain and table name
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_CUSTOMREQUEST  => 'POST',
        CURLOPT_POSTFIELDS     => json_encode($data),
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false
]);
$out = curl_exec($ch);
curl_close($ch);
print_r( $out ); // Result json