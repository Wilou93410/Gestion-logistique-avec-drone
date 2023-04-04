<?php


$sessionId = session_id();


if(isset($_POST['submit'])) {
 
  $url = 'http://localhost:3000/runscript';
  $data = array('sessionId' => $sessionId);

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data),
    ),
  );

  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  
  header('Location: http://localhost:3000/drone-control%27');
  exit();
}

?>
 <LINK href="../../../style/style.css" rel="stylesheet" type="text/css">
<div class="deco">
<button onclick="window.location.href = '../user.php';">retour</button>
</div>