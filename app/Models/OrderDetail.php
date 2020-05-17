<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model {
    use SoftDeletes;

    protected $table = 'orders_detail';

    /**
     *
     */
    public function product() {
        $this->belongsTo(Product::class);
    }
}
