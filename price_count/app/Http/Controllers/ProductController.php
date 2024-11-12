<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function updateQuantity(Request $request)
    {
        $productId = $request->input('id');
        $quantity = $request->input('quantity');

        $product = Product::find($productId);

        if ($product) {
            $newPrice = $product->price * $quantity;

            return response()->json([
                'success' => true,
                'newPrice' => $newPrice
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }
}
