<?php
require 'credentials.php';
$from = $_REQUEST['Called'];
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);


if ($stmt = $conn->prepare("SELECT songURL FROM users WHERE phoneNumber = ?")) {

    $stmt->bind_param("s", $from);
    /* execute query */
    $stmt->execute();
    /* store result */
    $stmt->store_result();
    // If message is not from Technician
        
        // If it is a technician then store their ID and set verified Tech to true

        /* b else {ind result variables */
        $stmt->bind_result($fetchedSongURL);

        /* fetch values */
        while ($stmt->fetch()) {
            $songURL = $fetchedSongURL;
            // $songURL = "http://demo.twilio.com/hellomonkey/monkey.mp3";

        }
    }

    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Say voice="alice">Please Send a text with the name of the following song</Say>
    <Play><?= $songURL; ?></Play>

</Response>