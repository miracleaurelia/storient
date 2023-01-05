<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $fillable = ['CartID','BookID'];
    public function Cart(){
        return $this->belongsTo(Cart::class, 'CartID', 'id');
    }
    public function Book(){
        return $this->belongsTo(Book::class, 'BookID', 'id')->where('is_deleted','=',0);
    }

}
