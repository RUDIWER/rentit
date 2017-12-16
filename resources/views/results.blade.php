@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-md-centerrow justify-content-md-center">  
            <div class="col-lg-12">
                <div class="h-100 card card-primary">
                    <div class="card-header text-white bg-primary rw-title">
                        <div class="rw-icons">
                            <i class="material-icons">arrow_back</i> 
                            <a class="text-white" href="{{ route('home') }}">
                                {{__('rw_products.back')}}
                            </a>
                        </div>
                        <h4>
                            <div class="row h-100 justify-content-center align-items-center">  
                                <i class="material-icons" style="font-size: 50px">youtube_searched_for</i>  
                                &nbsp    
                                {{__('rw_results.header')}}
                            </div>
                        </h4>
                    </div>
                   
                    <div class="card-body">    
                        @foreach($products as $product)                                
                            <div id="{{$product->id}}" class="card text-primary mb-3 rw-card-hover product-form"> 
                                <div class="card-header bg-light rw-header"> 
                                    <div class="col-md-8 pull-left  rw-header ">  
                                        <a href="{{ route('productView',['id'=> $product->id])}}">
                                            <h4 class="rw-orange">
                                                {{ $product->title }}   
                                            </h4> 
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
                                        <a class="card-text" href="{{ route('message.create',['receiverId'=> $product->user->id, 'productId'=> $product->id, 'chain' => 0])}}"><b><i class="material-icons rw-icons">person</i> {{ $product->user->nickname }}</b><br>
                                        <a class="card-text"><i class="material-icons rw-icons">place</i> {{ $product->user->profile->addr1_postcode }} - {{ $product->user->profile->addr1_city }} ({{ $product->user->profile->addr1_country }})</a><br>  
                                         @if($product->user->profile->company == 0)
                                            <a class="card-text"><i class="material-icons rw-icons">info</i> {{__('rw_results.particulier')}} </a>
                                        @else
                                            <a class="card-text"><i class="material-icons rw-icons rw-orange">info</i> {{__('rw_results.prof')}}</a>   
                                        @endif          
                                    </div>
                                </div> 
                                <div class="row">
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
                                            <tr>
                                                <td>
                                                    <a class="rw-p-price"><h5 class="rw-txt-right"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->price_hour }} </b></a>
                                                </td>
                                                <td>
                                                    <h5><sup>{{__('rw_results.hour')}}</sup></h5>     
                                                </td>  
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="rw-p-price"><h5 class="rw-txt-right"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->price_day }}</b></a></h5>
                                                </td>
                                                <td>
                                                    <h5><sup>{{__('rw_results.day')}}</sup></h5> 
                                                </td>  
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="rw-p-price"><h5 class="rw-txt-right"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->price_week }}</b></a></h5>
                                                </td>
                                                <td>
                                                    <h5><sup>{{__('rw_results.week')}}</sup></h5> 
                                                </td>  
                                            </tr>
                                             <tr>
                                                <td>
                                                    <a class="rw-p-price"><h5 class="rw-txt-right"><i class="material-icons rw-icons">euro_symbol</i><b>{{ $product->price_month }}</b></a></h5>
                                                </td>
                                                <td>
                                                    <h5><sup>{{__('rw_results.month')}}</sup></h5> 
                                                </td>  
                                            </tr>
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
                    <div class="card-footer bg-light text-primary text-right">              
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> <!-- (RW) end #app vue instance !!!! -->

@endsection
@section('javascript')
<script type="text/javascript" charset="utf-8">

$(document).ready(function() {

    // Goto view when click on card
    $( ".product-form" ).click(function() {
       window.location.href = "/product/" + $(this).attr('id');   
    });





    //(RW) Slide UP  alert success messages
   // $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    //// });
   
});

</script>

@endsection