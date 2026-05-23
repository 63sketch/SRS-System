<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $rules = [
            'company_name' => 'required|string|max:255',
            'company_email' => 'nullable|email',
            'company_phone' => 'nullable|string|max:20',
            'company_address' => 'nullable|string|max:500',
            'company_logo' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'currency' => 'required|in:ETB,USD,EUR',
            'timezone' => 'required|string',
            'employee_id_format' => 'required|string|max:50',
            'employee_id_counter' => 'required|integer|min:1',
            'notification_email_enabled' => 'nullable',
            'notification_inapp_enabled' => 'nullable',
            'notification_email' => 'nullable|email',
            'data_retention_days' => 'required|integer|min:30',
            'audit_log_retention' => 'required|integer|min:30',
        ];

        $validated = $request->validate($rules);

        // Handle logo upload
        if ($request->hasFile('company_logo')) {
            $path = $request->file('company_logo')->store('company_logos', 'public');
            Setting::set('company_logo_path', $path);
        }

        // Convert checkboxes to boolean and remove from validated to handle separately
        $validated['notification_email_enabled'] = $request->has('notification_email_enabled') ? '1' : '0';
        $validated['notification_inapp_enabled'] = $request->has('notification_inapp_enabled') ? '1' : '0';

        // Save settings
        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        // Log this action
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'action_type' => 'settings_change',
            'entity_type' => 'Settings',
            'entity_id' => 0,
            'after_json' => json_encode($validated),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return back()->with('success', 'Settings updated successfully!');
    }
}
