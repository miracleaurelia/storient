<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $primaryKey = "id";
    protected $guarded = ['id'];
    use HasFactory;
    public function CartItem(){
        return $this->belongsTo(CartItem::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function category()
    {
    	return $this->belongsToMany(Category::class);
    }
}
