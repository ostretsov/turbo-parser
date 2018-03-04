<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 04.03.18 14:22.
 */

namespace TurboParser\TextProcessor\Processor;

use TurboParser\TextProcessor\Processor;

class StripTagsProcessor extends Processor
{
    protected function processing(string $text = null): string
    {
        return strip_tags($text);
    }
}