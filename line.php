 <?php
  

function send_LINE($msg){
 $access_token = 'AuGyC3yQQYzA8iuoSt0G4epKlpneubvFF++mPezDYcd/poKjxryJbDt/l5J9T8e+d91WZQyS0iKnUcgIrscSaTpUpNouYaY8uJnwf4ocT5BkSNzqmq22/DFkAWmMjdcsa1HfqqTz3YKo9nzIXcMfpAdB04t89/1O/w1cDnyilFU='; 

  $messages = [
        'type' => 'text',
        'text' => $msg
        //'text' => $text
      ];

      // Make a POST Request to Messaging API to reply to sender
      $url = 'https://api.line.me/v2/bot/message/push';
      $data = [

        'to' => 'U632d0e50a728dccdc03cb3d8d45eb170',
        'messages' => [$messages],
      ];
      $post = json_encode($data);
      $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      $result = curl_exec($ch);
      curl_close($ch);

      echo $result . "\r\n"; 
}

?>
