<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 04.03.18 14:48.
 */

namespace TurboParser\TextProcessor;


use TurboParser\TextProcessor\Exception\UnknownServiceException;
use TurboParser\TextProcessor\Processor\RemoveSpacesProcessor;
use TurboParser\TextProcessor\Processor\StripTagsProcessor;

class ProcessorFactory
{
    /**
     * TODO replace with service container if needed
     *
     * @var array
     */
    private $services = [
        'stripTags' => StripTagsProcessor::class,
        'removeSpaces' => RemoveSpacesProcessor::class,
    ];

    /**
     * @param array $services
     * @return Processor
     * @throws UnknownServiceException
     */
    public function create(array $services = []): Processor
    {
        $service = array_shift($services);
        if (!isset($this->services[$service])) {
            throw new UnknownServiceException($service);
        }

        return new $service($this->create($services));
    }
}