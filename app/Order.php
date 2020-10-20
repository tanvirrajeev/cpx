<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function status(){
        return $this->belongsTo('App\Status');
    }

    public function billing(){
        return $this->hasOne('App\Billing');
    }

    protected static function boot(){
        parent::boot();
        // this triggers everytime an Article model is saved
        static::saved(function (Order $order) {
            $bil = new Billing();
            $bil->order_id = $order->id;
            $bil->save();
        });
    }
}
