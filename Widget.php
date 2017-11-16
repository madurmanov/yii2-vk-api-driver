<?php

namespace madurmanov\VkApiDriver;

use yii\base\Widget as BaseWidget;
use yii\base\InvalidConfigException;

class Widget extends BaseWidget
{
  public $appId = 0;

  public function run()
  {
    return $this->render('vk-token-button', [
       'url' => "https://oauth.vk.com/authorize?client_id={$this->appId}&display=page&redirect_uri=https://oauth.vk.com/blank.html&scope=wall,offline&response_type=token"
    ]);
  }
}
