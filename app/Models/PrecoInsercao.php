<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecoInsercao extends Model
{
    protected $table = 'preco_insercao';
    protected $fillable = ['sku', 'preco_normalizado', 'moeda_normalizada'];
    public $timestamps = true;
}
