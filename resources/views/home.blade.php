@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-3">LORENto</h1>
                <p class="lead">Het sociale Deel en verhuur platform</p>
                <hr class="my-2">
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Meer info?</a>
                </p>
            </div>
        </div>
        
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-primary">
                <div class="card-header"><h4>{{__('rw_login.home_page')}}</h4></div>
                <div class="card-body">
                    <br>
                    <form class="form" role="form" name="searchForm" id="searchForm" method="POST" action="/search-results">
                    <input type="hidden" id="latitude" name="latitude"> 
                    <input type="hidden" id="longitude" name="longitude"> 
                    <input type="hidden" id="postcode" name="postcode"> 
                    <input type="hidden" id="city" name="city"> 

                    {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="search_pors" class="text-primary">{{__('rw_home.pors')}}</label>
                                <div class="input-group rw-icons">
                                    <select class="form-control rw-input" id="pors" name="search_pors">
                                        <option value="empty" selected disabled>{{__('rw_home.select')}}</option>
                                        @foreach($porses as $pors)
                                            <option value="{{ $pors->id }}">{{$pors->category_name}}</option>  
                                        @endforeach
                                    </select> 
                                    <i class="material-icons">arrow_drop_down_circle</i>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="search_what" class="text-primary">{{__('rw_home.search_what')}}</label>
                                <input type="text" class="form-control rw-input" id="search_what" name="search_what"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="search_where" class="text-primary">{{__('rw_home.search_where')}}</label>
                                <div id="locationField">
                                    <input type="text" class="form-control rw-input" id="search_where"  name="search_where" onFocus="geolocate()" placeholder=""/>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="search_dist" class="text-primary">{{__('rw_home.search_dist')}}</label>
                                <div class="input-group rw-icons">
                                    <select class="form-control rw-input" id="search_dist" name="search_dist" title="{{__('rw_home.select')}}">
                                        <option selected value="0">{{__('rw_home.in_city')}}</option>  
                                        <option value="7">{{__('rw_home.5_km')}}</option>
                                        <option value="12">{{__('rw_home.10_km')}}</option>
                                        <option value="22">{{__('rw_home.20_km')}}</option>
                                        <option value="52">{{__('rw_home.50_km')}}</option>
                                        <option value="999">{{__('rw_home.999_km')}}</option>
                                    </select> 
                                    <i class="material-icons">arrow_drop_down_circle</i>
                                </div>
                            </div>
                        </div> 
                        <div id="submit-div">
                            <button id="submit" type="submit" class="btn btn-primary">
                                <i class="material-icons" style="font-size:30px; vertical-align: middle;">search</i>  
                                {{__('rw_home.search')}}
                            </button>  
                        </div>       
                    </form>           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript" charset="utf-8">

$(document).ready(function() {

    //Disable button and distance field on open screen
    $('#submit').prop('disabled', true);
    $('#search_dist').prop('disabled', true);

    $('#pors').change(function() {
        if($(this).val()){
                $('#submit').prop('disabled', false); 
        }  
    });

    $('#search_where').change(function() {
        if($(this).val()){
            $('#search_dist').prop('disabled', false); 
        }  
    })
});


function initAutocomplete() {
    var options = {
        types: ['(regions)'],
        componentRestrictions: {country: ["be", "nl"]}
    };
    autocomplete = new google.maps.places.Autocomplete((document.getElementById('search_where')),options);
    autocomplete.addListener('place_changed', getAddress);   
}


// Checks your location and does suggestions in neigberhood first
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };

        var circle = new google.maps.Circle({
            center: geolocation,
            radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
        });
    }
}

function getAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    var lat = place.geometry.location.lat();
    document.getElementById("latitude").value = lat;
    // get lng
    var lng = place.geometry.location.lng();
    document.getElementById("longitude").value = lng;
   
    for (var i = 0; i < place.address_components.length; i++) {
      for (var j = 0; j < place.address_components[i].types.length; j++) {
        if (place.address_components[i].types[j] == "postal_code") {
            postcode = place.address_components[i].long_name;
            document.getElementById("postcode").value = postcode;
        }

        if (place.address_components[i].types[j] == "locality") {
            city = place.address_components[i].long_name;
            document.getElementById("city").value = city;

        }


      }
    }
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_JS_API_KEY') }} &libraries=places&callback=initAutocomplete" async defer>
</script>
@endsection

