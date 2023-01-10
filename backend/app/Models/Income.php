<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'user_id',
    ];

    public function incomes()
    {
        return $this->belongsTo(Income::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
