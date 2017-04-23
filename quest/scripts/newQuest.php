<?php
// var_dump($questNumber);
if ($stmt = $conn->prepare("SELECT question FROM quests WHERE questNumber = ?")) {

    $stmt->bind_param("i", $questNumber);
    /* execute query */
    $stmt->execute();
    /* store result */
    $stmt->store_result();
    // If message is not from Technician
   
 
        $stmt->bind_result($fetchedQuestion);

        /* fetch values */
        while ($stmt->fetch()) {
            $question = $fetchedQuestion;
           
        }

    }

if (!isset($response))
	$response = new Services_Twilio_Twiml();

$response->sms("New Quest: $question");
echo $response;
exit();