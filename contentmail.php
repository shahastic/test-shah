<?php
session_start();
?>
<?php
    
	$email = $_SESSION['email'];
	$random = rand(0, 1000);
	$api_url = 'http://xkcd.com/' . $random . '/info.0.json';
	// The file_get_contents() reads a file into a string.
	$json_data = file_get_contents($api_url);
	// The json_decode() function is used to decode or convert a JSON object to a PHP object.
	$response_data = json_decode($json_data);
	$to = "$email";
	$name = $response_data->title;
	$subject = "$response_data->title";
	function sendComic( $to, $subject, $message, $attachments = array() ) {
		$headers   = array();
		$headers[] = "To: {$to}";
		$headers[] = 'From: Rahul Kumar <php.sender.mail.xkcd@gmail.com>';
		$headers[] = 'X-Mailer: PHP/' . phpversion();
		$headers[] = 'MIME-Version: 1.0';
	
		if ( ! empty( $attachments )) {
			$boundary  = md5( time() );
			$headers[] = 'Content-type: multipart/mixed;boundary="' . $boundary . '"';
		} else {
			$headers[] = 'Content-type: text/html; charset=UTF-8';
		}
			$output   = array();
			$output[] = '--' . $boundary;
			$output[] = 'Content-type: text/html; charset="utf-8"';
			$output[] = 'Content-Transfer-Encoding: 8bit';
			$output[] = '';
			$output[] = $message;
			$output[] = '';
		foreach ($attachments as $attachment) {
			$output[] = '--' . $boundary;
			$output[] = 'Content-Type: ' . $attachment['type'] . '; name="' . $attachment['name'] . '";';
			if (isset( $attachment['encoding'] )) {
				$output[] = 'Content-Transfer-Encoding: ' . $attachment['encoding'];
			}
			$output[] = 'Content-Disposition: attachment;';
			$output[] = '';
			$output[] = $attachment['data'];
			$output[] = '';
		}
			mail( $to, $subject, implode( "\r\n", $output ), implode( "\r\n", $headers ) );
	}
	// sendComic( $email, $title, $Body, $attachments );
	
	// function sendMail( $to, $subject, $message ) {
	// 	$headers  = 'From: team@xkcd_mailer.com' . "\r\n";
	// 	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	
	// 	mail( $to, $subject, $message, $headers );
	// }
	
	function getComic() {
		$rand_comic = rand(0,1000);
		$url    = 'http://xkcd.com/' . $rand_comic . '/info.0.json';
		$result = json_decode( file_get_contents( $url ), true );
		return $result;
	}
	
	
	$comic = getComic();
		$title = 'Your New Comic : ' . $comic['safe_title'];
		$urlun = "http://localhost/XKCD/unsubscribe.php?email=$email";
		$file         = file_get_contents( $comic['img'] );
		$encoded_file = chunk_split( base64_encode( $file ) ); 
		$attachments[] = array(
			'name'     => $comic['title'] . '.jpg',
			'data'     => $encoded_file,
			'type'     => 'application/pdf',
			'encoding' => 'base64',
		);
			$Body = '
			<p >Hello XKCDian</p>
			Here is your new comic.
			<h3>' . $comic['safe_title'] . "</h3>
			<img src='" . $comic['img'] . "' alt='some comic hehe'/>
			<br />
			To read the comic,  --> <a target='_blank' href='https://xkcd.com/" . $comic['num'] . "'>Click here</a><br /> 
			To Unsubscribe the Xkcd,  --> <a target='_blank' href='".$urlun."'>Click here</a><br /> 
			";
			sendComic( $email, $title, $Body, $attachments );
			header("Location: success.php");
			
?>