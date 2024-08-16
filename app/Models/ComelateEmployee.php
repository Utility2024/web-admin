<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ComelateEmployee extends Model
{
    use HasFactory;

    protected $connection = 'mysql_hr';

    protected $fillable = ['nik', 'name', 'department', 'shift', 'alasan_terlambat', 'nama_security', 'tanggal', 'jam'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the transaction.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the employee related to this record.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'nik', 'user_login');
    }

    /**
     * Boot method to attach model events.
     */
    protected static function boot()
    {
        parent::boot();

        // Set the creator on creating event
        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });

        // Set the updater on updating event
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }
}
