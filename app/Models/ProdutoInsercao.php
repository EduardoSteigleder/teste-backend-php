<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoInsercao extends Model
{
    protected $table = 'produto_insercao';
    protected $fillable = ['sku', 'nome_normalizado', 'descricao_normalizada'];
    public $timestamps = true;
}
