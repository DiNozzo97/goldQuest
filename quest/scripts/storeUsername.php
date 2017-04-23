<?php

$stmt = $conn->prepare("UPDATE users SET userName=?, timeStart=CURRENT_TIMESTAMP WHERE phoneNumber=?");
$stmt->bind_param("ss", $content, $from);

$stmt->execute();
$stmt->close();

$response = new Services_Twilio_Twiml();
$response->sms("Hello $content . Welcome to GoldQuest !");
// echo $response;

include 'newQuest.php';
exit();