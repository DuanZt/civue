
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  private $id;

  public function __construct()
  {
    parent::__construct();

    $this->load->model('user_model');
    $data = auth();
    $this->id = $data->userid;
  }

  public function view($id)
  {
    res(200, $id);
  }

  public function userInfo($id)
  {
    $user = $this->user_model->get($id);
    if ($user) {
      res(200, $user);
    } else {
      res(404, ['msg', "用户不存在"]);
    }
  }


}