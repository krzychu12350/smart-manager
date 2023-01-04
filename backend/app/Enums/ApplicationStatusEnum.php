<?php

namespace App\Enums;

enum ApplicationStatusEnum: string
{
    case ACCPETED = 'accepted';
    case IN_PROGGRESS = 'in progress';
    case REJECTED = 'rejected';
}
