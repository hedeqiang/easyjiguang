<?php


namespace Hedeqiang\JPush;

class JPushServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/antispam.php' => config_path('jpush.php'),
        ], 'jpush');
    }

    public function register()
    {
        $this->app->singleton('jpush.push', function () {
            return new JPush(config('jpush'));
        });
        $this->app->singleton('jpush.device', function () {
            return new Device(config('jpush'));
        });
        $this->app->singleton('jpush.file', function () {
            return new File(config('jpush'));
        });
        $this->app->singleton('jpush.report', function () {
            return new Report(config('jpush'));
        });
        $this->app->singleton('jpush.schedule', function () {
            return new Schedule(config('jpush'));
        });

        $this->app->alias(JPush::class, 'jpush.push');
        $this->app->alias(Device::class, 'jpush.device');
        $this->app->alias(File::class, 'jpush.file');
        $this->app->alias(Report::class, 'jpush.report');
        $this->app->alias(Schedule::class, 'jpush.schedule');
    }

    public function provides()
    {
        return ['jpush.push', 'jpush.device','jpush.file','jpush.report','jpush.schedule'];
    }
}
