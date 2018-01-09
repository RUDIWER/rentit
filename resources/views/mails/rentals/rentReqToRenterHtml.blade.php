

<td width="60%" align="left">
    <img src="{{(public_path().'/img/logo/cz-logo-trends.png') }}" alt="cool-zawadi"><br>        
</td>
<h5>
<br>
    <p>Beste {{ $rental->renter->profile->first_name }} {{ $rental->renter->profile->last_name}} 
    <p>Uw profielnaam : {{ $rental->renter->nickname }}</p>
    <p>Hierbij ontvangt U een kopie van uw huur aanvraag :</p>
</h5>
<hr>
<b>
    <p>De verhuurder is profiel {{ $rental->owner->nickname }}</p>
    <br>
    <p>Het te huren product : {{ $rental->product->title }}</p>
    <p>Product ID : {{ $rental->product->id }}</p>
</b>
<hr>
<p>Startdatum & uur : {{ $rental->start_date }} {{ $rental->start_hour }}</p> 
<p>Einddatum & uur : {{ $rental->end_date }} {{ $rental->end_hour }}</p>
<br>
<br>
<br>
<p>Wij hebben de verhuurder / Uitlener gervraagd om zo spoedig mogelijk te reageren.</p>
<br>
<br>
<br>
met vriendelijke groeten en veel succes verder,

Het {{ env('APP_APPNAME') }} team
                                 







