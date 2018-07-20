<?php

namespace Xpressengine\Plugins\SentryLogAlert\Exceptions;

use App\Exceptions\Handler;

class SentryLogAlertExceptionHandler extends Handler
{
    public function report(\Exception $exception)
    {
        app('sentry')->captureException($exception);

        parent::report($exception);
    }
}
