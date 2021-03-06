<?php


use \Firebase\JWT\JWT;

class Token_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }


  public function authToken($token)
  {
    $key = 'duan'; //key要和签发的时候一样

    $jwt = $token; //签发的Token
    try {
        //  JWT::$leeway = 60;//当前时间减去60，把时间留点余地. 验证两端有可能出现的时间偏差。
      JWT::$leeway = 60;//当前时间减去60，把时间留点余地. 验证两端有可能出现的时间偏差。
      $decoded = JWT::decode($jwt, $key, ['HS256']); //HS256方式，这里要和签发的时候对应
      $res = (array)$decoded;
    } catch (\Firebase\JWT\SignatureInvalidException $e) {  //签名不正确
      $res = $e->getMessage();
    } catch (\Firebase\JWT\BeforeValidException $e) {  // 签名在某个时间点之后才能用
      $res = $e->getMessage();
    } catch (\Firebase\JWT\ExpiredException $e) {  // token过期
      $res = $e->getMessage();
    } catch (Exception $e) {  //其他错误
      $res = $e->getMessage();
    }

    return $res;
    //Firebase定义了多个 throw new，我们可以捕获多个catch来定义问题，catch加入自己的业务，比如token过期可以用当前Token刷新一个新Token
  }

  public function refreshToekn($token)
  {
    $key = 'duan'; //key要和签发的时候一样

    $jwt = $token; //签发的Token
    try {
        //  JWT::$leeway = 60;//当前时间减去60，把时间留点余地. 验证两端有可能出现的时间偏差。
      JWT::$leeway = 60;//当前时间减去60，把时间留点余地. 验证两端有可能出现的时间偏差。
      $decoded = JWT::decode($jwt, $key, ['HS256']); //HS256方式，这里要和签发的时候对应
      if ($decoded->scopes === 'role_refresh') {
        $user_id = $decoded->data->userid;
        $res = $this->generateAccessToken($user_id);
      } else {
        $res = "Please use refresh token.";
      }

    } catch (\Firebase\JWT\SignatureInvalidException $e) {  //签名不正确
      $res = $e->getMessage();
    } catch (\Firebase\JWT\BeforeValidException $e) {  // 签名在某个时间点之后才能用
      $res = $e->getMessage();
    } catch (\Firebase\JWT\ExpiredException $e) {  // token过期
      $res = $e->getMessage();
    } catch (Exception $e) {  //其他错误
      $res = $e->getMessage();
    }

    return $res;
  }

  public function generateToken($user_id)
  {
    $key = 'duan'; //key
    $time = time(); //当前时间
  
      //公用信息
    $token = [
    #  'iss' => 'http://www.helloweba.net', //签发者 可选
      'iat' => $time, //签发时间
      'data' => [ //自定义信息，不要定义敏感信息
        'userid' => $user_id,
      ]
    ];

    $access_token = $token;
    $access_token['scopes'] = 'role_access'; //token标识，请求接口的token
      //$access_token['exp'] = $time+10; //access_token过期时间,这里设置2个小时
    $access_token['exp'] = $time + 7200; //access_token过期时间,这里设置2个小时

    $refresh_token = $token; //生成一个不会刷新的token，来请求生成新的access_token,以供调用接口，refresh_token过期后需要用户重新登录
    $refresh_token['scopes'] = 'role_refresh'; //token标识，刷新access_token
      //$refresh_token['exp'] = $time+10; //access_token过期时间,这里设置30天
    $refresh_token['exp'] = $time + (86400 * 30); //access_token过期时间,这里设置30天

    $jsonList = [
      'access_token' => JWT::encode($access_token, $key),
      'refresh_token' => JWT::encode($refresh_token, $key),
      'token_type' => 'bearer' //token_type：表示令牌类型，该值大小写不敏感，这里用bearer
    ];

    return $jsonList; //返回给客户端token信息
  }



  public function generateAccessToken($user_id)
  {
    $key = 'duan'; //key
    $time = time(); //当前时间
  
      //公用信息
    $token = [
    #  'iss' => 'http://www.helloweba.net', //签发者 可选
      'iat' => $time, //签发时间
      'data' => [ //自定义信息，不要定义敏感信息
        'userid' => $user_id,
      ]
    ];

    $access_token = $token;
    $access_token['scopes'] = 'role_access'; //token标识，请求接口的token
      //$access_token['exp'] = $time+10; //access_token过期时间,这里设置2个小时
    $access_token['exp'] = $time + 7200; //access_token过期时间,这里设置2个小时

    $jsonList = [
      'access_token' => JWT::encode($access_token, $key),
      'token_type' => 'bearer' //token_type：表示令牌类型，该值大小写不敏感，这里用bearer
    ];

    return $jsonList; //返回给客户端token信息
  }




}