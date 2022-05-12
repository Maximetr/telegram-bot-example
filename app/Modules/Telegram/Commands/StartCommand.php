<?php

namespace App\Modules\Telegram\Commands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

final class StartCommand extends UserCommand
{
    protected $name = 'start';
    protected $description = 'Start command';
    protected $usage = '/start';
    protected $version = '1.2.0';

    public function execute(): ServerResponse
    {
        $answerText = "Отправьте наименования региона, чтобы узнать список водобаз этого региона.\nОтправьте наименование водобазы, чтобы узнать оставшийся объем.";

        return Request::sendMessage(['chat_id' => $this->getMessage()->getChat()->getId(), 'text' => $answerText]);
    }
}

