@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <input type="hidden" id="price_hour" name="price_hour" value="{{ $product->price_hour }}"/> 
        <input type="hidden" id="price_day" name="price_day" value="{{ $product->price_day }}"/> 
        <input type="hidden" id="price_week" name="price_week" value="{{ $product->price_week }}"/> 
        <input type="hidden" id="price_month" name="price_month" value="{{ $product->price_month }}"/> 


        <div class="row justify-content-md-centerrow justify-content-md-center">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header text-white bg-primary rw-title"  style="padding-top:§px; padding-bottom:0px;">
                        <h5>
                            <div class="row h-100 justify-content-center align-items-center"> 
                                <i class="material-icons" style="font-size: 40px">add_shopping_cart</i>  
                                &nbsp  
                                {{__('rw_rentit.step1_title')}}  
                            </div>
                        </h5>
                    </div>
            <!-- BUTTON BAR  -->
                    <div class="card-header rw-buttonbar" style="padding:5px;">  
                        <b> 
                            <a class="rw-icons rw-grey" href="javascript:history.back()">
                                <i class="material-icons">arrow_back</i> 
                                {{__('rw_products.back')}}
                            </a>
                        </b>
                    </div>
                    <br>
            <!-- CARD BODY -->
                    <div class="card-body"> 
                        <div class="alert alert-info alert-block">
                                  Meer info over de werkwijze :
                        </div>

                        U wenst het volgende product te huren : {{ $product->title}}<br>
                        De verhuurder is : {{ $product->user->nickname }} uit : {{ $product->user->profile->addr1_city }} ({{ $product->user->profile->addr1_postcode }})<br>
                        De verhuurder is een : 
                        @if($product->user->profile->company == 0)
                            {{__('rw_results.particulier')}} </a>
                        @else
                            {{__('rw_results.prof')}}</a>   
                        @endif  
                        
                        <br>

                        LEVERING MOGELIJK ?????

                        <hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7">
                                    <form class="form" role="form" name="step1Form" id="step1Form" method="POST" enctype="multipart/form-data"  action="/rentit/step-1/save">        
                                        <div class="form-row">
                                            <div class="form-group col-md-5">                              
                                                <label for="start_date" class="col-form-label text-primary">{{__('rw_rentit.start_date')}}</label>
                                                <input type="date" class="form-control rw-input" id="start_date" name="start_date" value="{{ old('start_date') }}"/> 
                                            </div>
                                            <div class="form-group col-md-4">                              
                                                <label for="start_time" class="col-form-label text-primary">{{__('rw_rentit.start_time')}}</label>
                                                <input type="time" class="form-control rw-input" id="start_time" name="start_time" value="{{ old('start_time') }}"/> 
                                            </div>
                                        </div>
                                        <div class="form-row">  
                                            <div class="form-group col-md-4 hours-group">                              
                                                <label for="hours" class="col-form-label text-primary">{{__('rw_rentit.quant_hours')}}</label>
                                                <input type="number" min="0" max="24" class="form-control rw-input" id="hours" name="hours" value="{{ old('end_date') }}"/> 
                                            </div>
                                        </div>
                                        <div class="form-row"> 
                                            <div class="form-group col-md-4 days-group">                              
                                                <label for="days" class="col-form-label text-primary">{{__('rw_rentit.quant_days')}}</label>
                                                <input type="number" min="0" max="7" class="form-control rw-input" id="days" name="days" value="{{ old('end_date') }}"/> 
                                            </div>
                                        </div>
                                        <div class="form-row"> 
                                            <div class="form-group col-md-4 weeks-group">                              
                                                <label for="weeks" class="col-form-label text-primary">{{__('rw_rentit.quant_weeks')}}</label>
                                                <input type="number" min="0" max="4" class="form-control rw-input" id="weeks" name="weeks" value="{{ old('end_date') }}"/> 
                                            </div>
                                        </div>
                                        <div class="form-row"> 
                                            <div class="form-group col-md-4 months-group">                              
                                                <label for="months" class="col-form-label text-primary">{{__('rw_rentit.quant_months')}}</label>
                                                <input type="number" min="0" max="12" class="form-control rw-input" id="months" name="months" value="{{ old('end_date') }}"/> 
                                            </div>
                                        </div>            
                                        <div class="form-row">  
                                            <div class="form-group col-md-12">                              
                                                <label for="rent_info" class="col-form-label text-primary">{{__('rw_rentit.info')}}</label>
                                                <textarea type="text" class="form-control rw-input" rows="5" id="rent_info" name="rent_info">{{ old('rent_info') }}</textarea> 
                                            </div>
                                        </div> 
                                    </form>
                                </div>
                                <div class="col-md-5">
                                    <b><p id="message">Vul het formulier in </p></b>
                                    Prijs informatie<br>
                                    Totale huurprijs (ex. waarborg):<br>
                                    Bestaande uit :
                                    Voorschot (te betalen via deze site) :<br>
                                    Saldo (Te betalen aan de verhuurder) :<br>
                                    

                                    Waarborg bedrag (te betalen aan de verhuurder) : <br>



                                    </b>

                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"> 
                       
                    </div>
                </div>
            </div>
        </div>   
    </div>

@endsection
@section('javascript')
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
        // Get product vars
        var priceHour = $('#price_hour').val();
        var priceDay = $('#price_day').val();
        var priceWeek = $('#price_week').val();
        var priceMonth = $('#price_month').val();



// Calculate rent price !!!
            $("#calcButton").on('click', function() {
                var startDate = new Date($('#start_date').val());
                var endDate = new Date($('#end_date').val());
                var startTime = $('#start_time').val();
                var endTime = $('#end_time').val();

            // Meer dan 1 dag
                if(endDate > startDate){
                    // Get Vars
                    var diff = new Date(endDate - startDate);
                    var days = diff/1000/60/60/24;
                    console.log(days + 'Dagen');
            // Per uur
                }else if(endDate < startDate){
                    console.log('Verkeerde datums');
                }else{
                    // Get vars
                    var startHour = startTime.slice(0,2);
                    var endHour = endTime.slice(0,2);
                    var startMinutes = startTime.slice(-2);
                    var endMinutes = endTime.slice(-2);
                //Geen verhuur per uur
                    if(!priceHour || priceHour == 0){
                        console.log('niet per uur');
                        $("#message").text("Geen verhuur per uur mogelijk !");
                    }
                   
   
                }
            });  
        });
    </script>
@endsection
