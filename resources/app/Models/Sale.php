<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model {
    protected $fillable = ['sale_date', 'region_id', 'salesperson_id'];
    public function region() { return $this->belongsTo(Region::class); }
    public function salesperson() { return $this->belongsTo(Salesperson::class); }
    public function saleItems() { return $this->hasMany(SaleItem::class); }
}

