<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

function confirmAuthorization($permission, $action)
{
    if (!Auth::user()->can($permission . '.' . $action)) {
        throw new AuthorizationException('You do not have permission to access this page');
    }
}
