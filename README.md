# Laravel Line Notify
在Laravel實作Line Notify (Notification) 套件

## How to install
```
composer require royalmar/laravel-line-notify
```

## Laravel Setup

Add the service provider to config/app.php:
```
'providers' => [
    ...
    Royalmar\LineNotify\Providers\LineNotifyServiceProvider::class,
    ...
```

Add alias to config/app.php:
```
'aliases' => [
    ...
    'LineNotify' => Royalmar\LineNotify\Facades\LineNotify::class,
    ...
```


## Use custom config
```bash
php artisan vendor:publish --tag="line_notify_install"
```


## Usage

### Send text message
```php
LineNotify::sendMessage('{accessToken}', 'test massage');
```

### Send text message and image
```php
LineNotify::sendMessageAndImage('{accessToken}', 'test massage', [
            'imageThumbnail' => 'https://asnanak.net/site/wp-content/uploads/2012/10/source_27_waves_dark_green-240x240.jpg',
            'imageFullsize' => 'https://asnanak.net/site/wp-content/uploads/2012/10/source_27_waves_dark_green-1024x768.jpg'
        ]);
```

### send text message and sticker
```php
LineNotify::sendMessageAndSticker('{accessToken}', 'test massage', [
            'stickerPackageId' => 1,
            'stickerId' => 10
        ]);
```
Limitations are identical to Business Connect API
ref: [https://developers.line.me/businessconnect/api-reference#sending_message](https://developers.line.me/businessconnect/api-reference#sending_message)
