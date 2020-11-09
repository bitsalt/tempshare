<?php

namespace App\Http\Controllers;

use App\Models\CurrentUser;
use App\Services\EnvironmentService;
use Illuminate\Http\Request;

class AllotmentsController extends Controller
{

    public function __construct()
    {
        // Laravel session isn't available within the constructor without this
        $this->middleware(function ($request, $next) {
            $this->currentUser = new CurrentUser();
            EnvironmentService::getcurrentUser($this->currentUser, session()->all());
            return $next($request);
        });
    }
}
