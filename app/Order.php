<?php

namespace App;
use Carbon\Carbon;
use App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model{

    protected $fillable = [
        'users_id', 'ecomordid', 'ecomname', 'ecomproddesc', 'ecompurchaseamt', '	ecomorddt', 'consigneename', 'consigneeaddrs', 'ecomprdtraclnk', 'ecomsppngpriority', 'ecomrcvby', 'ecomawb', '	note', 'status_id', 'awb', 'updatedby',
    ];

    public function status(){
        return $this->belongsTo('App\Status');
    }

    public function billing(){
        return $this->hasOne('App\Billing');
    }

    public function history()
    {
        return $this->hasMany('App\History');
    }

    protected static function boot(){
        parent::boot();
        // this triggers everytime an Billing model is saved
        static::created(function (Order $order) {
            $bil = new Billing();
            $bil->order_id = $order->id;
            $bil->save();
        });

        static::saved(function (Order $order) {

            // $user_name = User::find($order->updatedby);


            $his = new History();
            $his->order_id = $order->id;
            $his->status_id = $order->status_id;
            $his->user_id = $order->updatedby;
            // $his->user_name = $user_name->name;
            $his->note = $order->note;
            $his->awb = $order->awb;
            $his->reveived_by = $order->ecomrcvby;
            $his->save();
        });

    }

    public function getCreatedAtAttribute($value){
    return Carbon::parse($value)->format('d-M-Y');
    }

}
