<?php

namespace App\Http\Controllers\Rentals;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Product;
use App\Models\ProdCategory;
use App\Models\Rental;
use App\Notifications\ReceivedRent;
// used forsending Emails
use Illuminate\Support\Facades\Mail;
use App\Mail\RentalReqToRenter;
use App\Mail\RentalReqToOwner;

class RentalController extends Controller
{
    public function step1($idProduct)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $product = Product::find($idProduct);
        $prodCategory = ProdCategory::find($product->sub_category);
        $commission_procent = $prodCategory->commission_procent;

        return view('rentals.step1Form', compact('user', 'profile', 'product', 'commission_procent'));
    }

    public function send(Request $request, $idProduct) // State Request
    {
        $this->validate(request(), [
            'start_date' => 'required',
            'start_time' => 'required'
        ]);
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $product = Product::find($idProduct);
        $prodCategory = ProdCategory::find($product->sub_category);
        $commission = $prodCategory->commission;
        $idOwner = $product->user->id;
        $owner = User::find($idOwner);

        // Fill rental Record with new rental request
        $rental = new Rental();
        $rental->owner_id = $product->user->id;
        $rental->renter_id = $userId;
        $rental->product_id = $idProduct;
        $rental->status_id = 1;   // 1 = In Request
        $rental->loan_or_rent = $request->input('loan_or_rent');  // 0 = Rent  - 1 = Loan
        $rental->start_date = $request->input('start_date');
        $rental->start_time = $request->input('start_time');
        $rental->end_date = $request->input('end_date');
        $rental->end_time = $request->input('end_time');
        $rental->end_date_input = $request->input('end_date_input');
        $rental->total_price = $request->input('total_price_field');
        $rental->deposit = $request->input('deposit_field');
        $rental->balance = $request->input('balance_field');
        $rental->warranty_amount = $request->input('warranty_field');
        $rental->commission_procent = $request->input('commission');
        $rental->price_hour = $request->input('price_hour');
        $rental->price_day = $request->input('price_day');
        $rental->price_week = $request->input('price_week');
        $rental->price_month = $request->input('price_month');
        $rental->available_mo = $request->input('available_mo');
        $rental->available_tue = $request->input('available_tue');
        $rental->available_wed = $request->input('available_wed');
        $rental->available_th = $request->input('available_th');
        $rental->available_fr = $request->input('available_fr');
        $rental->available_sat = $request->input('available_sat');
        $rental->available_sun = $request->input('available_sun');
        $rental->hours = $request->input('hours');
        $rental->days = $request->input('days');
        $rental->weeks = $request->input('weeks');
        $rental->months = $request->input('months');
        $rental->rent_info = $request->input('rent_info');
        $rental->save();
        // Notification
        $owner->notify(new ReceivedRent());
        session()->flash('msg', 'success');
        session()->flash('message.content', __('rw_messaging.alert_message'));
        //Send Email to Owner
        Mail::to($rental->owner->email)
            ->send(new RentalReqToOwner($rental));
        // Send Email to Renter
        Mail::to($rental->renter->email)
           ->send(new RentalReqToRenter($rental));
        // Return to site
        dd($rental->owner->email);
        return redirect()->back();
    }

    public function RentList()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $rentals = Rental::where('renter_id', '=', "$userId")->orderBy('id', 'DESC')->get();
        $renting = 1;   // List rentings
        return view('rentals.rentalList', compact('user', 'profile', 'rentals', 'renting'));
    }

    public function LeaseList()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $rentals = Rental::where('owner_id', '=', "$userId")->orderBy('id', 'DESC')->get();
        $renting = 0;  // List leasings
        return view('rentals.rentalList', compact('user', 'profile', 'rentals', 'renting'));
    }
}
