<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $fillable = ['UserID'];
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function CartItem(){
        return $this->hasMany(CartItem::class,'CartID','id');
    }
}
