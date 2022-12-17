<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $fillable = ['UserID','totalPrice','paymentProof','isApproved'];
    public function User(){
        return $this->belongsTo(User::class,'UserID','id');
    }
    public function TransactionDetail(){
        return $this->hasMany(TransactionDetail::class, 'TransactionID', 'id');
    }
}
