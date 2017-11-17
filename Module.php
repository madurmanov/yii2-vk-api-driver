<?php

namespace madurmanov\VkApiDriver;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{
  const API_URL = 'https://api.vk.com/method';
  const OAUTH_BLANK_URL = 'https://oauth.vk.com/blank.html';
  const OAUTH_AUTHORIZE_URL = 'https://oauth.vk.com/authorize';

  public $clientID = 0;
  public $ownerID = 0;
  public $scope = [];
  public $accessToken = '';
  public $lang = 'en';
  public $version = '5.69';

  public function init()
  {
    $this->scope[] = 'offline';
  }

  public function request($method, $type = 'GET', $params = [], $accessToken = false)
  {
    $result = '';
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

  public function getAccessTokenUrl($callback = self::OAUTH_BLANK_URL)
  {
    return self::OAUTH_AUTHORIZE_URL
      . '?' . http_build_query([
        'client_id' => $this->clientID,
        'display' => 'page',
        'redirect_uri' => $callback,
        'scope' => implode(',', $this->scope),
        'response_type' => 'token'
      ]);
  }
}
