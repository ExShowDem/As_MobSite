<?php

function curl_post($path, $form_data=null)
{
  if (is_null($form_data))
  {
    $form_data = [ 'language' => $_SESSION["lang"] ];
  }
  else if (isset($form_data['language']))
  {
  }
  else
  {
    $form_data['language'] = $_SESSION["lang"];
  }

  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL            => $GLOBALS['base_url'] . $path . '.json',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => 1,
    CURLOPT_POSTFIELDS     => $form_data,
  ]);

  if(!$result = curl_exec($curl))
  {
    trigger_error(curl_error($curl)); //@todo Replace with more client friendly "white screen" error message
    return;
  }

  curl_close($curl);

  if (is_string($result))
  {
    $result = json_decode($result);
  }
  if (is_array($result))
  {
    $result = json_decode( json_encode($result) );
  }

  if (!$result->status)
  {
    trigger_error($result->message); //@todo Replace with more client friendly "white screen" error message
    return;
  }
  
  return $result->params;
}
