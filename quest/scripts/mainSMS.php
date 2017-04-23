            <?php
            include('../twilio-php/Services/Twilio.php');


            /* Read the contents of the 'Body' field of the Request. */
            require 'credentials.php';

            $client = new Services_Twilio($AccountSid, $AuthToken);

            $from = $_REQUEST['From'];
            $content = $_REQUEST['Body'];

            $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

                

            if ($stmt = $conn->prepare("SELECT userName, completed, questNumber FROM users WHERE phoneNumber = ?")) {

                $stmt->bind_param("s", $from);
                /* execute query */
                $stmt->execute();
                /* store result */
                $stmt->store_result();
                // If message is not from Technician
                if (($stmt->num_rows) == 1) {
                    
                    // If it is a technician then store their ID and set verified Tech to true

                    /* b else {ind result variables */
                    $stmt->bind_result($fetchedUserName, $fetchedCompleted, $fetchedQuestNumber);

                    /* fetch values */
                    while ($stmt->fetch()) {
                        $userName = $fetchedUserName;
                        $completed = $fetchedCompleted;
                        $questNumber = $fetchedQuestNumber;

                    }



                    if ($userName == "") {
                        include 'storeUsername.php';
                    }
                    if ($completed == 1) {
                        include 'alreadyFinished.php';
                    } 
                    if ($questNumber == 10) {
                        include 'validateSpotify.php';
                    } 
                    else {
                        include 'validateAnswer.php';
                    }

                } else {
                    include 'register.php';

                }
            }








