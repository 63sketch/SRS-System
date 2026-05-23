<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Exports\AuditLogExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with('user')->orderBy('created_at', 'desc');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('entity_type')) {
            $query->where('entity_type', $request->entity_type);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        $auditLogs = $query->paginate(15);

        return view('audit-logs.index', compact('auditLogs'));
    }

    public function show(AuditLog $auditLog)
    {
        return view('audit-logs.show', compact('auditLog'));
    }

    public function export(Request $request)
    {
        $query = AuditLog::with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $logs = $query->get();

        return Excel::download(new AuditLogExport($logs), 'audit_logs_' . now()->format('Y-m-d') . '.xlsx');
    }
}
