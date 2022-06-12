<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class WebhookController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function webhook()
    {
        TeleBot::bot('5584913348:AAFRImMHYLpEig_6v2j2Fs1PtxDnJCFJ-18')->handleUpdate();
    }
}
