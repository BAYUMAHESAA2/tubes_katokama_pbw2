<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'warung_id',
        'rating',
        'komentar',
        'tanggal_ulasan',
    ];

    /**
     * Get the user that owns the ulasan.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the warung that owns the ulasan.
     */
    public function warung()
    {
        return $this->belongsTo(Warung::class, 'warung_id');
    }
}
