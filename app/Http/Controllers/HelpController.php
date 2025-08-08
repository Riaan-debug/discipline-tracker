<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Show the main help page
     */
    public function index()
    {
        return view('help.index');
    }

    /**
     * Show getting started guide
     */
    public function gettingStarted()
    {
        return view('help.getting-started');
    }

    /**
     * Show user roles guide
     */
    public function userRoles()
    {
        return view('help.user-roles');
    }

    /**
     * Show students management guide
     */
    public function students()
    {
        return view('help.students');
    }

    /**
     * Show incidents management guide
     */
    public function incidents()
    {
        return view('help.incidents');
    }

    /**
     * Show positive reports guide
     */
    public function positiveReports()
    {
        return view('help.positive-reports');
    }

    /**
     * Show export guide
     */
    public function exports()
    {
        return view('help.exports');
    }

    /**
     * Show FAQ page
     */
    public function faq()
    {
        return view('help.faq');
    }

    /**
     * Show contact/support page
     */
    public function support()
    {
        return view('help.support');
    }
}
