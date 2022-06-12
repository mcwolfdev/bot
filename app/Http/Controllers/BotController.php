<?php

namespace App\Http\Controllers;

use WeStacks\TeleBot\TeleBot;
use WeStacks\TeleBot\Exceptions\TeleBotException;
use WeStacks\TeleBot\Objects\Message;
use WeStacks\TeleBot\Objects\MessageId;
use WeStacks\TeleBot\Objects\Poll;
use WeStacks\TeleBot\Objects\User;
use WeStacks\TeleBot\Handlers\CommandHandler;



class BotController extends Controller
{


    public function index() {
        /*$bot = new TeleBot('5584913348:AAFRImMHYLpEig_6v2j2Fs1PtxDnJCFJ-18');

        $message = $bot->sendMessage([
            'chat_id' => 451559836,
            'text' => 'Test message',
            'reply_markup' => [
                'inline_keyboard' => [[[
                    'text' => $text,
                    'url' => 'https://google.com/'
                ]]]
            ]
        ]);*/
    }

}
