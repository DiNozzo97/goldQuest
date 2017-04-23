 <?php
require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    '*******************************',
    '*******************************',
    'http://www.google.com'
);

$api = new SpotifyWebAPI\SpotifyWebAPI();

$session->requestCredentialsToken();
$accessToken = $session->getAccessToken();

// Set the code on the API wrapper
$api->setAccessToken($accessToken);

// The API can now be used!

$playlistTracks = $api->getUserPlaylistTracks('spotify', '4TNBeyX7awz89qwtTmh9D4');

$trackArray = [];

foreach ($playlistTracks->items as $track) {
    $track = (array)$track->track;
    // array_push($trackArray, ["$track->name"=>"$track->preview_url"]);
    array_push($trackArray, [$track['name'], $track['preview_url']]);


    // echo '<a href="' . $track['preview_url'] . '">' . $track['name'] . '</a> <br>';
}

$finalArray = [];
for ($i=0; $i < count($trackArray); $i++) { 
	if (!preg_match('/[\'^£$%&*()}{@#~?>.<>,|=_+¬-]/', $trackArray[$i][0])) {
		array_push($finalArray, $trackArray[$i]);
	}
}

$rand_key = array_rand($finalArray, 1);


$songName = $finalArray[$rand_key][0];
$songURL = $finalArray[$rand_key][1];



$stmt = $conn->prepare("INSERT INTO users (phoneNumber, songName, songURL) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $from, $songName, $songURL);

//execute
$stmt->execute();
$stmt->close();
$conn->close();

$response = new Services_Twilio_Twiml();
$response->sms("Please respond to this message with your desired username (for scoring).");
echo $response;
exit();