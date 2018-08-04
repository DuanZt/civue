
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Token extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('user_model');

  }

  // public function authToken($token)
  // {
  //   $res = $this->token_model->authToken($token);
  //   res(200, $res);
  // }


  // public function generateToken($user_id)
  // {
  //   $res = $this->token_model->generateToken($user_id);
  //   res(200, $res);
  // }

  public function refreshToken($token)
  {
    $res = $this->token->refreshToken($token);
    res(200, $res);
  }



}