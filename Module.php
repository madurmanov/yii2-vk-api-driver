<?php

namespace madurmanov\VkApiDriver;

use Yii;
use yii\base\Module as BaseModule;
use yii\base\InvalidConfigException;
use madurmanov\VkApiDriver\Widget;

class Module extends BaseModule
{
  const API = 'https://api.vk.com/method/';

  public $appId = 0;
  public $ownerId = 0;
  public $accessToken = '';

  public function init()
  {
    if (!$this->appId)
      throw new InvalidConfigException('`appId` is not set');
    if (!$this->ownerId)
      throw new InvalidConfigException('`ownerId` is not set');
    if (!$this->accessToken)
      throw new InvalidConfigException('`accessToken` is not set');
  }

  public function getVkTokenButton()
  {
    return Widget::widget([
      'appId' => $this->appId
    ]);
  }

  public function request($method, $params)
  {
    $query = http_build_query($params);
    $url = self::API . "$method?$query";
    return json_decode(file_get_contents($url));
  }

  public function wallPost($message = '', $attachments = '')
  {
    $params = [
      'owner_id' => "-{$this->ownerId}",
      'access_token' => $this->accessToken,
      'from_group' => 1
    ];
    if ($message) $params['message'] = $message;
    if ($attachments) $params['attachments'] = $attachments;
    return $this->request('wall.post', $params);
  }
}
