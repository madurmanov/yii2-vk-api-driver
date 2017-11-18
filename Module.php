<?php

namespace madurmanov\VkApiDriver;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{
  const API_URL = 'https://api.vk.com/method';

  public $ownerID = 0;
  public $accessToken = '';
  public $lang = 'en';
  public $version = '5.69';

  public function request($method, $type = 'GET', $params = [], $accessToken = false)
  {
    $result = false;
    $params['lang'] = $this->lang;
    if ($accessToken) $params['access_token'] = $this->accessToken;
    $params['v'] = $this->version;
    $url = self::API_URL . "/{$method}";
    switch ($type) {
      case 'GET':
        $url .= "?" . http_build_query($params);
        $result = file_get_contents($url);
        break;
      case 'POST':
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        break;
    }
    return json_decode($result);
  }
}
