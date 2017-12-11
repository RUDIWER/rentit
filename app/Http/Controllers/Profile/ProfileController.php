<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $gender = $user->gender;
        return view('profile.profileForm', compact('gender', 'user', 'profile'));
    }

    public function save(Request $request)
    {
        $this->validate(request(), [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'birthday' => 'required|max:10',
            'nationality' => 'max:30',
            'addr1_street' => 'required|max:40',
            'addr1_housenr' => 'required|max:15',
            'addr1_bus' => 'max:10',
            'addr1_postcode' => 'required|max:20',
            'addr1_city' => 'required|max:30',
            'addr1_country' => 'required|max:30',
            'phone_1' => 'max:20',
            'mobile_1' => 'max:20',
            'fax_1' => 'max:20',
            'company_name' => 'max:30',
            'vat_number' => 'max:20|required_unless:company_name,',
            'company_addr_street' => 'max:40|required_unless:company_name,',
            'company_addr_housenr' => 'max:15|required_unless:company_name,',
            'company_addr_bus' => 'max:10',
            'company_addr_postcode' => 'max:20|required_unless:company_name,',
            'company_addr_city' => 'max:30|required_unless:company_name,',
            'company_addr_country' => 'max:30|required_unless:company_name,'
        ]);
        $data = $request->except('toggle_newsletter');
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $profile->fill($data);
        if ($profile->company_name) {
            $profile->company = '1';
        }
        $profile->updated_at = date('Y-m-d H:i:s');
        // GEO PROVIDER
        $address = $profile->addr1_housenr . ' ' . $profile->addr1_street . ' ' . $profile->addr1_city . ' ' . $profile->addr1_postcode . ' ' . $profile->addr1_country;
        $geo = app('geocoder')->geocode($address)->get()->first();
        $geoLatitude = $geo->getCoordinates()->getlatitude();
        $geoLongitude = $geo->getCoordinates()->getlongitude();
        $geoAddress = $geo->getformattedAddress();
        $geoCountryName = $geo->getCountry()->getname();
        $geoCountryCode = $geo->getCountry()->getcode();
        $geoProvider = $geo->getprovidedBy();
        $profile->geo_latitude = $geoLatitude;
        $profile->geo_longitude = $geoLongitude;
        $profile->geo_address = $geoAddress;
        $profile->geo_country_name = $geoCountryName;
        $profile->geo_country_code = $geoCountryCode;
        $profile->geo_provider = $geoProvider;
        if ($request->hasFile('avatar')) {
            $profilePicPath = '/public/img/profile/' . $userId;
            Storage::deleteDirectory($profilePicPath);
            $profileImage = $request->file('avatar')->store($profilePicPath);
            $imagePath = '/storage/' . substr($profileImage, 6);
            $profile->picture = $imagePath;
        }

        $profile->save();

        // If address is changed change also latitude and longitude in products
        $products = $user->products()->get();
        foreach ($products as $product) {
            $product->geo_latitude = $profile->geo_latitude;
            $product->geo_longitude = $profile->geo_longitude;
            $product->save();
        }
        session()->flash('msg', 'success');
        return redirect()->back()->withInput();
    }

    public function contact($idUser)
    {
        $loggedInUserId = Auth::id();
        if ($loggedInUserId) {
            $loggedInUser = User::find($loggedInUserId);
            $loggedInProfile = $loggedInUser->profile;
        }
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;

        if ($loggedInUserId) {
            return view('profile.contactForm', compact('loggedInUser', 'loggedInProfile', 'profile'));
        }
    }
}

     // DD vervanger via ajax ! BELANGRIJK !!!!!
     //   $data = $request->all(); // This will get all the request data.
     //   dd($data); // This will dump and
     // Also you can use var_dump to dump to console
