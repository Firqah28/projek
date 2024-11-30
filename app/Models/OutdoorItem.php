<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutdoorItem extends Model
{
    use HasFactory;

    protected $table = 'outdoor_items'; // Nama tabel outdoor_items
    protected $fillable = [
        'name', 'description', 'price', 'image','stok', 'kategori',
    ];
    
}
