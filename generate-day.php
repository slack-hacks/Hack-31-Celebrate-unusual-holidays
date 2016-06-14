<?php
	// Include the days
	$days = include './days.php';

	// Your webhook URL
	$webhook = '[WEBHOOK URL]';

	// Get todays date
	$today = new DateTime();

	// Get the special day!
	$day = $days[$today->format('m')][$today->format('d')];

	// If today has a value
	if(count($day) > 0) {

		// Encode the data
		$data = 'payload=' . json_encode(array(
			'username' => 'What "national" day is it today?',
			'icon_emoji' => ':rosette:',

			'text' => $day,
		));

		// PHP cURL POST request
		$ch = curl_init($webhook);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
	}