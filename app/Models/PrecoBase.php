<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecoBase extends Model
{
    protected $table = 'precos_base';
    protected $fillable = ['sku', 'preco', 'moeda', 'ativo'];
    public $timestamps = true;
}
