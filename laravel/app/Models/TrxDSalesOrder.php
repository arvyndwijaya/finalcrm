<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxDSalesOrder extends Model
{
    use HasFactory;

    protected $table = 'trx_d_sales_order';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $guarded = ['id'];
}
