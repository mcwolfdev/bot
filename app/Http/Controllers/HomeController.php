<?php

namespace App\Http\Controllers;

use App\Models\TextAnswer;
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
        $qatextcount = TextAnswer::all();
        //$qatext = TextAnswer::paginate(5);
        $qatext = TextAnswer::orderBy('id', 'desc')->paginate(20);

        return view('home',compact('qatext'));
    }

    public function create(Request $request){
        $qw = $request->input('qw');
        $an = $request->input('an');
        TextAnswer::create([
            'text_type' =>  $qw, //'new text',
            'answer'    =>  $an, //' new answer',
        ]);
        //return view('mod',compact('qw','an'));
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
        $bot = new TeleBot(env('TELEGRAM_BOT_TOKEN'));

        $bot->sendMessage([
            'chat_id' => $teleid,
            'text' => $messsend,
        ]);
    }



}
