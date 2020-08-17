<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route("home");
        }
        return $this->home();
    }

    public function home()
    {
        return view(RouteServiceProvider::VIEWS['landing']);
    }
}
