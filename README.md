Flash description
=================
For demo purpose only. It wasn't tested and launched. Design patterns that were used: __recursive factory & chain of responsibilities__. It was accoumplished in one our.

That's how it should be used:
```php
$processor = (new \TurboParser\TextProcessor\ProcessorFactory())->create($job->getMethods());
$result = $processor->handle($job->getText());
``` 

* amphp/aerys is for async HTTP;

TODO
====
* add request validator;
* add serializer;
* add service container if needed;
* write tests.

