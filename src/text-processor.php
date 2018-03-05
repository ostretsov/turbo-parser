<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 04.03.18 14:11.
 */

use Aerys\{Bootable, Host, Request, Response, function router};

date_default_timezone_set('Europe/Moscow');

$router = router()
    ->route('POST', '/', function(Request $request, Response $response) {
        // reset on timeout
        $timeout = (int) getenv('TIMEOUT') ?: 3 * 60; // in seconds
        $request->getLocalVar('logger')->debug($request->getLocalVar('request_microtime').': request timeout: '.$timeout);
        Amp\Loop::delay($timeout * 1000, function () use ($request, $response) {
            if (Response::NONE == $response->state()) {
                $response->setStatus(408);
                $response->end();
                $request->getLocalVar('logger')->debug($request->getLocalVar('request_microtime').': processing was stopped on timeout');
            }
        });

        // parse POST body
        $postBody = yield $request->getBody();

        // TODO validate request
        // TODO unserialize into Job object
        /** Job $job */
        $processor = (new \TurboParser\TextProcessor\ProcessorFactory())->create($job->getMethods());
        $result = null !== $processor ? $processor->handle($job->getText()) : $job->getText();

        if (Response::NONE == $response->state()) {
            $response->write(''); // to prevent resetting on timeout
            $response->write(json_encode(['text' => $result]));

            $response->end();
        }

        $request->getLocalVar('logger')->debug($request->getLocalVar('request_microtime').': request is processed');
    });

return (new Host)
    ->expose('*', 1337)
    ->use(new class implements Bootable {
        private $logger;

        function boot(Aerys\Server $server, Psr\Log\LoggerInterface $logger) {
            $this->logger = $logger;
        }

        function __invoke(Aerys\Request $request, Aerys\Response $response) {
            $requestMicrotime = microtime(true) * 10000;
            $this->logger->debug($requestMicrotime.': request is recieved');
            $request->setLocalVar('logger', $this->logger);
            $request->setLocalVar('request_microtime', $requestMicrotime);
        }
    })
    ->use($router);