@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <form id="step1Form" class="form" method="POST" enctype="multipart/form-data"  action="/rentit/step-1/send/{{ $product->id }}">
        {{ csrf_field() }}
            <input type="hidden" id="price_hour" name="price_hour" value="{{ $product->price_hour }}"/> 
            <input type="hidden" id="price_day" name="price_day" value="{{ $product->price_day }}"/> 
            <input type="hidden" id="price_week" name="price_week" value="{{ $product->price_week }}"/> 
            <input type="hidden" id="price_month" name="price_month" value="{{ $product->price_month }}"/> 
            <input type="hidden" id="commission" name="commission" value="{{ $commission }}"/> 

            <input type="hidden" id="available_mo" name="available_mo" value="{{ $product->available_mo }}"/> 
            <input type="hidden" id="available_tue" name="available_tue" value="{{ $product->available_tue }}"/> 
            <input type="hidden" id="available_wed" name="available_wed" value="{{ $product->available_wed }}"/> 
            <input type="hidden" id="available_th" name="available_th" value="{{ $product->available_th }}"/> 
            <input type="hidden" id="available_fr" name="available_fr" value="{{ $product->available_fr }}"/> 
            <input type="hidden" id="available_sat" name="available_sat" value="{{ $product->available_sat }}"/> 
            <input type="hidden" id="available_sun" name="available_sun" value="{{ $product->available_sun }}"/> 
            <input type="hidden" id="loan_or_rent" name="loan_or_rent" value="{{ $product->loan_or_rent }}"/> 

            <input type="hidden" id="end_date_input" name="end_date_input"/> 

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
                                <a id="submit-link" class="rw-icons rw-grey pull-right" href="#"> 
                                    <i class="material-icons" style="font-size:30px; vertical-align: middle;">live_help</i>
                                    {{__('rw_rentit.send_step1')}}
                                </a>  
                            </b>
                        </div>
                        <br>
                <!-- CARD BODY -->
                        <div class="card-body"> 
                            <div class="alert alert-info alert-block">  
                                <i class="material-icons" style="font-size:30px; vertical-align: middle;">help</i>
                                {{__('rw_rentit.more_info')}}
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <b><label class="col-form-label text-primary">{{__('rw_rentit.what_to_rent')}}</label></b>
                                </div>
                                <div class="col-md-7">
                                    <b style="  font-size: 1.2em;">{{ $product->title}}</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <b><label class="col-form-label text-primary">{{__('rw_rentit.rent_person')}}</label></b>
                                </div>
                                <div class="col-md-7">
                                    <b style="  font-size: 1.2em;">{{ $product->user->nickname }} {{__('rw_rentit.from')}} {{ $product->user->profile->addr1_city }} ({{ $product->user->profile->addr1_postcode }})  {{ $product->user->profile->addr1_country }}  </b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <b><label class="col-form-label text-primary">{{__('rw_rentit.rent_person_state')}}</label></b>
                                </div>
                                <div class="col-md-7">
                                    <b style="  font-size: 1.2em;"> 
                                        @if($product->user->profile->company == 0)
                                            {{__('rw_results.particulier')}} </a>
                                        @else
                                            {{__('rw_results.prof')}}</a>   
                                        @endif  
                                    </b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <b><label class="col-form-label text-primary">{{__('rw_rentit.back_date')}}</label></b>
                                </div>
                                <div class="col-md-7 rw-red">
                                    <b style="  font-size: 1.2em;"><span id="back-date"></span></b>
                                </div>
                            </div>
                            <hr>
                            <br>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-7">
                                        <b>
                                            <h5 class="rw-orange">
                                                <i class="material-icons" style="font-size:30px; vertical-align: middle;">date_range</i>
                                                {{__('rw_rentit.rent_info')}}
                                            </h5>
                                        </b>
                                        <hr>
                                        <form class="form" role="form" name="step1Form" id="step1Form" method="POST" enctype="multipart/form-data"  action="/rentit/step-1/save">        
                                            <div class="form-row">
                                                <div class="form-group col-md-5">                              
                                                    <label for="start_date" class="col-form-label text-primary">{{__('rw_rentit.start_date')}}</label>
                                                    <input type="date" class="form-control rw-input calc-field " id="start_date" name="start_date" required value="{{ old('start_date') }}"/> 
                                                </div>
                                                <div class="form-group col-md-4">                              
                                                    <label for="start_time" class="col-form-label text-primary">{{__('rw_rentit.start_time')}}</label>
                                                    <input type="time" class="form-control rw-input calc-field" id="start_time" name="start_time" required value="{{ old('start_time') }}"/> 
                                                </div>
                                            </div>
                                            @if($product->price_hour > 0 || $product->loan_or_rent == 1)
                                                <div class="form-row">  
                                                    <div class="form-group col-md-4 hours-group">                              
                                                        <label for="hours" class="col-form-label text-primary">{{__('rw_rentit.quant_hours')}}</label>
                                                        <input type="number" min="0" max="24" class="form-control rw-input calc-field" id="hours" name="hours" value="{{ old('end_date') }}"/> 
                                                    </div>
                                                </div>
                                            @endif
                                            @if($product->price_day > 0 || $product->loan_or_rent == 1)
                                                <div class="form-row"> 
                                                    <div class="form-group col-md-4 days-group">                              
                                                        <label for="days" class="col-form-label text-primary">{{__('rw_rentit.quant_days')}}</label>
                                                        <input type="number" min="0" max="7" class="form-control rw-input calc-field" id="days" name="days" value="{{ old('end_date') }}"/> 
                                                    </div>
                                                </div>
                                            @endif
                                            @if($product->price_week > 0 || $product->loan_or_rent == 1 )
                                                <div class="form-row"> 
                                                    <div class="form-group col-md-4 weeks-group">                              
                                                        <label for="weeks" class="col-form-label text-primary">{{__('rw_rentit.quant_weeks')}}</label>
                                                        <input type="number" min="0" max="4" class="form-control rw-input calc-field" id="weeks" name="weeks" value="{{ old('end_date') }}"/> 
                                                    </div>
                                                </div>
                                            @endif
                                            @if($product->price_month > 0 || $product->loan_or_rent == 1)                                      
                                                <div class="form-row"> 
                                                    <div class="form-group col-md-4 months-group">                              
                                                        <label for="months" class="col-form-label text-primary">{{__('rw_rentit.quant_months')}}</label>
                                                        <input type="number" min="0" max="12" class="form-control rw-input calc-field" id="months" name="months" value="{{ old('end_date') }}"/> 
                                                    </div>
                                                </div>  
                                            @endif 
                                                   
                                            <div class="form-row">  
                                                <div class="form-group col-md-12">                              
                                                    <label class="col-form-label text-primary">{{__('rw_rentit.info')}}</label>
                                                    <textarea type="text" class="form-control rw-input" rows="5" id="rent_info" name="rent_info">{{ old('rent_info') }}</textarea> 
                                                </div>
                                            </div> 
                                        </form>
                                    </div>
                    <!-- PRICE INFO -->
                                    <div class="col-md-5">
                                        <b>
                                            <h5 class="rw-orange">
                                                <i class="material-icons" style="font-size:30px; vertical-align: middle;">euro_symbol</i>
                                                {{__('rw_rentit.price_info')}}
                                            </h5>
                                        </b>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <b><label class="col-form-label text-primary">{{__('rw_rentit.total_price')}}</label></b>
                                            </div>
                                            <div class="col-md-7">
                                                <b class = "pull-right" style="  font-size: 1.2em;"><span id="total-price"></span></b>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <b><h6 class="rw-blue">{{__('rw_rentit.exist_of')}}</h6></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <b><label class="col-form-label text-primary">{{__('rw_rentit.deposit_label')}}</label></b>
                                                <br>                                            
                                            </div>
                                            <div class="col-md-7">
                                                <b class = "pull-right" style="  font-size: 1.2em;"><span id="deposit"></span></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <b><label class="col-form-label text-primary">{{__('rw_rentit.payable_site')}}</label></b>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <b><label class="col-form-label text-primary">{{__('rw_rentit.balance_label')}}</label></b>
                                                <br>                                            
                                            </div>
                                            <div class="col-md-7">
                                                <b class = "pull-right" style="  font-size: 1.2em;"><span id="balance"></span></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <b><label class="col-form-label text-primary">{{__('rw_rentit.payable_owner')}}</label></b>
                                            </div>
                                        </div>
                                        <hr>
                                        @if($product->warranty_amount > 0)
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <b><label class="col-form-label text-primary">{{__('rw_rentit.warranty_label')}}</label></b>
                                                    <br>                                            
                                                </div>
                                                <div class="col-md-7">
                                                    <b class = "pull-right" style="  font-size: 1.2em;">{{$product->warranty_amount}}€</b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <b><label class="col-form-label text-primary">{{__('rw_rentit.payable_owner')}}</label></b>
                                                </div>
                                            </div>  
                                        @endif    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer"> 
                        
                        </div>
                    </div>
                </div>
            </div>  
        </form> 
    </div>
     <!-- Call to alertModal -->

    @component('/layouts/messageModal')
       <span id="message-text"></span>
    @endcomponent


