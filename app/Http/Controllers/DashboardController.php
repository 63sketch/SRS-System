<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->user()->role->name;

        return match ($role) {
            'Super Admin' => view('dashboards.admin'),
            'HR Admin', 'HR Officer' => view('dashboards.hr'),
            'Department Manager' => view('dashboards.manager'),
            default => view('dashboards.employee'),
        };
    }
}
