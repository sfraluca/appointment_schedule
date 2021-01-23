<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaries extends Model
{
    use HasFactory;
    protected $table = 'salaries';

    protected $fillable = ['employee_id','employee', 'hours', 'month', 'salary'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

}
