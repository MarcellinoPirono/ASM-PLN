<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRincianInduk extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function rincian_induks()
    {
        return $this->hasMany(RincianInduk::class, 'kontraks_id', 'id');
    }

    public function rabs()
    {
        return $this->hasMany(Rab::class, 'kategori_id', 'id');
    }
}
