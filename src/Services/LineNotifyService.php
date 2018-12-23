<?php

namespace Royalmar\LineNotify\Services;

use Config;
use Log;

use Royalmar\LineNotify\Contracts\LineNotifySender;

class LineNotifyService implements LineNotifySender
{
    private $isDebug = false;

    /**
    * set debug mode that can save log in file
    * @param boolean $isDebug
    * @return void
    */
    public function setDebugMode($isDebug = false)
    {
        $this->isDebug = $isDebug;
    }

    /**
    * send text message
    * @param string $accessToken
    * @param string $message
    * @return mixed
    */
    public function sendMessage($accessToken = '', $message = '')
    {
        $data = [
            'message' => $message
        ];

        return $this->send($accessToken, $data);
    }

    /**
    * send text message and image
    * @param string $accessToken
    * @param string $message
    * @return mixed
    */
    public function sendMessageAndImage($accessToken = '', $message = '', $image = [])
    {
        $data = [
            'message' => $message,
            'imageThumbnail' => $image['imageThumbnail'],
            'imageFullsize' => $image['imageFullsize']
        ];

        return $this->send($accessToken, $data);
    }

    /**
    * send text message and sticker
    * @param string $accessToken
    * @param string $message
    * @return mixed
    */
    public function sendMessageAndSticker($accessToken = '', $message = '', $sticker = [])
    {
        $data = [
            'message' => $message,
            'stickerPackageId' => $sticker['stickerPackageId'],
            'stickerId' => $sticker['stickerId']
        ];

        return $this->send($accessToken, $data);
    }

    private function send($accessToken, $data)
    {
        if (!$accessToken || !is_string($data['message'])) return null;

        if ($this->isDebug) {
            Log::debug(sprintf("=== 傳送LineNotify通知 : %s ===", $accessToken));
            Log::debug(print_r($data, true));
        }

        return $this->post($accessToken, $data);
    }

    private function post($accessToken, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('LineNotify.api.url'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, config('LineNotify.api_timeout'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $accessToken
            ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($this->isDebug) {
            Log::debug("=== LineNotify通知回傳 ===");
            Log::debug("{$status} {$result}");
        }

        return $result;
    }
}
