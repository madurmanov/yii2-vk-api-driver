# yii2-vk-api-driver
Module that enables send request to vk api for Yii Framework 2.0.

## Methods
- wallPost

## Installation
```
composer require madurmanov/yii2-vk-api-driver "@dev"
```

## Configuration
```
'modules' => [
  'VkApiDriver' => [
    'class' => 'madurmanov\VkApiDriver\Module',
    'appId' => 0,
    'ownerId' => 0,
    'ownerIsCommunity' => false,
    'accessToken' => ''
  ]
]
```

## Usage
```
Yii::$app->getModule('VkApiDriver')->request('wall.post', [
  'owner_id' => 0,
  'from_group' => 1,
  'message' => 'message'
], true);
Yii::$app->getModule('VkApiDriver')->wallPost(1, 'message');
```

## License
**yii2-vk-api-driver** is released under the MIT License. See the bundled `LICENSE.md` for details.
