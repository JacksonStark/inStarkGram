<?php

namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
    public function index($user)
    {
        $user = User::findOrFail($user);

        // if ($user) {
            return view('profiles.index', [
                'user' => $user
            ]);

        // }
    }
}
