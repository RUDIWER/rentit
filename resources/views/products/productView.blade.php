@extends('layouts.app')
@section('styles')
    <link rel='stylesheet' href='{{ url('/') }}/js/unitegallery-master/dist/css/unite-gallery.css' type='text/css' /> 
    <link rel='stylesheet' href='{{ url('/') }}/js/unitegallery-master/dist/themes/default/ug-theme-default.css' type='text/css' /> 

@endsection

@section('content')
    <div class="container h-100">    
        <div class="row justify-content-md-centerrow justify-content-md-center">  
            <div class="col-md-12">
                <div class="h-100 card card-primary">
                    <div class="card-header text-white bg-primary rw-title" style="padding-top:6px; padding-bottom:0px;">
                        <h5>
                            <div class="row h-100 justify-content-center align-items-center">  
                                <i class="material-icons" style="font-size: 40px">card_giftcard</i>     
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
                    <div class="card-body rw-body">
                        <div class="row">
                            <div class="col-md-6 pull-left rw-header">
                                <h5 class="rw-orange">{{ $product->title }}</h5> 
                            </div> 
                            <div class="col-md-6 pull-right rw-header">
                                <button id="rentit" type="button" class="btn btn-large btn-outline-success pull-right">
                                    @if(!$product->price_hour && !$product->price_day && !$product->price_week && !$product->price_month)
                                        <b class="rw-icons"><i class="material-icons">thumb_up</i>&nbsp  {{__('rw_products.loanit')}}</b>
                                    @else
                                        <b class="rw-icons"><i class="material-icons">thumb_up</i>&nbsp  {{__('rw_products.rentit')}}</b>
                                    @endif
                                </button>
                            </div>
                        </div>
        <!--  IMAGE-->
                        <div class="row">
                            <div class="col-md-6 pull-left" style="padding:0em;">
                                <div id="gallery" style="display:none;">
                                    <img alt="Image 1 Title" src="{{ $product->picture_1 }}"
                                        data-image="{{ $product->picture_1 }}"
                                        data-description="Image 1 Description">
                                    
                                    <img alt="Image 2 Title" src="{{ $product->picture_2 }}"
                                        data-image="{{ $product->picture_2 }}"
                                        data-description="Image 2 Description">                  
                                </div>
                            </div>
        <!-- Description -->               
                            <div class="rw-text-body col-md-6 pull-right border">                                   
                                <h5 class="card-subtitle mb-2 text-muted"> {{ $product->sub_title }}</h5>    
                                <p class="card-text rw-blue">{{ $product->description }}</p><br>   
                                <div class="rw-bottom-text rw-blue"> 
                                    {{__('rw_results.available_on')}} 
                                    @if($product->available_mo == 1)
                                        <b> {{__('rw_results.available_mo')}}</b>
                                    @endif
                                    @if($product->available_tue == 1)
                                        <b> {{__('rw_results.available_tue')}}</b>
                                    @endif
                                    @if($product->available_wed == 1)
                                        <b> {{__('rw_results.available_wed')}}</b>
                                    @endif
                                    @if($product->available_th == 1)
                                        <b> {{__('rw_results.available_th')}}</b>
                                    @endif
                                    @if($product->available_fr == 1)
                                        <b> {{__('rw_results.available_fr')}}</b>
                                    @endif
                                    @if($product->available_sat == 1)
                                        <b> {{__('rw_results.available_sat')}}</b>
                                    @endif
                                    @if($product->available_sun == 1)
                                        <b> {{__('rw_results.available_sun')}}</b>
                                    @endif
                                </div>        
                            </div>  
                        </div>
                        <div class="row" style="padding-top:1em;"></div>
                        <div class="row border" style="padding-top:1em;"> 
                   <!-- Price information -->
                            <div class="col-md pull-right  card-subtitle text-muted" style="padding-bottom:1em;">  
                                <h5>{{__('rw_products.price_title')}}</h5>    
                                    <table class="rw-prd-price">
                                    @if(!$product->price_hour && !$product->price_day && !$product->price_week && !$product->price_month)
                                        <a class="rw-p-price"><h5><i class="material-icons rw-icons rw-green"  style="font-size: 40px" >favorite</i><b class="rw-green">{{__('rw_results.for_free')}}</b></a></h5>
                                        <p class="rw-p-price"><div class="rw-green">{{__('rw_results.handle_costs')}}</p></div>
                                    @endif
                                    @if($product->price_hour > 0)
                                        <tr>
                                            <td>
                                                <a class="rw-p-price"><h5 class="rw-txt-right"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->price_hour }} </b></a>
                                            </td>
                                            <td>
                                                <h5><sup>{{__('rw_results.hour')}}</sup></h5>     
                                            </td>  
                                        </tr>
                                    @endif
                                    @if($product->price_day > 0)
                                        <tr>
                                            <td>
                                                <a class="rw-p-price"><h5 class="rw-txt-right"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->price_day }}</b></a></h5>
                                            </td>
                                            <td>
                                                <h5><sup>{{__('rw_results.day')}}</sup></h5> 
                                            </td>  
                                        </tr>
                                    @endif
                                    @if($product->price_week > 0)
                                        <tr>
                                            <td>
                                                <a class="rw-p-price"><h5 class="rw-txt-right"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->price_week }}</b></a></h5>
                                            </td>
                                            <td>
                                                <h5><sup>{{__('rw_results.week')}}</sup></h5> 
                                            </td>  
                                        </tr>
                                    @endif
                                    @if($product->price_month > 0)
                                        <tr>
                                            <td>
                                                <a class="rw-p-price"><h5 class="rw-txt-right"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->price_month }}</b></a></h5>
                                            </td>
                                            <td>
                                                <h5><sup>{{__('rw_results.month')}}</sup></h5> 
                                            </td>  
                                        </tr>
                                    @endif
                                </table>             
                            </div>
                          
                        

                    <!-- Warranty description -->
                           
                            <div class="col-md card-subtitle text-muted">  
                                <h5>{{__('rw_products.warranty_title')}}</h5>  
                                <a ><h5 style="color: #ff5733;"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->warranty_amount }} </h5></b></a>
                                <p class="card-text rw-blue">{{ $product->warranty_description }}</p><br>   

                            </div> 
                               
                    <!-- Delivery description -->
                           
                            <div class="col-md pull-left card-subtitle text-muted">   
                                <h5>{{__('rw_products.delivery_title')}}</h5>
                                <a ><h5 style="color: #ff5733;"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->home_delivery_amount }} </h5></b></a>
                                <p class="card-text rw-blue">{{ $product->home_delivery_description }}</p><br>   
                            </div>  

                    <!-- Profile info -->        

                        </div>
                        <div class="row" style="padding-top:1em;"></div>
                        <div class="row border" style="padding-top:1em; padding-bottom:1em;"> 
                            <div class="col-md pull-right rw-blue">  
                                <h5 class="card-subtitle text-muted">{{__('rw_products.profile_title')}}</h5> 
                                <img src="{{ $product->user->profile->picture }}" width="70px" height="70px" class="rw-icons rounded-circle pull-right"/>
                                <a class="card-text rw-blue"><b><i class="material-icons rw-icons">person</i> {{ $product->user->nickname }}</b><br>
                                <a class="card-text rw-blue"><i class="material-icons rw-icons">place</i> {{ $product->user->profile->addr1_postcode }} - {{ $product->user->profile->addr1_city }} ({{ $product->user->profile->addr1_country }})</a><br>  
                                @if($product->user->profile->company == 0)
                                    <a class="card-text rw-blue"><i class="material-icons rw-icons">info</i> {{__('rw_results.particulier')}} </a>
                                @else
                                    <a class="card-text rw-blue"><i class="material-icons rw-icons rw-orange">info</i> {{__('rw_results.prof')}}</a>   
                                @endif          
  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type='text/javascript' src='{{ url('/') }}/js/unitegallery-master/dist/js/unitegallery.min.js'></script>
    <script type='text/javascript' src='{{ url('/') }}/js/unitegallery-master/dist/themes/compact/ug-theme-compact.js'></script> 
    <script type="text/javascript" charset="utf-8">

            //http://unitegallery.net
			var api; 
			$(document).ready(function(){
            // On press Rentit buttonpweb
            $("#rentit").on('click', function() {
                window.location.href = "{{URL::to('rentals/step-1/' . $product->id )}}"
            });

            // Picture Gallery    
				api = jQuery("#gallery").unitegallery({
                    gallery_theme:"compact",

                }); 
                api.resize(800);
			}); 
		
		
    </script>
@endsection

