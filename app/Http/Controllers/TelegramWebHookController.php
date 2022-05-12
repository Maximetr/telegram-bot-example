<?php

namespace App\Http\Controllers;

use App\Modules\Telegram\Commands\GenericMessageCommand;
use Illuminate\Routing\Controller as BaseController;
use App\Modules\Telegram\Commands\StartCommand;
use Longman\TelegramBot\Telegram;

final class TelegramWebHookController extends BaseController
{
    public function __construct(private Telegram $telegramApi)
    {
    }

    public function receiveWebHook()
    {
        try {
            $this->telegramApi->addCommandClass(GenericMessageCommand::class);
            $this->telegramApi->addCommandClass(StartCommand::class);
            $this->telegramApi->handle();
        } catch (\Exception) {
        }
    }
}
