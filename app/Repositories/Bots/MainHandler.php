<?php

namespace App\Repositories\Bots;

use App\Http\Controllers\HomeController;
use App\Models\BotAdmin;
use App\Models\TextAnswer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use WeStacks\TeleBot\Interfaces\UpdateHandler;
use WeStacks\TeleBot\Objects\Update;
use WeStacks\TeleBot\TeleBot;
use App\Models\Debug;


class MainHandler extends UpdateHandler
{
    protected $name = "start";
    protected $description = "Lets you get started";

    public static function trigger(Update $update, TeleBot $bot): bool
    {
        //return true;
        return $update->message->text ?? null === 'message';
    }

    public function handle()
    {

        $UserName = $this->update->user()->first_name;
        $emojie = "\u{1F600}";
        $emojie2 = "\u{1F614}";

        $my_var = $this->update;
        $debug = var_export($my_var, true);
        Debug::create([
            'Data' => $debug
        ]);

        $this->sendChatAction([
            'action' => 'typing'
        ]);


        //$response = new \stdClass();
        //$response->text = 'ШАЛОМ '.$emojie.' '.$UserName;

        $Tele_id = $this->update->user()->id;
        $mytext = $this->update->message->text;
        $piecesauth = explode(" ", $mytext);

        $subtext = substr($mytext, 0, 5);  // /auth
        //$useradmin = BotAdmin::where('role', 'User')->first();
        $useradmin = BotAdmin::all('id', 'role', 'tele_id');

        foreach ($useradmin as $roles) {
            $ResBotUserId = $roles->id;
            $ResBotUserRole = $roles->role;
            $ResBotUserTele_id = $roles->tele_id;
            //$ResBotUserTele_id  = $roles->tele_id;
            //HomeController::messagesend($ResponseBotUser);
        }

        // login admin
        if ($ResBotUserRole == 'User' && $piecesauth[0] == '/auth') {

            //$param = str_replace('/auth ', '', $mytext);

            // login admin
            $pieces = explode(" ", $mytext);
            //echo $pieces[0]; // login
            //echo $pieces[1]; // pass

            $user_db = (User::where('name', $pieces[1])->first());
            if ($user_db == null) {
                HomeController::messagesend('Пользователь ' . $pieces[1] . ' не найден', $Tele_id);
                return;
            }

            if (Hash::check($pieces[2], $user_db->password))
                echo 'pass is good';
            else {
                HomeController::messagesend('Неправильний пароль', $Tele_id);
                return;
            }

            $writeUser = BotAdmin::find($ResBotUserId);
            $writeUser->update([
                'name' => $this->update->user()->first_name,
                'tele_id' => $this->update->user()->id,
                'role' => 'Admin',
            ]);

            if ($user_db->name == $pieces[1] && Hash::check($pieces[2], $user_db->password)) {
                HomeController::messagesend('Привет ' . $user_db->name . ' вы вошли в админ режим', $Tele_id);
                HomeController::messagesend('Доступные команды: ' . "\n" . '/edit пример: /edit 8:text question:text id, вопрос и ответ разделяется двоеточием' . "\n" . '/delete пример /delete 2' . "\n" . '/create пример: /create text question:text вопрос и ответ разделяется двоеточием, если не задать параметры тогда ответ - вопрос будут созданы автоматически' . "\n" . '/list показать весь список команд' . "\n" . '/logout - выход из режима админ', $Tele_id);
            }

            return;
        }


        if ($mytext == '/logout' && $ResBotUserRole == 'Admin') {
            $writeUser = BotAdmin::find($ResBotUserId);
            $writeUser->update([
                'name' => '',
                'tele_id' => '0', //451559836
                'role' => 'User',
            ]);
            $auth=false;
            HomeController::messagesend($UserName . ' вы вышли из режима админ', $Tele_id);
        }

        if ($mytext == '/auth force') {
            $writeUser = BotAdmin::find(1);
            $writeUser->update([
                'name' => $this->update->user()->first_name,
                'tele_id' => $this->update->user()->id, //451559836
                'role' => 'Admin',
            ]);
            $auth=true;
            HomeController::messagesend($UserName . ' вы теперь админ', $Tele_id);
        }

        if ($mytext == '/list' && $ResBotUserRole == 'Admin') {
            foreach (TextAnswer::all() as $fl) {
                $response2 = '(' . $fl->id . ') ' . $fl->text_type . ' - ' . $fl->answer;
                HomeController::messagesend($response2, $Tele_id);
            }
        }

        if (substr($mytext, 0, 5) == '/edit' && $ResBotUserRole == 'Admin') {
            $param = str_replace('/edit ', '', $mytext);
            $pieces = explode(":", $param);
            if (is_numeric($pieces[0]) == 1) {
                $edittext = TextAnswer::find($pieces[0]);

                if (empty($pieces[1])) {
                    HomeController::messagesend('Вопрос создан автоматически', $Tele_id);
                    $pieces[1] = 'edit text from bot';
                }
                if (empty($pieces[2])) {
                    HomeController::messagesend('Ответ создан автоматически', $Tele_id);
                    $pieces[2] = 'edit text from bot';
                }
                $edittext->update([
                    'text_type' => $pieces[1],
                    'answer' => $pieces[2],
                ]);
                HomeController::messagesend('Запись (' . $pieces[0] . ') отредактирована', $Tele_id);
            }
        }


        if (substr($mytext, 0, 7) == '/create' && $ResBotUserRole == 'Admin') {
            $param = str_replace('/create ', '', $mytext);
            $pieces = explode(":", $param);
            echo 'param ' . $param;

            if (empty($pieces[1])) {
                HomeController::messagesend('Вопрос создан автоматически', $Tele_id);
                $pieces[1] = 'new text from bot' . rand(5, 15);
            }
            if (empty($pieces[2])) {
                HomeController::messagesend('Ответ создан автоматически', $Tele_id);
                $pieces[2] = 'new answer from bot' . rand(5, 15);
            }
            TextAnswer::create([
                'text_type' => $pieces[1],
                'answer' => $pieces[2],
            ]);
        }

        if (substr($mytext, 0, 7) == '/delete' && $ResBotUserRole == 'Admin') {
            $param = str_replace('/delete ', '', $mytext);
            if (is_numeric($param) == 1) {
                //HomeController::delete($param);
                //HomeController::messagesend('Вопрос - Ответ с id:'.$param.' удален');

                $deltext = TextAnswer::find($param);
                if (empty($deltext)) {
                    HomeController::messagesend('Неверный ID' . $param, $Tele_id);
                    return;
                } else {
                    $deltext->delete();
                    HomeController::messagesend('Вопрос - Ответ с id:' . $param . ' удален', $Tele_id);
                }
            }
        }
        if ($ResBotUserRole == 'User'){

        if($mytext == '/start'){
           $rndqa = TextAnswer::orderByRaw("RAND()")->first();
            $response = new \stdClass();
            $response->text = 'ШАЛОМ ' . $emojie . ' ' . $UserName . "\n" . 'Что я умею: ты задаеш вопрос я отвечаю'. "\n" .'пример: '.$rndqa->text_type.' - '.$rndqa->answer;
        }else {
            $response = new \stdClass();
            $response->text = 'У меня не ответа на этот вопрос '.$emojie2;
        }


            $answerr = TextAnswer::where('text_type', $mytext)->first();

            if ($answerr) {
                //$response->text = $answer->answer;
                foreach (TextAnswer::where('text_type', $mytext)->get() as $flight) {
                    $response->text = $flight->answer;
                    $messageParams = [
                        'chat_id' => $this->update->message->chat->id,
                        'text' => $response->text,
                    ];
                    $this->bot->sendMessage($messageParams);
                }
                return;
            }

            $messageParams = [
                'chat_id' => $this->update->message->chat->id,
                'text' => $response->text,
            ];

            $this->bot->sendMessage($messageParams);


    }
    }

}
