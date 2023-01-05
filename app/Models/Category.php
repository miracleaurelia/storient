<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function book()
    {
    	return $this->belongsToMany(Book::class);
    }

    public function available_books() {
        return $this->book()->where('is_deleted','=', 0);
    }
}
