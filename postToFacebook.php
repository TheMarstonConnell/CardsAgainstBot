<html>
    
<?php
   
  
    
    
    
    $fd2 = fopen ("https://cardsagainstrobot.000webhostapp.com/CardsAgainst/blackCards.txt", "r"); 
while (!feof ($fd2)) 
{ 
   $buffer = fgets($fd2, 4096); 
   $blacklines[] = $buffer; 
} 
    $black = "";
    while($black == ""){
        $black = $blacklines[rand(0, count($blacklines))];
    }
    
fclose ($fd2); 
    
    //counts spaces
    $black = str_replace("_____________", "~", $black);
    $black = str_replace("____________", "~", $black);
    $black = str_replace("___________", "~", $black);
    $black = str_replace("__________", "~", $black);
    $black = str_replace("_________", "~", $black);
    $black = str_replace("_______", "~", $black);
    $black = str_replace("______", "~", $black);
    $black = str_replace("_____", "~", $black);
    $black = str_replace("____", "~", $black);
    $black = str_replace("___", "~", $black);
    
    
    $blackLength = strlen($black);
    
    
    $counter = 0;
		for ( $x = 0; $x < ($blackLength) ; $x++ ) {
		    if( $black{$x} == '~' ) {
		        $counter++;
                
		    } 
		}
    
    //ends counting spaces
    $message = $black;
    
  $fd = fopen ("https://cardsagainstrobot.000webhostapp.com/CardsAgainst/whiteCards.txt", "r"); 
while (!feof ($fd)) 
{ 
   $buffer = fgets($fd, 4096); 
   $whitelines[] = $buffer; 
} 
    $white = $whitelines[rand(0, count($whitelines))];
    
    
    
fclose ($fd); 

    //prints a white card for each space
    //$from = '~';
    //$from = '/'.preg_quote($from, '').'/';
    
    
    
    if ($counter > 0){
        for($x = 0; $x < ($counter); $x++){
            $message = preg_replace('/~/', trim(trim(($whitelines[rand(0, count($whitelines))])), "."), $message, 1);
           // $message = str_replace('~', ($whitelines[rand(0, count($whitelines))]), $message, 1);
           // preg_replace($from, ($whitelines[rand(0, count($whitelines))]), $message, 1);
           // $message = $message . ($whitelines[rand(0, count($whitelines))]);
        }
    }else{
       $message = $message . ($whitelines[rand(0, count($whitelines))]);
    }
    
    echo $message;
   
    
    include("/storage/ssd4/428/3470428/public_html/CardsAgainst/FacebookAPI/src/Facebook/autoload.php");
    
    
    $fb = new Facebook\Facebook([
  'app_id' => '{APP_ID}',
  'app_secret' => '{APP_SECRET}',
  'default_graph_version' => 'v2.10',
  ]);

$postData = [
  'message' => htmlentities($message, ENT_NOQUOTES, "UTF-8"),
  ];

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->post('/me/feed', $postData, '{ACCESS_KEY}');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$graphNode = $response->getGraphNode();

echo 'Posted with id: ' . $graphNode['id'];
    
    
?>

    
    
    
</html>
