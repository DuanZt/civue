
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('user_model');
  }

  public function login()
  {

    $config = array(
      array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'trim|valid_email|required|max_length[128]',
        'errors' => array(
          'required' => '请输入E-mail',
          'valid_email' => "E-mail格式不正确",
          'max_length' => "E-mail长度太长."
        )
      ),
      array(
        'field' => 'pwd',
        'label' => '密码',
        'rules' => 'trim|max_length[255]|required',
        'errors' => array('required' => '请输入密码!')
      )
    );

    $this->form_validation->set_rules($config);

    if ($this->form_validation->run() === false) {

      res(401, ['validation' => $this->form_validation->error_array()]);

    } else {

      $email = $this->input->post("email");
      $pwd = $this->input->post("pwd");

      $id = $this->user_model->check($email, $pwd);

      if ($id) {
        res(200, $this->token->generateToken($id));
      } else {
        res(401, ['msg' => '账户或密码不正确']);
      }

    }
  }


  public function signup()
  {
    $config = array(
      array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'trim|valid_email|required|is_unique[user.email]|max_length[128]',
        'errors' => array(
          'required' => '请输入E-mail',
          'is_unique' => 'E-mail已存在!',
          'valid_email' => "E-mail格式不正确",
          'max_length' => "E-mail长度太长."
        )
      ),
      array(
        'field' => 'pwd',
        'label' => '密码',
        'rules' => 'trim|min_length[6]|alpha_numeric|required',
        'errors' => array(
          'required' => '请输入密码',
          'min_length' => '密码最短6位. ',
          'alpha_numeric' => "密码只支持数字和字符."
        )
      ),
      array(
        'field' => 'name',
        'label' => 'Name',
        'rules' => 'trim|required|max_length[128]',
        'errors' => array(
          'required' => '请输入用户名',
          'max_length' => "用户名长度太长."
        )
      )
    );

    $this->form_validation->set_rules($config);

    if ($this->form_validation->run() === false) {

      res(401, ['validation' => $this->form_validation->error_array()]);

    } else {
      $email = $this->input->post("email");
      $pwd = $this->input->post("pwd");
      $pwd_repeat = $this->input->post("pwd_repeat");
      $date = date('Y-m-d H:i:s');
      $key = rand(0, 65535);
			//然后把$key存起来，每个用户都不同的 
      $activate = sha1(mt_rand(10000, 99999) . time() . $email);

      $user = array(
        'email' => $email,
        'pwd' => password_hash($pwd, PASSWORD_DEFAULT),
        'secure_key' => $key,
        'phone_number' => $this->input->post("phone_number"),
        'activate' => $activate,
        'active' => 0,
        'date_add' => $date
      );

      $id = $this->user_model->add($user);
      if ($id) {
        res(200, $this->token->generateToken($id));
      } else {
        res(403, ['msg' => '注册失败']);
      }

    }
  }


}