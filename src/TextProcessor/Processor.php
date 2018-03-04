<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 04.03.18 14:22.
 */

namespace TurboParser\TextProcessor;

abstract class Processor
{
    /**
     * @var Processor|null
     */
    private $successor = null;

    public function __construct(Processor $handler = null)
    {
        $this->successor = $handler;
    }
    /**
     * @param string|null $text
     *
     * @return string|null
     */
    final public function handle(string $text = null): ?string
    {
        $processed = $this->processing($text);
        if (null === $processed) {
            if (null !== $this->successor) {
                $processed = $this->successor->handle($text);
            }
        }

        return $processed;
    }

    abstract protected function processing(string $text = null): ?string;
}