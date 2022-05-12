<?php

namespace App\Modules\Telegram\Exceptions;

use Throwable;

final class NoSuitableAnswerException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function causeOfNoResultsWereFound(): NoSuitableAnswerException
    {
        return new self('No results were found for your search');
    }
}
