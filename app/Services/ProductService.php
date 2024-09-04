<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Request;

class ProductService{
    public function productStore($data){

        return Product::create($data);
        // $product = new
    }
}
