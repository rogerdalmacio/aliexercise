<?php

namespace App\Enums;

use App\Traits\EnumsWithOptions;

enum RoleTypes: string
{
    use EnumsWithOptions;

    case SALES = 'Sales';
    case ACCOUNT = 'Account';
}
