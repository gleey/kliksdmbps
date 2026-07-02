<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Base model for all layanan items (persyaratan & dokumen tables).
 * Each subclass simply sets $table.
 */
abstract class LayananItem extends Model
{
    protected $fillable = ['title', 'description', 'url', 'sort_order'];
}
