<?php

namespace Royalmar\LineNotify\Contracts;

interface LineNotifySender
{
	public function setDebugMode($isDebug = false);
    public function sendMessage($accessToken, $message);
}
