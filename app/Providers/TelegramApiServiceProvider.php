<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

final class TelegramApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Telegram::class, function () {
            Request::setCustomBotApiUri('telegram-bot-api:8081');
            return new Telegram(env('TELEGRAM_BOT_TOKEN', ''), env('TELEGRAM_BOT_USERNAME', ''));
        });
    }
}
