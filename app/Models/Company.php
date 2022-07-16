<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'logo'
    ];

    /**
     * relation companies table with users
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * relations companies table with teams
     *
     * @return void
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    /**
     * relations companies table with role
     *
     * @return void
     */
    public function roles()
    {   
        return $this->hasMany(Role::class);
    }
}
