<h1>Push Notification to Mobile</h1>

<?php

	//var_dump($_REQUEST);

	$postData = [];
	//$token = "ExponentPushToken[uPHzrXOjWL1eMzsZc5aVPT]";
	$token =$_REQUEST['token'];
	$data = ['title'=>'Panaroma Order Confirmation','body' => 'You order has been confirmed sds ',  "sound"=> "default"];
	
	echo $token.'----'.$_REQUEST['token'];
	
	//foreach ($recipients as $token) {
		$postData[] = $data + ['to' => $token];
	//}

	$ch = $ch ?? curl_init();
	// Set cURL opts
	curl_setopt($ch, CURLOPT_URL,'https://exp.host/--/api/v2/push/send');
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'accept: application/json',
		'content-type: application/json',
	]);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
	
	$response = [
		'body' => curl_exec($ch),
		'status_code' => curl_getinfo($ch, CURLINFO_HTTP_CODE)
	];

	$responseData = json_decode($response['body'], true)['data'] ?? null;
	//var_dump($responseData);


?>



