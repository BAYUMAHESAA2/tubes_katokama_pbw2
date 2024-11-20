<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warung extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'warung';

    /**
     * Primary key yang digunakan pada tabel.
     *
     * @var string
     */
    protected $primaryKey = 'warung_id';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'nama_warung',
        'slug',
        'alamat',
        'no_wa',
        'status_pengantaran',
        'image',
    ];

    /**
     * Atribut yang memiliki nilai default.
     *
     * @var array
     */
    protected $attributes = [
        'status_pengantaran' => 'aktif',
    ];

    /**
     * Aturan casting atribut.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi dengan model Menu.
     *
     * @return HasMany
     */
    public function menu(): HasMany
    {
        return $this->hasMany(Menu::class, 'warung_id', 'warung_id');
    }

    /**
     * Relasi dengan model Ulasan.
     *
     * @return HasMany
     */
    public function ulasan(): HasMany
    {
        return $this->hasMany(Ulasan::class, 'warung_id', 'warung_id');
    }
}
