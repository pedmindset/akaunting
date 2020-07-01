<?php

namespace App\Traits;

use App\Utilities\Installer;
use Illuminate\Http\Request;

trait SettingController {

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // Create company
        Installer::createCompany($request->get('company_name'), $request->get('company_email'), 'en_GB');

        // Create user
        Installer::createUser($request->get('user_email'), $request->get('user_password'), 'en_GB', $request->get('role'));

        // Make the final touches
        Installer::finalTouches();

        // Redirect to dashboard
        $response['redirect'] = route('login');

        return response()->json($response);
    }
}
