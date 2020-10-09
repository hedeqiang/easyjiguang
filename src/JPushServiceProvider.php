<?php


namespace Hedeqiang\JPush;

class JPushServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/jpush.php' => config_path('jpush.php'),
        ], 'jpush');
    }

    public function register()
    {
        $this->app->singleton(JPush::class, function () {
            return new JPush(config('jpush'));
        });
        $this->app->singleton(Device::class, function () {
            return new Device(config('jpush'));
        });
        $this->app->singleton(File::class, function () {
            return new File(config('jpush'));
        });
        $this->app->singleton(Report::class, function () {
            return new Report(config('jpush'));
        });
        $this->app->singleton(Schedule::class, function () {
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
