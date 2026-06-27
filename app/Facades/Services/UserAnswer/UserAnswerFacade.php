<?php

namespace App\Facades\Services\UserAnswer;

use Illuminate\Support\Facades\Facade;

class UserAnswerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'UserAnswerService';
    }
}