<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\RatingResource;
use App\Product;
use App\User;
use Gate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    public function rate(Product $product, Request $request)
    {
        $this->validate($request, [
            'score' => 'required'
        ]);

        $user = $request->user();
        $user->rate($product, $request->get('score'));

        return new ProductResource($product);
    }

    public function unrate(Product $product, Request $request)
    {
        $user = $request->user();
        $user->unrate($product);

        return new ProductResource($product);
    }
}