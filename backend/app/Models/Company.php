<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'city',
        'industry',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'pivot'
    ];

    public function employees()
    {
        return $this->belongsToMany(User::class);
    }

    public function applications()
    {
        return $this->belongsTo(Application::class);
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }
}
