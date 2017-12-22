<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\Debugbar\Facade as Debugbar;
use App\Models\User;
use App\Models\Profile;
use App\Models\Product;
use App\Models\ProdCategory;

//use Session;

class ProductController extends Controller
{
    public function list()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $products = Product::all();

        return view('products.productList', compact('user', 'profile', 'products'));
    }

    public function create()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $product = new Product();
        $product->user_id = $userId;
        $porses = ProdCategory::where('parent_category_id', '=', 0)->get();
        $groups = '';
        $isNew = 1;

        return view('products.productForm', compact('product', 'porses', 'userId', 'user', 'profile', 'isNew'));
    }

    public function edit($idProduct)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $product = product::find($idProduct);
        $porses = ProdCategory::where('parent_category_id', '=', 0)->get();
        $groups = ProdCategory::where('parent_category_id', '=', $product->pors)->get();
        $categories = ProdCategory::where('parent_category_id', '=', $product->group)->get();
        $subCategories = ProdCategory::where('parent_category_id', '=', $product->category)->get();
        $isNew = 0;

        return view('products.productForm', compact('product', 'porses', 'groups', 'categories', 'subCategories', 'userId', 'user', 'profile', 'isNew'));
    }

    public function view($idProduct)
    {
        $userId = Auth::id();
        if ($userId) {
            $user = User::find($userId);
            $profile = $user->profile;
        }
        $product = product::find($idProduct);
        $porses = ProdCategory::where('parent_category_id', '=', 0)->get();
        $groups = ProdCategory::where('parent_category_id', '=', $product->pors)->get();
        $categories = ProdCategory::where('parent_category_id', '=', $product->group)->get();
        $subCategories = ProdCategory::where('parent_category_id', '=', $product->category)->get();

        if ($userId) {
            return view('products.productView', compact('product', 'profile', 'categories'));
        } else {
            return view('products.productView', compact('product', 'categories'));
        }
    }

    public function save(Request $request, $idProduct)
    {
        //dd($request);
        $this->validate(request(), [
            'pors' => 'required|max:2|numeric',
            'group' => 'required|max:30|exists:prod_categories,id',
            'category' => 'required|max:30|exists:prod_categories,id',
            'sub_category' => 'required|max:30||exists:prod_categories,id',
            'title' => 'required|max:60',
            'sub_title' => 'required|max:60',
            'description' => 'required|min:10|max:200',
            'warranty_amount' => 'required_unless:is_warranty,',
            'warranty_description' => 'max:200|required_unless:is_warranty,',
            'home_delivery_amount' => 'required_unless:is_home_delivery,',
            'home_delivery_description' => 'required_unless:is_home_delivery,'
        ]);
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $data = $request->except('product_id', 'productPic1', 'productPic2', 'productPic3', 'productPic4', 'productPic5', 'productPic6', 'productPic7', 'productPic8', 'toggle_belgium', 'toggle_netherlands', 'toggle_warranty', 'toggle_home_delivery', 'toggle_mo', 'toggle_tue', 'toggle_wed', 'toggle_th', 'toggle_fr', 'toggle_sat', 'toggle_sun');
        $product = product::findornew($idProduct);
        $product->geo_latitude = $profile->geo_latitude;
        $product->geo_longitude = $profile->geo_longitude;
        $product->fill($data);
        $product->user_id = $userId;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->save();

        if ($request->hasFile('productPic1')) {
            $productPicPath1 = '/public/img/products/' . $userId . '/' . $product->id . '/pic1';
            Storage::deleteDirectory($productPicPath1);
            $image1 = $request->file('productPic1')->store($productPicPath1);
            $imagePath1 = '/storage/' . substr($image1, 6);
            $product->picture_1 = $imagePath1;
        }
        if ($request->hasFile('productPic2')) {
            $productPicPath2 = '/public/img/products/' . $userId . '/' . $product->id . '/pic2';
            Storage::deleteDirectory($productPicPath2);
            $image2 = $request->file('productPic2')->store($productPicPath2);
            $imagePath2 = '/storage/' . substr($image2, 6);
            $product->picture_2 = $imagePath2;
        }
        if ($request->hasFile('productPic3')) {
            $productPicPath3 = '/public/img/products/' . $userId . '/' . $product->id . '/pic3';
            Storage::deleteDirectory($productPicPath1);
            $image3 = $request->file('productPic3')->store($productPicPath3);
            $imagePath3 = '/storage/' . substr($image3, 6);
            $product->picture_3 = $imagePath3;
        }
        if ($request->hasFile('productPic4')) {
            $productPicPath4 = '/public/img/products/' . $userId . '/' . $product->id . '/pic4';
            Storage::deleteDirectory($productPicPath4);
            $image4 = $request->file('productPic4')->store($productPicPath4);
            $imagePath4 = '/storage/' . substr($image4, 6);
            $product->picture_4 = $imagePath4;
        }
        if ($request->hasFile('productPic5')) {
            $productPicPath5 = '/public/img/products/' . $userId . '/' . $product->id . '/pic5';
            Storage::deleteDirectory($productPicPath5);
            $image5 = $request->file('productPic5')->store($productPicPath5);
            $imagePath5 = '/storage/' . substr($image5, 6);
            $product->picture_5 = $imagePath5;
        }
        if ($request->hasFile('productPic6')) {
            $productPicPath6 = '/public/img/products/' . $userId . '/' . $product->id . '/pic6';
            Storage::deleteDirectory($productPicPath6);
            $image6 = $request->file('productPic6')->store($productPicPath6);
            $imagePath6 = '/storage/' . substr($image6, 6);
            $product->picture_6 = $imagePath6;
        }
        if ($request->hasFile('productPic7')) {
            $productPicPath7 = '/public/img/products/' . $userId . '/' . $product->id . '/pic7';
            Storage::deleteDirectory($productPicPath7);
            $image7 = $request->file('productPic7')->store($productPicPath7);
            $imagePath7 = '/storage/' . substr($image7, 6);
            $product->picture_7 = $imagePath7;
        }
        if ($request->hasFile('productPic8')) {
            $productPicPath8 = '/public/img/products/' . $userId . '/' . $product->id . '/pic8';
            Storage::deleteDirectory($productPicPath8);
            $image8 = $request->file('productPic8')->store($productPicPath8);
            $imagePath8 = '/storage/' . substr($image8, 6);
            $product->picture_8 = $imagePath8;
        }
        $product->save();

        session()->flash('msg', 'success');
        return redirect()->back()->withInput();
    }

    public function delete($idProduct)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $product = product::find($idProduct);
        $product->delete();
        $products = Product::al();

        return view('products.productList', compact('products', 'userId', 'user', 'profile'));
    }

    public function ajaxGetGroup($groupId)
    {
        $groups = ProdCategory::where('parent_category_id', '=', $groupId)->get();
        return json_encode($groups);
    }
}

     // DD vervanger via ajax ! BELANGRIJK !!!!!
     //   $data = $request->all(); // This will get all the request data.
     //   dd($data); // This will dump and
     // Also you can use var_dump to dump to console
     // OR :  dd(json_encode($request));
     // OR with debugBar : Debugbar::info($request);
