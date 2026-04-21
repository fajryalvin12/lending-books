<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    //
    protected $fillable =  ['bookcode', 'title', 'year', 'author', 'stock'];

    public function borrowing(): HasMany {
        return $this->hasMany(Borrowing::class);
    }
}
