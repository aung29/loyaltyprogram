<?php

namespace App\Http\Controllers;

use App\Models\M_Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    

    public function getShops(){


         $shop  = new M_Shop();
        $shops  = $shop->getDataFromShop();

        // return
    }
}
