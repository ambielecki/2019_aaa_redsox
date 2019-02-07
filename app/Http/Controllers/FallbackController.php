<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class FallbackController extends Controller {
    public function getWebFallback(): View {
        return view('main');
    }
}
