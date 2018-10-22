<?PHP
	function sendMessage(){
		$content = array(
			"en" => 'body Message' // Chỉ hiển thị tên App và Body ( không hiển thị title ).
			);
		$headings = array(
			"en" => "Đây là title", //Title Notifications
			"es" => "Đây là Body" //Body Notifications
		);
		$fields = array(
			'app_id' => "3a8c63f4-2176-400d-9d5f-baf6d0bd235a",
			'android_sound' => 'bell', //Âm thanh phát trên Android
			'include_player_ids' => array("f660b202-37c0-4169-b226-270bb4d4f2d8","6e96b56c-5093-4763-9d86-d57153ab64f6"), // Chỉ định id devices cần gửi thông báo ( thay cho token)
			'data' => array("foo" => "bar"),
			'contents' => $content,
			'headings' => $headings
		);
		
		$fields = json_encode($fields);
    	print("\nJSON sent:\n");
    	print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}
	
	$response = sendMessage();
	$return["allresponses"] = $response;
	$return = json_encode( $return);
	
	print("\n\nJSON received:\n");
	print($return);
	print("\n");
?>