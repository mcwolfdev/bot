<?php

namespace App\Http\Controllers;

use App\Models\TextAnswer;
use App\Models\Post;
use Illuminate\Http\Request;
use WeStacks\TeleBot\TeleBot;


class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$qatext = TextAnswer::all();
        $qatext = TextAnswer::paginate(5);
        return view('home',compact('qatext'));
    }

    public function create(){

        TextAnswer::create([
            'text_type' =>  'new text',
            'answer'    =>  ' new answer',
        ]);

        return redirect()->route('home');
    }

    public static function delete($keydel){
        $deltext = TextAnswer::find($keydel);
        $deltext->delete();
        return redirect()->route('home');
    }

    public function edit(Request $request, $keyed){

        $edittext = TextAnswer::find($keyed);
        $textq = $request->input('question');
        $texta = $request->input('answer');
        $edittext->update([
            'text_type' =>  $textq,
            'answer'    =>  $texta,
        ]);

        return redirect()->route('home');

    }

    public static function messagesend($messsend, $teleid){
        $bot = new TeleBot(env('TELEGTAM_BOT_TOKEN'));

        $bot->sendMessage([
            'chat_id' => $teleid, //451559836 // 134629284
            'text' => $messsend,
        ]);
    }



}
