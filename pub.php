<?php

require('vendor/autoload.php');

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

function pubMqtt($topic,$msg){
 
	$server   = 'broker.emqx.io';
	$port     = 1883;
	$clientId = rand(5, 15);
	$clean_session = false;
	$connectionSettings  = new ConnectionSettings();

	$connectionSettings
  	//->setUsername($username)
  	//->setPassword(null)
  	->setKeepAliveInterval(60)
  	//->setLastWillTopic('emqx/test/last-will')
  	->setLastWillMessage('client disconnect')
  	->setLastWillQualityOfService(1);

	$mqtt = new MqttClient($server, $port, $clientId);

	$mqtt->connect($connectionSettings, $clean_session);
	//printf("client connected\n");

	$mqtt->subscribe('test555', function ($topic, $message) {
    	printf("Received message on topic [%s]: %s\n", $topic, $message);
	}, 0);

	for ($i = 0; $i< 10; $i++) {
  		$payload = array(
    		'protocol' => 'tcp',
    		'date' => date('Y-m-d H:i:s'),
    		'url' => 'https://github.com/emqx/MQTT-Client-Examples'
  		);
  		$mqtt->publish(
    		// topic
    		'test555',
    		// payload
    		json_encode($payload),
    		// qos
    		0,
    		// retain
    		true
  		);
  		//printf("msg $i send\n");
  		sleep(1);
 	}
}

function getMqttfromlineMsg($Topic,$lineMsg){
 
    $pos = strpos($lineMsg, ":");
    if($pos){
      $splitMsg = explode(":", $lineMsg);
      $topic = $splitMsg[0];
      $msg = $splitMsg[1];
      pubMqtt($topic,$msg);
    }else{
      $topic = $Topic;
      $msg = $lineMsg;
      pubMqtt($topic,$msg);
    }
  }
?>
