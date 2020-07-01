<?php

namespace App\Http\Controllers\Install;

use App\Http\Requests\Install\Setting as Request;
use App\Utilities\Installer;
use Illuminate\Routing\Controller;

class Settings extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('install.settings.create');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function pro()
    {
        return view('install.settings.pro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        session(['locale' => 'en_GB']);

        // Create company
        Installer::createCompany($request->get('company_name'), $request->get('company_email'), session('locale', 'en_GB'));

        // Create user
        Installer::createUser($request->get('user_email'), $request->get('user_password'), session('locale', 'en_GB'), $request->roles);

        // Make the final touches
        Installer::finalTouches();

        // Redirect to dashboard
        $response['redirect'] = route('login');

        return response()->json($response);
    }
}
