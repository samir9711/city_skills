<?php

namespace App\Facades\Services\SkillUser;

use Illuminate\Support\Facades\Facade;

class SkillUserFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'SkillUserService';
    }
}