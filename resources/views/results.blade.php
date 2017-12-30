@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-md-centerrow justify-content-md-center">  
            <div class="col-lg-12">
                <div class="h-100 card card-primary">
                    <div class="card-header text-white bg-primary rw-title" style="padding-top:6px; padding-bottom:0px;">
                        <h5>
                            <div class="row h-100 justify-content-center align-items-center">  
                                <i class="material-icons" style="font-size: 40px">youtube_searched_for</i>  
                                &nbsp    
                                {{__('rw_results.header')}}
                            </div>
                        </h5>
                    </div> 
            <!-- BUTTON BAR  -->
                    <div class="card-header rw-buttonbar" style="padding:5px;">
                        <b>
                        <div class=" rw-icons">                           
                            <a class="rw-icons rw-grey" href="{{ route('home') }}">
                                <i class="material-icons">arrow_back</i> 
                                {{__('rw_products.back')}}
                            </a>
                        </div>
                            </b>
                    </div>  
                    @include('/layouts/flash-messages')            
                    <div class="card-body">                      
                        @foreach($products as $product)                                
                            <div class="card text-primary mb-3 rw-card-hover"> 
                                <div class="card-header bg-light rw-header"> 
                                    <div class="col-md-8 pull-left  rw-header ">  
                                        <a href="{{ route('productView',['id'=> $product->id])}}">
                                            <h5 class="rw-orange">
                                                {{ $product->title }}   
                                            </h5> 
                                         </a> 
                                        <h6 class="card-subtitle mb-2 text-muted">
                                        @foreach($categories as $category)       
                                            @if( $category->id == $product->group)
                                                <a class="rw-text-grey" href="{{ route('resultGroup',['id'=> $product->group])}}">
                                                    {{ $category->category_name}}
                                                </a> /
                                            @endif
                                            @if($category->id == $product->category)
                                                <a class="rw-text-grey" href="{{ route('resultCategory',['id'=> $product->category])}}">
                                                    {{ $category->category_name}}
                                                </a> / 
                                            @endif
                                            @if($category->id == $product->sub_category)
                                                <a class="rw-text-grey" href="{{ route('resultSubCategory',['id'=> $product->sub_category])}}">
                                                    {{ $category->category_name}}
                                                </a>
                                            @endif
                                        @endforeach                                    
                                    </div>
                                    <div class="col-md-4 pull-right rw-header">
                                        <img src="{{ $product->user->profile->picture }}" width="70px" height="70px" class="rw-icons rounded-circle pull-right"/>
                            <!--            <a class="card-text" href="{{ route('message.create',['receiverId'=> $product->user->id, 'productId'=> $product->id, 'chain' => 0])}}"><b><i class="material-icons rw-icons">person</i> {{ $product->user->nickname }}</b><br>  -->
                                        <a class="card-text seller" href='#'>
                                            <b><i class="material-icons rw-icons">person</i> {{ $product->user->nickname }}</b><br>
                                            <input type="hidden" id="seller-id" value="{{ $product->user->id }}"/> 
                                            @if (!Auth::guest())
                                                <input type="hidden" id="user-id" name="user-id" value="{{ Auth::user()->id }}"/> 
                                            @endif
                                            <input type="hidden" id="product-id" name="user-id" value="{{ $product->id }}"/> 
                                        </a>
                                        <a class="card-text"><i class="material-icons rw-icons">place</i> {{ $product->user->profile->addr1_postcode }} - {{ $product->user->profile->addr1_city }} ({{ $product->user->profile->addr1_country }})</a><br>  
                                         @if($product->user->profile->company == 0)
                                            <a class="card-text"><i class="material-icons rw-icons">info</i> {{__('rw_results.particulier')}} </a>
                                        @else
                                            <a class="card-text"><i class="material-icons rw-icons rw-orange">info</i> {{__('rw_results.prof')}}</a>   
                                        @endif          
                                    </div>
                                </div> 
                                <div id="{{$product->id}}" class="row  product-form">
                                    <div class="col-md-3">
                                        <img class="card-img-left rw-img" src="{{$product->picture_1}}" alt="Product image">
                                    </div>
                                    <div class="col-md-5 rw-prd-text">                                        
                                        <h6 class="card-subtitle mb-2 text-muted"> {{ $product->sub_title }}</h6>
                                        <p class="card-text">{{ $product->description }}</p><br>   
                                         <div class="rw-bottom-text"> 
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
                                    <div class="col-md-4  rw-prd-price">  
                                        <table class="pull-right">
                                            @if(!$product->price_hour && !$product->price_day && !$product->price_week && !$product->price_month)
                                                <a class="rw-p-price"><h5 class="rw-txt-right"><i class="material-icons rw-icons  rw-green"  style="font-size: 40px" >favorite</i><b>{{__('rw_results.for_free')}}</b></a></h5>
                                                <p class="rw-p-price"><div class="rw-txt-right">{{__('rw_results.handle_costs')}}</p></div>
                                            @endif
                                            @if($product->price_hour > 0)
                                                <tr>
                                                    <td>
                                                        <a class="rw-p-price"><h6 class="rw-txt-right"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->price_hour }} </b></a>
                                                    </td>
                                                    <td>
                                                        <h5><sup>{{__('rw_results.hour')}}</sup></h6>     
                                                    </td>  
                                                </tr>
                                            @endif
                                            @if($product->price_day > 0)
                                                <tr>
                                                    <td>
                                                        <a class="rw-p-price"><h6 class="rw-txt-right"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->price_day }}</b></a></h5>
                                                    </td>
                                                    <td>
                                                        <h5><sup>{{__('rw_results.day')}}</sup></h6> 
                                                    </td>  
                                                </tr>
                                            @endif
                                            @if($product->price_week > 0)
                                                <tr>
                                                    <td>
                                                        <a class="rw-p-price"><h6 class="rw-txt-right"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->price_week }}</b></a></h5>
                                                    </td>
                                                    <td>
                                                        <h5><sup>{{__('rw_results.week')}}</sup></h6> 
                                                    </td>  
                                                </tr>
                                            @endif
                                            @if($product->price_week > 0)
                                                <tr>
                                                    <td>
                                                        <a class="rw-p-price"><h6 class="rw-txt-right"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->price_month }}</b></a></h5>
                                                    </td>
                                                    <td>
                                                        <h5><sup>{{__('rw_results.month')}}</sup></h6> 
                                                    </td>  
                                                </tr>
                                            @endif
                                        </table> 

                                        <!--
                                        <a class="rw-p-price"><h5 class="rw-txt-right"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->price_hour }}</b><sup> {{__('rw_results.hour')}}</sup></h5></a>
                                        <a class="rw-p-price"><h5 class="rw-txt-right"><i class="material-icons rw-icons ">euro_symbol</i><b>{{ $product->price_day }}</b><sup> {{__('rw_results.day')}}</sup></h5></a>
                                        <a class="rw-p-price"><h5 class="rw-txt-right"><i class="material-icons rw-icons ">euro_symbol</i><b>{{ $product->price_week }}</b><sup> {{__('rw_results.week')}}</sup></h5></a>
                                        <a class="rw-p-price"><h5 class="rw-txt-right"><i class="material-icons rw-icons ">euro_symbol</i><b>{{ $product->price_month }}</b><sup> {{__('rw_results.month')}}</sup></h5>          
                                        -->
                                    </div>
                                </div> 
                            </div>  
                        @endforeach  
                 <!--       {!! $products->appends(Request::except('page'))->render() !!}   -->
                        {!! $products->appends(Request::except('page'))->links('layouts/pagination') !!} 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to alertModal -->

    @component('/layouts/messageModal')
        {{__('rw_results.message-to-me')}}
    @endcomponent

@endsection
@section('javascript')
<script type="text/javascript" charset="utf-8">

$(document).ready(function() {
    $( ".product-form" ).click(function() {
        console.log('.product-form grklikt');
        window.location.href = "/product/" + $(this).attr('id');   
    });


    $( ".seller" ).click(function(){ 
        console.log('.seller geklikt');

        var sellerId =  $(this).children('#seller-id').val();
        var userId =  $(this).children('#user-id').val();
        var productId =  $(this).children('#product-id').val();
        console.log(userId);

        if(typeof userId === 'undefined'){
            window.location.href = "/unauthorised"; ;
            console.log('NA PATHHHHHHHHHHH') 
        }

        if(sellerId == userId ){
            $('#rw-message-modal').modal('show'); 

        }


        else{
            window.location.href = "/message/create/" + sellerId + "/" + productId + "/0";  
        }
    });



    


   




    //(RW) Slide UP  alert success messages
   // $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    //// });
   
});

</script>

@endsection