<?php

$consumer_key = 'xljjXFe0FRfKELHprHudBX7vX';
$consumer_secret = 'E2kIZCsyt3jKBDsmUA2a96KgB4x1tZMxJQ0MsTC60BQ5geogy7';
$access_token = '1333660253401927685-gwGkM9vDWwHPTFmtgAu66nTKdscGKv';
$access_token_secret = '0b1sDC0g7mEv3vxtFYErr8I9mMBIywds8QhKQQJRbd3cn';

require "twitterauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
$content = $connection->get("account/verify_credentials");

$tweets = $connection->get("statuses/home_timeline",["count" => 10, "exclude_replies"=> true])

 ?>
