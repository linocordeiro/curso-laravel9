<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //usado quando o nome da tabela nao segue o padrao do latavel
    // protected $table = 'comments';

    protected $fillable = ['body', 'visible'];

    //faz a conversao de tipos
    protected $casts = ['visible' => 'boolean'];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
