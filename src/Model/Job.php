<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 04.03.18 14:11.
 */

class Job
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var string[]
     */
    private $methods;

    /**
     * @param string $text
     * @param string[] $methods
     */
    public function __construct($text, array $methods)
    {
        $this->text = $text;
        $this->methods = $methods;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string[]
     */
    public function getMethods()
    {
        return $this->methods;
    }
}