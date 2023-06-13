<?php

namespace Sentgine\Authzone\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class AuthzoneController extends Controller
{
    /**
     * The index function.
     * 
     * @return View
     */
    public function index(): View
    {
        return view(authzone_view_path('index'));
    }
}
