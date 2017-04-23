<?php

$response = new Services_Twilio_Twiml();
$response->sms("Sorry, You have already completed the Quest!");
echo $response;
$stmt->close();
$conn->close();
exit();

