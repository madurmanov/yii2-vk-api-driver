# yii2-vk-api-driver
Module that enables send request to vk api for Yii Framework 2.0.

## Installation
```
composer require madurmanov/yii2-vk-api-driver "@dev"
```

## Configuration
```
'modules' => [
  'VkApiDriver' => [
    'class' => 'madurmanov\VkApiDriver\Module',
    'ownerID' => 0,
    'accessToken' => '',
    'lang' => 'en',
    'version' => '5.69'
  ]
]
```

## Usage
```
$VkApiDriver = Yii::$app->getModule('VkApiDriver');
$VkApiDriver->request('wall.post', 'GET', [
  'owner_id' => $VkApiDriver->ownerID,
  'from_group' => 0,
  'message' => ''
], true);
```

## License
**yii2-vk-api-driver** is released under the MIT License. See the bundled `LICENSE.md` for details.
