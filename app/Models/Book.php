<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $primaryKey = "id";
    protected $fillable = ['image','bookTitle','author','price','description','pageCount','releaseYear','category','preview'];
    use HasFactory;
    public function CartItem(){
        return $this->belongsTo(CartItem::class);
    }
}
