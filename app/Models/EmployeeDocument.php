<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\LogsActivity;

class EmployeeDocument extends Model
{
    use LogsActivity;
    protected $fillable = [
        'employee_id', 'parent_document_id', 'category', 'title',
        'file_path', 'file_hash', 'issue_date', 'expiry_date',
        'doc_number', 'issuer', 'visibility', 'verification_status',
        'rejection_reason', 'notes', 'version', 'uploaded_by'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
