<?php

namespace App\Models;

use App\Models\InvoiceDetail;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function payment(){
    	return $this->hasOne(Payment::class, 'invoice_id', 'id');
    }

    public function invoice_details(){
    	return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id');
    }

}
