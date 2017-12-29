<?php

namespace App\Http\Controllers\Rentit;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\Product;

class RentitController extends Controller
{
    public function step1($idProduct)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $product = product::find($idProduct);

        return view('rentit.step1Form', compact('user', 'profile', 'product'));
    }
}
