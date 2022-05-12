<?php

namespace App\Modules\Telegram\Handlers;

use App\Models\Region;
use App\Models\Waterbase;
use App\Modules\Telegram\Exceptions\NoSuitableAnswerException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class GenericMessageCommandHandler
{
    /**
     * @throws NoSuitableAnswerException
     */
    public function findFitReply(string $message): string
    {
        try {
            $waterBases = Region::findByAreaNameOrFail($message)->waterbases;
            $answerString = '';
            foreach ($waterBases as $waterBase) {
                $answerString .= $waterBase->getAttribute('name').PHP_EOL;
            }
        } catch (ModelNotFoundException) {
            try {
                $waterBase = Waterbase::findByNameOrFail($message);
                $volume = $waterBase->volume;
                $answerString = $waterBase->getAttribute('name').': '.$volume->getAttribute('volume');
            } catch (ModelNotFoundException) {
                throw NoSuitableAnswerException::causeOfNoResultsWereFound();
            }
        }

        return $answerString;
    }
}
