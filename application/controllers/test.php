
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('user_model');

  }

  public function test($token)
  {
    $res = $this->token->refreshToken($token);
    res(200, $res);
  }

}