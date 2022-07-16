<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'icon',
        'company_id'
    ];

    /**
     * relation team table with company 
     *
     * @return void
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * relation team table with employee
     *
     * @return void
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
