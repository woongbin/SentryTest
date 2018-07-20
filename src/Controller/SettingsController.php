<?php
namespace Xpressengine\Plugins\SentryLogAlert\Controller;

use XeConfig;
use XePresenter;
use App\Http\Controllers\Controller;
use Xpressengine\Http\Request;

class SettingsController extends Controller
{
    protected $view = 'sentry_log_alert::views.setting';

    const CONFIG_NAME = 'SentryLogAlert';

    public function getSetting()
    {
        $config = XeConfig::get(static::CONFIG_NAME);

        if ($config == null) {
            $config = XeConfig::set(static::CONFIG_NAME, []);
        }

        return XePresenter::make($this->view, compact('config'));
    }

    public function postSetting(Request $request)
    {
        $config = XeConfig::getOrNew(static::CONFIG_NAME);

        $inputs = $request->except(['_token', 'password']);

        foreach ($inputs as $key => $input) {
            $config->set($key, $input);
        }

        XeConfig::modify($config);

        return redirect()->to(route('sentry_log_alert::setting'))
            ->with('alert', ['type' => 'success', 'message' => '설정이 저장되었습니다.']);
    }
}