@endsection
@section('javascript')
    <script type="text/javascript" charset="utf-8">

        
        $(document).ready(function() {
        // Get product vars in init screen
            var priceHour = Number($('#price_hour').val());
            var priceDay = Number($('#price_day').val());
            var priceWeek = Number($('#price_week').val());
            var priceMonth = Number($('#price_month').val());
            var commission = Number($('#commission').val());

        // Click on submit link (send) handle errors on client site with mod
            $("#submit-link").on('click', function() {
                var startDate = $('#start_date').val();
                    startYear = parseInt(startDate.substring(0,4));
                    startMonth = parseInt(startDate.substring(5,7));
                    startDay = parseInt(startDate.substring(8,10));
                
                var now = new Date(),
                    nowYear = now.getFullYear(),
                    nowMonth = now.getMonth() + 1, // for getMonth(), January is 0
                    nowDay = now.getDate();

                var startTime = $('#start_time').val();
                var hours = Number($('#hours').val()) || 0;
                var days = Number($('#days').val()) || 0;
                var weeks= Number($('#weeks').val()) || 0;
                var months = Number($('#months').val()) || 0;

                var availableMo  = $('#available_mo').val();
                var availableTue = $('#available_tue').val();
                var availableWed = $('#available_wed').val();
                var availableTh  = $('#available_th').val();
                var availableFr  = $('#available_fr').val();
                var availableSat = $('#available_sat').val();
                var availableSun = $('#available_sun').val();

                // Check if there are days that there is no renting possible !
                var totalDays = (days + (weeks * 7) + (months * 30))
                if(totalDays == 0){totalDays = 1}
                if(totalDays > 8){totalDays = 8}   // Max 7 times trough loop for each day of the week  
                var date = new Date(startDate);
                var errorDay = 0;
                for (counter = 0; counter < totalDays; counter++) { 
                    var day = date.getDay();
                    // Monday - Sunday
                    if(day == 1 && availableMo == 0){
                        $('#message-text').html("{{__('rw_rentit.not_av_mo')}}");
                        $('#rw-message-modal').modal('show');
                        errorDay = 1;
                    }else if(day == 2 && availableTue == 0){
                        $('#message-text').html("{{__('rw_rentit.not_av_tue')}}");
                        $('#rw-message-modal').modal('show');
                        errorDay = 1;
                    }else if(day == 3 && availableWed == 0){
                        $('#message-text').html("{{__('rw_rentit.not_av_wed')}}");
                        $('#rw-message-modal').modal('show');
                        errorDay = 1;
                    }else if(day == 4 && availableTh == 0){
                        $('#message-text').html("{{__('rw_rentit.not_av_th')}}");
                        $('#rw-message-modal').modal('show');
                        errorDay = 1;
                    }else if(day == 5 && availableFr == 0){
                        $('#message-text').html("{{__('rw_rentit.not_av_fr')}}");
                        $('#rw-message-modal').modal('show');
                        errorDay = 1;
                    }else if(day == 6 && availableSat == 0){
                        $('#message-text').html("{{__('rw_rentit.not_av_sat')}}");
                        $('#rw-message-modal').modal('show');
                        errorDay = 1;
                    }else if(day == 0 && availableSun == 0){
                        $('#message-text').html("{{__('rw_rentit.not_av_sun')}}");
                        $('#rw-message-modal').modal('show');
                        errorDay = 1;
                    }
                    // Count one day up current date    
                    var date = new Date((new Date(date)).valueOf() + 1000*3600*24);
                }
                console.log
                if(!startDate){
                    $('#message-text').html("{{__('rw_rentit.fill_date')}}");
                    $('#rw-message-modal').modal('show');
                }else if(nowYear > startYear ||
                        nowYear == startYear && nowMonth > startMonth ||
                        nowYear == startYear && nowMonth == startMonth && nowDay > startDay){
                    $('#message-text').html("{{__('rw_rentit.date_not_ok')}}");
                    $('#rw-message-modal').modal('show');
                }else if(!startTime){
                    $('#message-text').html("{{__('rw_rentit.fill_time')}}");
                    $('#rw-message-modal').modal('show');
                }else if(!hours && !days && !weeks && !months){
                    $('#message-text').html("{{__('rw_rentit.fill_hdwm')}}");
                    $('#rw-message-modal').modal('show');
                }else{
                    if(errorDay == 0){
                        $("#step1Form").submit()
                       // window.location.href = "{{URL::to('/rentit/step-1/send')}}";
                    }
                }
            });

        // Calculate rent prices !!!
            $(".calc-field").on('change', function() {
                var hours = Number($('#hours').val());
                hours = hours || 0;
                var days = Number($('#days').val());
                days = days || 0;
                var weeks= Number($('#weeks').val());
                weeks = weeks || 0;
                var months = Number($('#months').val());
                months = months || 0;
                var totalPriceHours = priceHour * hours; 
                var totalPriceDays = priceDay * days;
                var totalPriceWeeks = priceWeek * weeks;
                var totalPriceMonths = priceMonth * months;
                var totalPrice = (totalPriceHours + totalPriceDays + totalPriceWeeks + totalPriceMonths).toFixed(2);              
                var deposit = ((totalPrice / 100) * commission).toFixed(2);
                var factor = 0.05;
                deposit = (Math.round(deposit / factor) * factor).toFixed(2);
                var balance = (totalPrice - deposit);
                $('#total-price').html(totalPrice + "€");
                $('#deposit').html(deposit + "€");
                $('#balance').html(balance + "€");

                var totalDays = (days + (weeks * 7) + (months * 30));
                var startDateField = $('#start_date').val();
                var startDate = new Date(startDateField);
                var startTimeField = $('#start_time').val();
                var startHour = parseInt(startTimeField.substring(0,2));
                var startMinutes = parseInt(startTimeField.substring(3,5));
        //        startDate.setHours(startDate.getHours() + startHour);
                startDate.setHours(startHour);
                startDate.setMinutes(startMinutes);
                console.log('start date :' + startDate);
                var endDate = new Date(startDate);
                endDate.setDate(endDate.getDate() + totalDays);
                if(hours > 0){
                    endDate.setHours(endDate.getHours() + hours);
                }
                console.log('einddatum :' + endDate);

        // Translate date to Dutch
                var dag = endDate.getDay(); //dag in woorden
                var dag2 = endDate.getDate(); // dag in getal
                var maand = endDate.getMonth()+1; // +1 want js begint bij 0 te tellen
                var jaar = endDate.getFullYear();

                var uur = endDate.getHours();
                var minuten = endDate.getMinutes();

                var maandarray = new Array('januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december');
                var dagarray = new Array('zondag','maandag','dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag');
                var nl_date = (dagarray[dag]+" "+dag2+" "+maandarray[maand]+" "+jaar+" "+uur+":"+minuten+" !!!"); 

                if(startDateField && startTimeField){
                    $('#back-date').html(nl_date);
                    $('#end_date_input').val(nl_date);
                }
            });  
        });
    </script>
@endsection
