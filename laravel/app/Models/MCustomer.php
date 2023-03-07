<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MCustomer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $guarded = ['id'];

    public function scopeSearch($query, $search)
    {
        $query->where(function($where) use($search) {
            $where->orWhere('code', 'ilike', "%{$search}%")
                ->orWhere('name', 'ilike', "%{$search}%")
                ->orWhere('email', 'ilike', "%{$search}%")
                ->orWhere('city', 'ilike', "%{$search}%")
                ->orWhere('no_handphone', 'ilike', "%{$search}%")
            ->orWhere('address', 'ilike', "%{$search}%");
        });
    }

    public function customerReceipts(): HasMany
    {
        return $this->hasMany(MCustomerReceipt::class, 'customer_id', 'id');
    }
}
