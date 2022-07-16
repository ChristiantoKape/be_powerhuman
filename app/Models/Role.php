<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'company_id',
    ];

    /**
     * reation role table with company
     *
     * @return void
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    public function responsibilities()
    {
        return $this->hasMany(Responsibility::class);
    }
}
