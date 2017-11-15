<?php

namespace madurmanov\VkApiDriver;

use Yii;
use yii\base\Widget as BaseWidget;
use yii\base\InvalidConfigException;

class Widget extends BaseWidget
{
  public $appId = 0;

  public function init()
  {
    parent::init();
    if (!$this->appId)
      throw new InvalidConfigException('`appId` is not set');
  }

  public function run()
  {
    return $this->render('vk-token-button', [
       'url' => "https://oauth.vk.com/authorize?client_id={$this->appId}&display=page&redirect_uri=https://oauth.vk.com/blank.html&scope=wall&response_type=token"
    ]);
  }
}
