<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 04.03.18 14:56.
 */

namespace TurboParser\TextProcessor\Exception;


use Throwable;

class UnknownServiceException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('Service "%s" is not defined!', $message), $code, $previous);
    }

}