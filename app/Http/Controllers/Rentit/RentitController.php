<?php

namespace App\Http\Controllers\Rentit;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Product;
use App\Models\ProdCategory;

class RentitController extends Controller
{
    public function step1($idProduct)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $product = Product::find($idProduct);
        $prodCategory = ProdCategory::find($product->sub_category);
        $commission = $prodCategory->commission;

        return view('rentit.step1Form', compact('user', 'profile', 'product', 'commission'));
    }

    public function send(Request $request, $idProduct)
    {
        $this->validate(request(), [
        ]);
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $product = Product::find($idProduct);
        $prodCategory = ProdCategory::find($product->sub_category);
        $commission = $prodCategory->commission;

        dd($request);
        //$name = $request->input('name');
    }
}
