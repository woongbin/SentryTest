<?php
namespace Xpressengine\Plugins\SentryLogAlert;

use Sentry\SentryLaravel\SentryFacade;
use Sentry\SentryLaravel\SentryLaravelServiceProvider;
use XeFrontend;
use XePresenter;
use XeConfig;
use Route;
use Xpressengine\Plugin\AbstractPlugin;
use Xpressengine\Plugins\SentryLogAlert\Providers\SentryLogAlertProvider;

class Plugin extends AbstractPlugin
{
    const CONFIG_NAME = 'SentryLogAlert';
    /**
     * 이 메소드는 활성화(activate) 된 플러그인이 부트될 때 항상 실행됩니다.
     *
     * @return void
     */
    public function boot()
    {
        $config = XeConfig::get(static::CONFIG_NAME);

        if ($config == null) {
            $sentryConfig = [];
        } else {
            $sentryConfig['dsn'] = $config->get('dsn');
            $sentryConfig['breadcrumbs.sql_bindings'] = $config->get('breadcrumbs.sql_bindings');
            $sentryConfig['user_context'] = $config->get('user_context');
        }

        app('config')->set('sentry', $sentryConfig);

        \App::register(SentryLogAlertProvider::class);
        \App::register(SentryLaravelServiceProvider::class);
        \APP::alias('Sentry', SentryFacade::class);

        $this->route();
    }

    protected function route()
    {
        Route::settings(static::getId(), function () {
            Route::group(['setting', 'as' => 'sentry_log_alert::setting'], function () {
                Route::get('/', 'SettingsController@getSetting');
                Route::post('/', 'SettingsController@postSetting');
            });
        }, ['namespace' => 'Xpressengine\\Plugins\\SentryLogAlert\\Controller']);
    }

    public function getSettingsURI()
    {
        return route('sentry_log_alert::setting');
    }

    /**
     * 플러그인이 활성화될 때 실행할 코드를 여기에 작성한다.
     *
     * @param string|null $installedVersion 현재 XpressEngine에 설치된 플러그인의 버전정보
     *
     * @return void
     */
    public function activate($installedVersion = null)
    {
        $config = XeConfig::set(static::CONFIG_NAME, []);
    }

    /**
     * 플러그인을 설치한다. 플러그인이 설치될 때 실행할 코드를 여기에 작성한다
     *
     * @return void
     */
    public function install()
    {
        // implement code
    }

    /**
     * 해당 플러그인이 설치된 상태라면 true, 설치되어있지 않다면 false를 반환한다.
     * 이 메소드를 구현하지 않았다면 기본적으로 설치된 상태(true)를 반환한다.
     *
     * @return boolean 플러그인의 설치 유무
     */
    public function checkInstalled()
    {
        // implement code

        return parent::checkInstalled();
    }

    /**
     * 플러그인을 업데이트한다.
     *
     * @return void
     */
    public function update()
    {
        // implement code
    }

    /**
     * 해당 플러그인이 최신 상태로 업데이트가 된 상태라면 true, 업데이트가 필요한 상태라면 false를 반환함.
     * 이 메소드를 구현하지 않았다면 기본적으로 최신업데이트 상태임(true)을 반환함.
     *
     * @return boolean 플러그인의 설치 유무,
     */
    public function checkUpdated()
    {
        // implement code

        return parent::checkUpdated();
    }
}
