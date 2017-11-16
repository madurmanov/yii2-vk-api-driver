<?php

namespace madurmanov\VkApiDriver;

use yii\base\Module as BaseModule;
use madurmanov\VkApiDriver\Widget;

class Module extends BaseModule
{
  const API = 'https://api.vk.com';

  public $appId = 0;
  public $ownerId = 0;
  public $ownerIsCommunity = false;
  public $accessToken = '';

  public function getAccessTokenButton()
  {
    return Widget::widget([
      'appId' => $this->appId
    ]);
  }

  public function request($method, $params, $accessToken = false)
  {
    if ($accessToken) $params['access_token'] = $this->accessToken;
    $url = self::API . "/method/{$method}?" . http_build_query($params);
    return json_decode(file_get_contents($url));
  }

  public function wallPost($fromGroup = 1, $message = '', $attachments = '')
  {
    $params = [
      'owner_id' => ($this->ownerIsCommunity ? '-' : '') . $this->ownerId,
      'from_group' => $fromGroup
    ];
    if ($message) $params['message'] = $message;
    if ($attachments) $params['attachments'] = $attachments;
    return $this->request('wall.post', $params, true);
  }
}
