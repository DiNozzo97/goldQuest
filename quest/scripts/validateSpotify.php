<?php
	  if ($stmt = $conn->prepare("SELECT songName FROM users WHERE phoneNumber = ?")) {

            $stmt->bind_param("s", $from);
            /* execute query */
            $stmt->execute();
            /* store result */
            $stmt->store_result();
            // If message is not from Technician
                
                // If it is a technician then store their ID and set verified Tech to true

                /* b else {ind result variables */
                $stmt->bind_result($fetchedName);

                /* fetch values */
                while ($stmt->fetch()) {
                    $songName = $fetchedName;

                }
}

if (strtolower($content) == strtolower($songName)) {

		$stmt = $conn->prepare("UPDATE users SET completed=1, timeEnd=CURRENT_TIMESTAMP, totalTime= TIMESTAMPDIFF(SECOND, timeStart, timeEnd) WHERE phoneNumber=?");
		$stmt->bind_param("s", $from);

		$stmt->execute();
		$stmt->close();
		if (!isset($response))
			$response = new Services_Twilio_Twiml();
		$response->sms("Correct! Congratulations on completing the quest, checkout the leaderboard at https://goo.gl/A8oFXv");
		echo $response;
		exit();
	} else {
		if (!isset($response))
			$response = new Services_Twilio_Twiml();
		$response->sms("Wrong Answer! - call this number to have another listen!");
		echo $response;
		exit();
	}