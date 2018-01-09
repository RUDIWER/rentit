

<td width="60%" align="left">
    <img src="{{(public_path().'/img/logo/cz-logo-trends.png') }}" alt="cool-zawadi"><br>        
</td>
<h5>
<br>
    <p>Beste {{ $rental->owner->profile->first_name }} {{ $rental->owner->profile->last_name}} 
    <p>Uw profielnaam : {{ $rental->owner->nickname }}</p>
    <p>Proficiat U hebt een Huur / Uitleen aanvraag gekregen.</p>
    <p>Gelieve deze zo spoedig als mogelijk te beantwoorden?</p>
</h5>
<hr>
<b>
    <p>De huurder is profiel {{ $rental->renter->nickname }}</p>
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
Via deze link kan U de aanvraag al dan niet goedkeuren: 
<a href="#">Klik hier</a>
<br>
<br>
<br>
met vriendelijke groeten en veel succes verder,

Het {{ env('APP_APPNAME') }} team
                                 








