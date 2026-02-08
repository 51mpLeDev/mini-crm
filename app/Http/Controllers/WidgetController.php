<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function __invoke()
    {
        return view('widget');
    }
}
