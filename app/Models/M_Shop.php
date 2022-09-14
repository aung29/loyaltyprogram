<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_Shop extends Model
{
    use HasFactory;

        public $table = 'm_ad_shop';



    public function getDataFromShop(){

        $count = M_Shop::count();
        $skip = 1;
        $current = $count- $skip;
      $shops =  DB::table('m_ad_shop')
        ->skip($skip)
        ->take($current)
        ->get();

        return $shops;
    }   


   

    public function card()
    {
    
         return $this->hasMany('App\Models\M_Card');
    }
}
