<?php

namespace App\Http\Controllers;

use App\Models\TextAnswer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AnswerController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        //$qa = TextAnswer::all();
        //compact('qa');
    }

}
