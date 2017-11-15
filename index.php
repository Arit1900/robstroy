<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
$channel_token =
'1caj07yURrrjtw3H9hzJ+bWYo+rsam3iGzbrYrrRhjH7zZqHuz3Dujm0jtJsVTThFpev/g0oK8CZYAON18xdMenFO+a02ALh4r2OlXPFyPsBscfr7b4IZwNoBOVLfS6RUA70p2pIWk3dpq+U8aHwtQdB04t89/1O/w1cDnyilFU=';
$channel_secret = '5e8d1f791608a58b43c5bd31c986d955';
// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);
if (!is_null($events['events'])) {
// Loop through each event
foreach ($events['events'] as $event) {
// Line API send a lot of event type, we interested in message only.
if ($event['type'] == 'message') {
switch($event['message']['type']) {
case 'text':
// Get replyToken
$replyToken = $event['replyToken'];
// Reply message
$respMessage = 'Hello, your message is '. $event['message']['text'];
$httpClient = new CurlHTTPClient($channel_token);
$bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
$textMessageBuilder = new TextMessageBuilder($respMessage);
$response = $bot->replyMessage($replyToken, $textMessageBuilder);
break;
}
}
}
}
echo "OK";