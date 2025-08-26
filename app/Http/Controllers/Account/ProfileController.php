<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function getProfile()
    {
        return Inertia::render('account/ProfilePage');
    }
}
