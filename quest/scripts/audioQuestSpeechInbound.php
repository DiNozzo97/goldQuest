<?php
require 'credentials.php';
$from = $_REQUEST['From'];
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);


if ($stmt = $conn->prepare("SELECT songURL, questNumber FROM users WHERE phoneNumber = ?")) {

    $stmt->bind_param("s", $from);
    /* execute query */
    $stmt->execute();
    /* store result */
    $stmt->store_result();
    // If message is not from Technician
        
        // If it is a technician then store their ID and set verified Tech to true

        /* b else {ind result variables */
        $stmt->bind_result($fetchedSongURL, $fetchedQuestNumber);

        /* fetch values */
        while ($stmt->fetch()) {
            $songURL = $fetchedSongURL;
            $questNumber = $fetchedQuestNumber;

        }
    }

    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

?>

<Response>
<?php
    if ($questNumber != 10) {
        echo "<Say voice=\"alice\">Welcome to GoldQuest, please send a text to enroll and good luck!</Say>";
    } else {
    echo "<Say voice=\"alice\">Please Send a text with the name of the following song</Say>
      

    <Play>$songURL</Play>
";
}?>
</Response>