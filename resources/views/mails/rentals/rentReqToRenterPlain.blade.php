

BERICHT VAN HET {{ env('APP.APPNAME') }} TEAM 

Beste {{ $rental->renter->profile->first_name }} {{ $rental->renter->profile->last_name}} 
Uw profielnaam : {{ $rental->renter->nickname }}
Hierbij ontvangt U een kopie van uw huur aanvraag :

    De verhuurder is profiel {{ $rental->owner->nickname }}
   
    Het te huren product : {{ $rental->product->title }}
    Product ID : {{ $rental->product->id }}

Startdatum & uur : {{ $rental->start_date }} {{ $rental->start_hour }}
Einddatum & uur : {{ $rental->end_date }} {{ $rental->end_hour }}

Wij hebben de verhuurder / Uitlener gervraagd om zo spoedig mogelijk te reageren.


met vriendelijke groeten en veel succes verder,

Het {{ env('APP_APPNAME') }} team