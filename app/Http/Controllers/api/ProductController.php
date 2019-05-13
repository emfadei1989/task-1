<?php
namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update(request(['price','name']));

        return ['success' => true];
    }

}