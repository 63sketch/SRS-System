<?php

namespace App\Traits;

use App\Models\AuditLog;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::creating(function ($model) {
            $model->logActivity('created', null, $model->getAttributesToLog());
        });

        static::updating(function ($model) {
            $changes = $model->getChanges();
            $before = array_intersect_key($model->getOriginal(), $changes);

            $model->logActivity('updated', $before, $changes);
        });

        static::deleting(function ($model) {
            $model->logActivity('deleted', $model->getAttributes(), null);
        });
    }

    /**
     * Log activity to audit table
     */
    public function logActivity($action, $before = null, $after = null)
    {
        // Exclude sensitive fields that shouldn't be logged
        $exclude = ['password', 'remember_token', 'api_token'];

        if ($before) {
            foreach ($exclude as $field) {
                unset($before[$field]);
            }
        }

        if ($after) {
            foreach ($exclude as $field) {
                unset($after[$field]);
            }
        }

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'action_type' => 'model_change',
            'entity_type' => class_basename($this),
            'entity_id' => $this->id,
            'before_json' => $before ? json_encode($before) : null,
            'after_json' => $after ? json_encode($after) : null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
        ]);
    }

    /**
     * Get attributes to log
     */
    protected function getAttributesToLog()
    {
        $attributes = $this->getAttributes();
        $exclude = ['password', 'remember_token', 'api_token'];

        foreach ($exclude as $field) {
            unset($attributes[$field]);
        }

        return $attributes;
    }
}
