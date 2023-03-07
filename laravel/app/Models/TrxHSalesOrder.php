<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrxHSalesOrder extends Model
{
    use HasFactory;

    protected $table = 'trx_h_sales_order';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $guarded = ['id'];

    public function salesOrderDetail(Type $var = null): HasMany
    {
        return $this->hasMany(TrxDSalesOrder::class, 'so_h_id', 'id');
    }

    public function customer(): HasOne
    {
        return $this->hasOne(MCustomer::class, 'id', 'customer_id');
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function($where) use($search) {
            $where->orWhere('invoice', 'ilike', "%{$search}%")
                ->orWhere('date', 'ilike', "%{$search}%")
                ->orWhereRelation('customer', 'code', 'ilike', "%{$search}%")
            ->orWhereRelation('customer', 'name', 'ilike', "%{$search}%");
        });
    }
}
