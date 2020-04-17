<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function create()
    {
        return view('submission.create');
    }
}
