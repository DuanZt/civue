
<?php 
defined('BASEPATH') or exit('No direct script access allowed');




function res($stateCode, $results = '')
{
  echo json_encode(
    [
      'stateCode' => $stateCode,
      'results' => $results
    ]
  );
}

function auth()
{
  $CI = &get_instance();
  $token = isset($_SERVER['HTTP_X_TOKEN']) ? $_SERVER['HTTP_X_TOKEN'] : '';
  $data = $CI->token->authToken($token);

  if (isset($data['data'])) {
    return $data['data'];
  } else {
    $CI->output->set_status_header(403);
    exit(0);
  }
}


