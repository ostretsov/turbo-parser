<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 04.03.18 14:25.
 */

namespace TurboParser\TextProcessor\Processor;

use TurboParser\TextProcessor\Exception\ProcessingException;
use TurboParser\TextProcessor\Processor;

class RemoveSpacesProcessor extends Processor
{
    /**
     * @param string|null $text
     * @return string
     * @throws ProcessingException
     */
    protected function processing(string $text = null): string
    {
        $processed = preg_replace('/\s+/', '', $text);
        if (null === $processed) {
            throw new ProcessingException();
        }

        return $processed;
    }
}