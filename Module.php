<?php

namespace madurmanov\VkApiDriver;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{
  const API_URL = 'https://api.vk.com/method';
  const OAUTH_BLANK_URL = 'https://oauth.vk.com/blank.html';
  const OAUTH_AUTHORIZE_URL = 'https://oauth.vk.com/authorize';

  public $clientId = 0;
  public $ownerId = 0;
  public $scope = [];
  public $accessToken = '';
  public $lang = 'en';
  public $version = '5.69';

  public function init()
  {
    $this->scope[] = 'offline';
  }

  public function request($method, $params = [], $accessToken = false)
  {
    $params['lang'] = $this->lang;
    if ($accessToken) $params['access_token'] = $this->accessToken;
    $params['v'] = $this->version;
    $url = self::API_URL . "/{$method}?" . http_build_query($params);
    return json_decode(file_get_contents($url));
  }

  public function getAccessTokenUrl($callback = self::OAUTH_BLANK_URL)
  {
    return self::OAUTH_AUTHORIZE_URL
      . '?' . http_build_query([
        'client_id' => $this->clientId,
        'display' => 'page',
        'redirect_uri' => $callback,
        'scope' => implode(',', $this->scope),
        'response_type' => 'token'
      ]);
  }
}
