<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\Profile;
use App\Models\ProdCategory;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $porses = ProdCategory::where('parent_category_id', '=', 0)->get();
        if ($userId) {
            $user = User::find($userId);
            if ($user) {
                $profile = $user->profile;
            } else {
                $this->events->fire('auth.logout', [$user]);
            }
        }
        return view('home', compact('profile', 'porses'));
    }

    public function resultGroup($idGroup)
    {
        $userId = Auth::id();
        if ($userId) {
            $user = User::find($userId);
            $profile = $user->profile;
        }
        $categories = ProdCategory::all();

        $products = Product::where('group', '=', $idGroup)->paginate(10);
        if ($userId) {
            return view('results', compact('products', 'profile', 'categories'));
        } else {
            return view('results', compact('products', 'categories'));
        }
    }

    public function resultCategory($idCategory)
    {
        $userId = Auth::id();
        if ($userId) {
            $user = User::find($userId);
            $profile = $user->profile;
        }
        $categories = ProdCategory::all();

        $products = Product::where('category', '=', $idCategory)->paginate(10);
        if ($userId) {
            return view('results', compact('products', 'profile', 'categories'));
        } else {
            return view('results', compact('products', 'categories'));
        }
    }

    public function resultSubCategory($idSubCategory)
    {
        $userId = Auth::id();
        if ($userId) {
            $user = User::find($userId);
            $profile = $user->profile;
        }
        $categories = ProdCategory::all();

        $products = Product::where('sub_category', '=', $idSubCategory)->paginate(10);
        if ($userId) {
            return view('results', compact('products', 'profile', 'categories'));
        } else {
            return view('results', compact('products', 'categories'));
        }
    }

    public function searchResults(Request $request)
    {
        // VALIDATE FORM !!!!!!!!!!!!!!!!!!!!!!!!!!!
        $userId = Auth::id();
        $categories = ProdCategory::all();
        $porses = ProdCategory::where('parent_category_id', '=', 0)->get();
        if ($userId) {
            $user = User::find($userId);
            $profile = $user->profile;
        }
        $pors = $request->search_pors;
        global $what;
        $what = $request->search_what;
        $radius = $request->search_dist;
        global $city;
        if ($request->city) {
            $city = $request->city;
        } else {
            $city = $request->search_where;
            $radius = 0;
        }
        global $postcode;
        $postcode = $request->postcode;
        $distance = $request->search_dist;
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        //(RW) If postcode come with Gmaps loacation  make search on postcode if not make search on city field !
        if ($postcode and $radius == 0) {
            $products = Product::with('user')->with('user.profile')
            ->whereHas('user.profile', function ($q) {
                global $postcode;
                $q->where('addr1_postcode', '=', $postcode);
            })
            ->where('pors', '=', $pors)
            ->where(function ($query) {
                global $what;
                $query->where('title', 'LIKE', '%' . $what . '%');
                $query->orwhere('description', 'LIKE', '%' . $what . '%');
                $query->orwhere('sub_title', 'LIKE', '%' . $what . '%');
            })->paginate(10);
        } elseif ($city and $radius == 0) {
            $products = Product::with('user')->with('user.profile')
            ->whereHas('user.profile', function ($q) {
                global $city;
                $q->where('addr1_city', '=', $city);
            })
            ->where('pors', '=', $pors)
            ->where(function ($query) {
                global $what;
                $query->where('title', 'LIKE', '%' . $what . '%');
                $query->orwhere('description', 'LIKE', '%' . $what . '%');
                $query->orwhere('sub_title', 'LIKE', '%' . $what . '%');
            })->paginate(10);
        } elseif ($radius > 0 and $radius < 999) {
            $products = Product::select('products.*')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                            cos( radians( geo_latitude ) )
                            * cos( radians( geo_longitude ) - radians(?)
                            ) + sin( radians(?) ) *
                            sin( radians( geo_latitude ) ) )
                            ) AS distance', [$latitude, $longitude, $latitude])
            ->havingRaw('distance < ?', [$radius])
            ->where('pors', '=', $pors)
            ->where(function ($query) {
                global $what;
                $query->where('title', 'LIKE', '%' . $what . '%');
                $query->orwhere('description', 'LIKE', '%' . $what . '%');
                $query->orwhere('sub_title', 'LIKE', '%' . $what . '%');
            })->get();

            // Items per page // (rw) use maual paginator here because off distance field problem
            $perPage = 10;
            $pageStart = request('page', 1);
            $offSet = ($pageStart * $perPage) - $perPage;
            $totalItems = count($products);
            $itemsForCurrentPage = $products->slice($offSet, $perPage);
            $products = new LengthAwarePaginator(
                $itemsForCurrentPage,
                $totalItems,
                $perPage,
                Paginator::resolveCurrentPage(),
                ['path' => Paginator::resolveCurrentPath()]
            );
        } else {
            $products = Product::with('user')->with('user.profile')
            ->where('pors', '=', $pors)
            ->where(function ($query) {
                global $what;
                $query->where('title', 'LIKE', '%' . $what . '%');
                $query->orwhere('description', 'LIKE', '%' . $what . '%');
                $query->orwhere('sub_title', 'LIKE', '%' . $what . '%');
            })->paginate(10);
        }
        if ($userId) {
            return view('results', compact('products', 'profile', 'pors', 'categories'));
        } else {
            return view('results', compact('products', 'pors', 'categories'));
        }
    }
}
