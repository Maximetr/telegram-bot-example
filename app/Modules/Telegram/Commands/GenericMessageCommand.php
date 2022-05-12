<?php

namespace App\Modules\Telegram\Commands;

use App\Modules\Telegram\Exceptions\NoSuitableAnswerException;
use App\Modules\Telegram\Handlers\GenericMessageCommandHandler;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

final class GenericMessageCommand extends SystemCommand
{
    protected $name = Telegram::GENERIC_MESSAGE_COMMAND;
    protected $description = 'Handle generic message';
    protected $version = '1.0.0';

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $handler = new GenericMessageCommandHandler();
        try {
            $answerText = $handler->findFitReply($message->getText());
        } catch (NoSuitableAnswerException $exception) {
            $answerText = $exception->getMessage();
        }

        return Request::sendMessage(['chat_id' => $message->getChat()->getId(), 'text' => $answerText]);
    }
}
