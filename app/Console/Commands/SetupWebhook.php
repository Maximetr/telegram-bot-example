<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Longman\TelegramBot\Telegram;

final class SetupWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webhook:up';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up telegram api web hook';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Telegram $telegramApi)
    {
        $telegramApi->setWebhook('telegram-bot-nginx/receiveWebHook', [
            'certificate' => '/var/www/app/docker/nginx/ssl-cert/nginx-selfsigned.pem'
        ]);

        return 0;
    }
}
