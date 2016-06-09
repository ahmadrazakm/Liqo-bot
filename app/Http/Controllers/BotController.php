<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Telegram;

class BotController extends Controller
{
    public function me()
    {
        $response = Telegram::getMe();

        $botId = $response->getId();
        $firstName = $response->getFirstName();
        $username = $response->getUsername();

        var_dump($botId);
        var_dump($firstName);
        var_dump($username);
    }

    public function setWebhook()
    {
        $response = Telegram::setWebhook(['url' => 'https://liqo-bot.herokuapp.com/<token>/webhook']);
        var_dump($response);
    }
}
