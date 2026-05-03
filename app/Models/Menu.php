<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Ini yang tadi saya maksud: Kasih izin kolom mana saja yang boleh diisi
    protected $fillable = ['name', 'price', 'category', 'description', 'image'];
}