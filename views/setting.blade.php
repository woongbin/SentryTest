@section('page_title')
    <h2>{{ xe_trans('sentry_log_alert::pluginSettingTitle') }}</h2>
@endsection

<div class="row">
    <div class="col-sm-12">
        <div class="panel-group">
            <div class="panel">
                <div class="panel-collapse collapse in">
                    <form method="post" action="{{ route('sentry_log_alert::setting') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="clearfix">
                                    <label>dsn</label>
                                </div>
                                <input type="text" name="dsn" class="xe-form-control" value="{{ $config->get('dsn') }}">
                            </div>

                            <div class="form-group">
                                <div class="clearfix">
                                    <label>breadcrumbs.sql_bindings</label>
                                </div>
                                <input type="radio" name="sql_bindings" value=true @if ($config->get('sql_bindings') === true) checked="checked" @endif> True
                                <input type="radio" name="sql_bindings" value=false @if ($config->get('sql_bindings') === false) checked="checked" @endif> False
                            </div>

                            <div class="form-group">
                                <div class="clearfix">
                                    <label>user_context</label>
                                </div>
                                <input type="radio" name="user_context" value=true @if ($config->get('user_context') === true) checked="checked" @endif> True
                                <input type="radio" name="user_context" value=false @if ($config->get('user_context') === false) checked="checked" @endif> False
                            </div>
                        </div>

                        <div class="panel-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">{{ xe_trans('xe::save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
