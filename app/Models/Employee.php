<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // Koneksi ke database mysql_employee
    protected $connection = 'mysql_employee';

    // Nama view yang akan digunakan
    protected $table = '_users'; // Ganti dengan nama view yang sesuai

    // Kolom yang akan diambil
    protected $fillable = [
        'ID',
        'Departement',
        'Display_Name',
        'user_login',
        'Last_Jobs',
        'Last_Route'
    ];

    // Primary key
    protected $primaryKey = 'ID';

    // Timestamps
    public $timestamps = false;

    // Definisi agar model ini bersifat read-only
    public function setAttribute($key, $value)
    {
        return null;
    }

    // Relationship with ComelateEmployee
    public function comelateEmployees()
    {
        return $this->hasMany(ComelateEmployee::class, 'nik', 'user_login');
    }
}
