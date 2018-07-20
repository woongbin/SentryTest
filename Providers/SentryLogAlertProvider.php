<?php

namespace Xpressengine\Plugins\SentryLogAlert\Providers;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Xpressengine\Plugins\SentryLogAlert\Exceptions\SentryLogAlertExceptionHandler;

class SentryLogAlertProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(ExceptionHandler::class, SentryLogAlertExceptionHandler::class);
    }
}
