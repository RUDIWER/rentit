BERICHT VAN HET {{ env('APP_APPNAME') }} TEAM 


Beste {{ $rental->owner->profile->first_name }} {{ $rental->owner->profile->last_name}} 
Uw profielnaam : {{ $rental->owner->nickname }}
Proficiat U hebt een Huur / Uitleen aanvraag gekregen.
Gelieve deze zo spoedig als mogelijk te beantwoorden?

De huurder is profiel {{ $rental->renter->nickname }}
Het te huren product : {{ $rental->product->title }}
Product ID : {{ $rental->product->id }}

Startdatum & uur : {{ $rental->start_date }} {{ $rental->start_hour }}
Einddatum & uur : {{ $rental->end_date }} {{ $rental->end_hour }}

Via deze link kan U de aanvraag al dan niet goedkeuren: 

met vriendelijke groeten en veel succes verder,

Het {{ env('APP_APPNAME') }} team
                                 