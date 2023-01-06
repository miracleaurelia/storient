<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $fillable = ['TransactionID','BookID','qty'];
    public function Book(){
        return $this->belongsTo(Book::class, 'BookID', 'id');
    }
    public function TransactionHeader(){
        return $this->belongsTo(TransactionHeader::class, 'TransactionID', 'id');
    }
}
