
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
  $token = isset($_SERVER['Authorization']) ? $_SERVER['Authorization'] : '';
  $data = $CI->token->authToken($token);

  if (property_exists($data, 'data')) {
    return $data->data;
  } else {
    $CI->output->set_status_header(403);
    exit(0);
  }
}


