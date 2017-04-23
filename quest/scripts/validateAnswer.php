	<?php
	// var_dump($questNumber);
	if ($stmt = $conn->prepare("SELECT answer FROM quests WHERE questNumber = ?")) {

	    $stmt->bind_param("i", $questNumber);
	    /* execute query */
	    $stmt->execute();
	    /* store result */
	    $stmt->store_result();
	    // If message is not from Technician
	   
	 
	        $stmt->bind_result($fetchedAnswer);

	        /* fetch values */
	        while ($stmt->fetch()) {
	            $answer = $fetchedAnswer;
	           
	        }

	    }

	    if (strtolower($answer) == strtolower($content)) {
	    	if ($questNumber < 7) {
	    		$questNumber = $questNumber + 1;
	    	

	    	$stmt = $conn->prepare("UPDATE users SET questNumber=? WHERE phoneNumber=?");
			$stmt->bind_param("is", $questNumber, $from);

			$stmt->execute();
			$stmt->close();
	if (!isset($response))
		$response = new Services_Twilio_Twiml();
			$response->sms("Correct !");
			include('newQuest.php');
			exit();
		} else {
			$stmt = $conn->prepare("UPDATE users SET questNumber=10 WHERE phoneNumber=?");
			$stmt->bind_param("s", $from);

			$stmt->execute();
			$stmt->close();
			include 'audioQuestLauncher.php';
		
			if (!isset($response))
				$response = new Services_Twilio_Twiml();
			$response->sms("... Pick up your phone! (if you miss the call, just ring back!)");
			echo $response;
			exit();
		}

	    }
	    else
	    {
	   if (!isset($response))
		$response = new Services_Twilio_Twiml();
			$response->sms("Wrong answer !");
			echo $response;
			exit();



	    }