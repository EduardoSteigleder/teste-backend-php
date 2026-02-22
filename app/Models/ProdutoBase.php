<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoBase extends Model
{
    protected $table = 'produtos_base';
    protected $fillable = ['sku', 'nome', 'descricao', 'ativo'];
    public $timestamps = true;
}
