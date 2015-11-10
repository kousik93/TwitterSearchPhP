<?php
//Copyright Kousik Sundar

//UnComment the next line to show errors instead of 500 Server Error
//ini_set('display_errors', '1');

//Include the Twitter Api Wrapper Library
require_once('TwitterAPIExchange.php');


//Create the search box
	echo "<form method=post action=twittersearch.php>"."<input type=text name=searchterm>"."<input type=submit name=UpdateContact value=Update>".
		"</form>";

//Set Your twitter authentication keys (All 4)
	$settings = array(
    		'oauth_access_token' => "",
    		'oauth_access_token_secret' => "",
    		'consumer_key' => "",
    		'consumer_secret' => ""
);


//If Post request exists
if(isset($_POST['searchterm'])){
	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$getfield = '?q='.$_POST['searchterm'];
	$requestMethod = 'GET';


	$twitter = new TwitterAPIExchange($settings);
	$response = $twitter->setGetfield($getfield)
    		->buildOauth($url, $requestMethod)
    		->performRequest();

	$result=json_decode($response); //Get JSON
	

//Print Final Result
for ($i=0; $i<count($result->statuses); $i++){
echo "<hr><br><hr>";
echo "<img src=\"".$result->statuses[$i]->user->profile_image_url."\">";
echo $result->statuses[$i]->user->name."<br>";
echo $result->statuses[$i]->text;
echo "<br>";
};
}

?>
