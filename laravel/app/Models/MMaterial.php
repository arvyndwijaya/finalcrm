<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMaterial extends Model
{
    use HasFactory;

    protected $table = 'materials';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $guarded = ['id'];

    public function scopeSearch($query, $search)
    {
        $query->where(function($where) use($search) {
            $where->orWhere('code', 'ilike', "%{$search}%")
                ->orWhere('name', 'ilike', "%{$search}%")
            ->orWhere('price', 'ilike', "%{$search}%");
        });
    }
}
