<?php

namespace App\Providers;

use App\Services\Functional\AdminAuthService;
use App\Services\Functional\UserAuthService;
use Illuminate\Support\ServiceProvider;
use App\Exceptions\Handler;

class AppServiceProvider extends ServiceProvider
{

    protected $facades = [
    'UserAnswerService' => \App\Services\Model\UserAnswer\UserAnswerService::class,

    'UserService' => \App\Services\Model\User\UserService::class,

    'QuestionOptionService' => \App\Services\Model\QuestionOption\QuestionOptionService::class,

    'QuestionService' => \App\Services\Model\Question\QuestionService::class,

    'AdminService' => \App\Services\Model\Admin\AdminService::class,



    'AdminAuthService' => AdminAuthService::class,

    'UserAuthService' => UserAuthService::class,




     ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->facades as $facade => $service) {
            $this->app->singleton($facade, function ($app) use ($service) {
                return $app->make($service);
            });
        }

        $this->app->singleton(\Illuminate\Contracts\Debug\ExceptionHandler::class, Handler::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
