# yii2-vk-api-driver
Module that enables send request to vk api for Yii Framework 2.0.

## Installation
```
composer require madurmanov/yii2-vk-api-driver "@dev"
```

## AccessToken
- Create standalone app [https://vk.com/apps](https://vk.com/apps)
- Execute next code with entered `clientID` parameter in module configuration
```
$VkApiDriver = Yii::$app->getModule('VkApiDriver');
var_dump($VkApiDriver->getAccessTokenUrl(['wall']));
```
- Follow to link and get access token for configurate

## Configuration
```
'modules' => [
  'VkApiDriver' => [
    'class' => 'madurmanov\VkApiDriver\Module',
    'clientID' => 0,
    'ownerID' => 0,
    'accessToken' => ''
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
