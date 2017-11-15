<?php

namespace madurmanov\VkApiDriver;

use Yii;
use yii\base\Widget as BaseWidget;
use yii\base\InvalidConfigException;

class VkTokenButton extends BaseWidget
{
  public $moduleName = '';
  public $redirectUrl = '';
  public $ownerId = '';

  public function init()
  {
    parent::init();
    if (!$this->moduleName)
      throw new InvalidConfigException('`moduleName` is not set');
    if (!$this->redirectUrl)
      throw new InvalidConfigException('`redirectUrl` is not set');
    $this->ownerId = Yii::$app->getModule($this->moduleName)->ownerId;
  }

  public function run()
  {
    return $this->render('vk-token-button', [
       'url' => "https://oauth.vk.com/authorize?client_id={$this->ownerId}&display=page&redirect_uri={$this->redirectUrl}&scope=wall&response_type=token"
    ]);
  }
}
