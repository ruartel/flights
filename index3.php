<?php
//curl -v  -X GET "https://api.flightstats.com/flex/flightstatus/rest/v2/json/airport/status/LLBG/dep/2016/03/14/21?appId=dcfa1cf8&appKey=9c1c3b6d6be1c5abb7c52006beedb392&utc=false&numHours=1&maxFlights=50"
$url = "https://api.flightstats.com/flex/flightstatus/rest/v2/json/airport/status/LLBG/dep/2016/03/14/21?appId=dcfa1cf8&appKey=9c1c3b6d6be1c5abb7c52006beedb392&utc=false&numHours=1&maxFlights=50";
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a beauty json :3
var_dump(json_decode($result, true));