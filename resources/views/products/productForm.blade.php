@extends('layouts.app')
@section('styles')
     <link href="/js/dropify/dist/css/dropify.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container h-100">
        @if($isNew == 1)
            <form class="form" role="form" name="productForm" id="productForm" method="POST" enctype="multipart/form-data"  action="/my-products/save/0">
        @else
            <form class="form" role="form" name="productForm" id="productForm" method="POST" enctype="multipart/form-data"  action="/my-products/save/{{ $product->id }}">
        @endif
        {{ csrf_field() }}
        <input type="hidden" id="productId" name="product_id" value="{{ $product->id }}"> 
          
            <div class="row justify-content-md-centerrow justify-content-md-center">  
                <div class="col-lg-12">
                    <div class="h-100 card card-primary">
                        <div class="card-header text-white bg-primary rw-title" style="padding-top:7px; padding-bottom:0px;">
                            <h5>
                                <div class="row h-100 justify-content-center align-items-center">  
                                    <i class="material-icons" style="font-size: 50px">card_giftcard</i>  
                                    &nbsp    
                                    @if ($isNew == 1)
                                            {{__('rw_products.new_product')}}
                                        @else
                                            {{__('rw_products.edit_product')}}
                                        @endif
                                </div>
                            </h5>
                        </div>
            <!-- BUTTON BAR  -->
                        <div class="card-header rw-buttonbar">  
                            <b>                      
                                <a class="rw-icons rw-grey" href="{{ route('my-products.list') }}">
                                    <i class="material-icons">arrow_back</i> 
                                    {{__('rw_products.back')}}
                                </a>                                  
                                <a class="rw-icons rw-grey pull-right" href="javascript:{}" onclick="document.getElementById('productForm').submit(); return false;">
                                    <i class="material-icons">save</i>  
                                    {{__('rw_login.save')}}
                                </a> 
                                @if(!$isNew == 1)
                                    <a id="delete" class="rw-icons rw-red pull-right" href="#" data-toggle="modal" data-target="#exampleModal" >
                                        <i class="material-icons">delete_forever</i>  
                                        {{__('rw_login.delete')}}&nbsp&nbsp&nbsp&nbsp&nbsp
                                    </a>
                                @endif
                            </b>       
                        </div>
                        <!-- TAB MENU -->
                        <div class="card-header  bg-light" style="padding:0;">            
                            <nav class="nav nav-tabs flex-column flex-sm-row" id="productTab" role="tablist">
                                <a class="flex-sm-fill text-sm-center nav-item nav-link active" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">{{__('rw_products.details')}}</a>
                                <a class="flex-sm-fill text-sm-center nav-item nav-link " id="nav-prices-tab" data-toggle="tab" href="#nav-prices" role="tab" aria-controls="nav-prices" aria-selected="false">{{__('rw_products.prices')}}</a>
                                <a class="flex-sm-fill text-sm-center nav-item nav-link" id="nav-availability-tab" data-toggle="tab" href="#nav-availability" role="tab" aria-controls="nav-availability" aria-selected="false">{{__('rw_products.availability')}}</a>
                                <a class="flex-sm-fill text-sm-center nav-item nav-link" id="nav-pictures-tab" data-toggle="tab" href="#nav-pictures" role="tab" aria-controls="nav-pictures" aria-selected="false">{{__('rw_products.pictures')}}</a>
                            </nav>
                        </div> 
                        <div class="card-body rw-scrolly">
                             @if ($errors->any())
                                <div class="alert alert-danger">
                                    <h5>{{__('rw_profile.errors')}}</h5>
                                    <br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @elseif (\Session::has('msg'))
                                <div id="profile-success" class="alert alert-success">    
                                    <h5>{{__('rw_profile.success')}}</h5>   
                                </div>
                            @endif
                            <div class="row justify-content-md-center">
                                <div class="col-lg-12">                  
                                <div class="tab-content" id="nav-tabContent">
                        <!-- PRODUCTDETAILS -->
                                        <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                                            <div class="card-header bg-light border-light">  
                                                <h5> {{__('rw_products.info')}}</h5>
                                            </div>
                                            <br>           
                                            <div class="form-row">
                                                <div class="form-group col-md-5">
                                                    <label for="pors" class="text-primary">{{__('rw_products.pors')}}</label>
                                                    <div class="input-group rw-icons">
                                                        <select class="form-control rw-input" id="pors" name="pors">
                                                            <option value="empty" selected disabled>{{__('rw_products.select')}}</option>
                                                            @foreach($porses as $pors)
                                                                @if($pors->id == $product->pors)
                                                                    <option value="{{ $pors->id }}" selected="selected">{{ $pors->category_name }}</option>
                                                                @elseif($pors->id == old('pors'))
                                                                    <option value="{{ $pors->id }}" selected="selected">{{ $pors->category_name }}</option>
                                                                @else
                                                                    <option value="{{ $pors->id }}">{{$pors->category_name}}</option> 
                                                                @endif
                                                            @endforeach
                                                        </select> 
                                                        <i class="material-icons">arrow_drop_down_circle</i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="group" class="text-primary">{{__('rw_products.group')}}</label>  {{ old('group') }}
                                                    <div class="input-group rw-icons">                                             
                                                        <select class="form-control rw-input" id="group" name="group"> 
                                                            <option value="empty" selected disabled>{{__('rw_products.select')}}</option>
                                                            @if($isNew == 0)
                                                                @foreach($groups as $group)
                                                                    @if($group->id == $product->group)
                                                                        <option value="{{ $group->id }}" selected="selected">{{ $group->category_name }}</option>  
                                                                    @else
                                                                        <option value="{{ $group->id }}">{{$group->category_name}}</option> 
                                                                    @endif
                                                                @endforeach
                                                            @elseif( !empty( old('group')))
                                                                <option value="{{ old('group') }}" selected="selected"></option>
                                                            @endif   
                                                        </select> 
                                                        <i class="material-icons">arrow_drop_down_circle</i>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="category" class="text-primary">{{__('rw_products.category')}}</label>
                                                    <div class="input-group rw-icons">
                                                        <select class="form-control rw-input" id="category" name="category">
                                                            <option value="empty" selected disabled>{{__('rw_products.select')}}</option>
                                                            @if($isNew == 0)
                                                                @foreach($categories as $category)
                                                                    @if($category->id == $product->category)
                                                                        <option value="{{ $category->id }}" selected="selected">{{$category->category_name}}</option>
                                                                    @else
                                                                        <option value="{{ $category->id }}">{{$category->category_name}}</option> 
                                                                    @endif
                                                                @endforeach
                                                            @elseif( !empty( old('category')))
                                                                <option value="{{ old('category') }}" selected="selected"></option>
                                                            @endif 
                                                        </select> 
                                                        <i class="material-icons">arrow_drop_down_circle</i>
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group col-md-4">
                                                    <label for="sub_category" class="text-primary">{{__('rw_products.sub_category')}}</label>
                                                    <div class="input-group rw-icons">
                                                        <select class="form-control rw-input" id="sub_category" name="sub_category">
                                                            <option value="empty" selected disabled>{{__('rw_products.select')}}</option>
                                                            @if($isNew == 0)
                                                                @foreach($subCategories as $subCategory)
                                                                    @if($subCategory->id == $product->sub_category)
                                                                        <option value="{{ $subCategory->id }}" selected="selected">{{$subCategory->category_name}}</option>
                                                                    @else
                                                                        <option value="{{ $subCategory->id }}">{{$subCategory->category_name}}</option> 
                                                                    @endif
                                                                @endforeach
                                                            @elseif( !empty( old('sub_category')))
                                                                <option value="{{ old('sub_category') }}" selected="selected"></option>
                                                            @endif 
                                                        </select> 
                                                        <i class="material-icons">arrow_drop_down_circle</i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">                              
                                                    <label for="title" class="col-form-label text-primary">{{__('rw_products.title')}}</label>
                                                    <input type="text" class="form-control rw-input" id="title" name="title" value="{{ old('title', $product->title) }}"/> 
                                                </div>
                                            </div>  
                                            <div class="form-row">
                                                <div class="form-group col-md-12">                              
                                                    <label for="sub_title" class="col-form-label text-primary">{{__('rw_products.sub_title')}}</label>
                                                    <input type="text" class="form-control rw-input" id="sub_title" name="sub_title" value="{{ old('sub_title', $product->sub_title) }}"/> 
                                                </div>
                                            </div>  
                                            <div class="form-row">
                                                <div class="form-group col-md-12">                              
                                                    <label for="description" class="col-form-label text-primary">{{__('rw_products.description')}}</label>
                                                    <textarea type="text" class="form-control rw-input" rows="5" id="description" name="description">{{ old('description', $product->description) }}</textarea> 
                                                </div>
                                            </div> 
                                            <div class="card-header bg-light border-light">  
                                                <h5> {{__('rw_products.active_countrys')}}</h5>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input type="checkbox" id="toggle_belgium" name="toggle_belgium" class="switch-input">
                                                        <label for="toggle_belgium" class="switch-label text-primary">{{__('rw_products.rent_belgium')}} 
                                                        <input type="hidden" id="rent_belgium" name="rent_belgium" value="{{ old('rent_belgium', $product->rent_belgium) }}">           
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input type="checkbox" id="toggle_netherlands" name="toggle_netherlands" class="switch-input">
                                                        <label for="toggle_netherlands" class="switch-label text-primary">{{__('rw_products.rent_netherlands')}} 
                                                        <input type="hidden" id="rent_netherlands" name="rent_netherlands" value="{{ old('rent_netherlands', $product->rent_netherlands) }}">           
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                            <!-- PRICES TAB -->
                                        <div class="tab-pane fade show" id="nav-prices" role="tabpanel" aria-labelledby="nav-prices-tab">
                                            <div class="card-header bg-light border-light">  
                                                <h5> {{__('rw_products.price_info')}}</h5>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">                              
                                                    <label for="price_hour" class="col-form-label text-primary">{{__('rw_products.price_hour')}}</label>
                                                    <input type="num" class="form-control rw-input" id="price_hour" name="price_hour" value="{{ old('price_hour', $product->price_hour) }}"/> 
                                                </div>
                                                <div class="form-group col-md-3">                              
                                                    <label for="price_day" class="col-form-label text-primary">{{__('rw_products.price_day')}}</label>
                                                    <input type="num" class="form-control rw-input" id="price_day" name="price_day" value="{{ old('price_day', $product->price_day) }}" /> 
                                                </div>
                                                <div class="form-group col-md-3">                              
                                                    <label for="price_week" class="col-form-label text-primary">{{__('rw_products.price_week')}}</label>
                                                    <input type="num" class="form-control rw-input" id="price_week" name="price_week" value="{{ old('price_week', $product->price_week) }}"/> 
                                                </div>
                                                <div class="form-group col-md-3">                              
                                                    <label for="price_month" class="col-form-label text-primary">{{__('rw_products.price_month')}}</label>
                                                    <input type="num" class="form-control rw-input" id="price_month" name="price_month" value="{{ old('price_month', $product->price_month) }}"/> 
                                                </div>               
                                            </div> 
                                            <div class="card-header bg-light border-light">  
                                                <h5> {{__('rw_products.warranty_info')}}</h5>
                                            </div> 
                                            <br>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input type="checkbox" id="toggle_warranty" name="toggle_warranty" class="switch-input">
                                                        <label for="toggle_warranty" class="switch-label text-primary">{{__('rw_products.is_warranty')}} 
                                                        <input type="hidden" id="is_warranty" name="is_warranty" value="{{ old('is_warranty', $product->is_warranty) }}">           
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-row">
                                                <div class="form-group col-md-3">                              
                                                    <label for="warranty_amount" class="col-form-label text-primary">{{__('rw_products.warranty_amount')}}</label>
                                                    <input type="num" class="form-control rw-input" id="warranty_amount" name="warranty_amount" value="{{ old('warranty_amount', $product->warranty_amount) }}"/> 
                                                </div> 
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">                              
                                                    <label for="warranty_description" class="col-form-label text-primary">{{__('rw_products.warranty_description')}}</label>
                                                    <textarea type="text" class="form-control rw-input" rows="5" id="warranty_description" name="warranty_description">{{ old('warranty_description', $product->warranty_description) }}</textarea> 
                                                </div>
                                            </div> 
                                            <div class="card-header bg-light border-light">  
                                                <h5> {{__('rw_products.home_delivery')}}</h5>
                                            </div> 
                                            <br>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input type="checkbox" id="toggle_home_delivery" name="toggle_home_delivery" class="switch-input">
                                                        <label for="toggle_home_delivery" class="switch-label text-primary">{{__('rw_products.is_home_delivery')}} 
                                                        <input type="hidden" id="is_home_delivery" name="is_home_delivery" value="{{ old('is_home_delivery', $product->is_home_delivery) }}">           
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-row">
                                                <div class="form-group col-md-3">                              
                                                    <label for="home_delivery_amount" class="col-form-label text-primary">{{__('rw_products.home_delivery_amount')}}</label>
                                                    <input type="num" class="form-control rw-input" id="home_delivery_amount" name="home_delivery_amount" value="{{ old('home_delivery_amount', $product->home_delivery_amount) }}"/> 
                                                </div> 
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">                              
                                                    <label for="home_delivery_description" class="col-form-label text-primary">{{__('rw_products.home_delivery_description')}}</label>
                                                    <textarea type="text" class="form-control rw-input" rows="5" id="home_delivery_description" name="home_delivery_description">{{ old('home_delivery_description', $product->home_delivery_description) }}</textarea> 
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="tab-pane fade show" id="nav-availability" role="tabpanel" aria-labelledby="nav-availability-tab">
                            <!-- AVAILABILITY TAB -->
                                            <div class="card-header bg-light border-light">  
                                                <h5> {{__('rw_products.availability_info')}}</h5>
                                            </div>
                                            <br>
                                            <div class="form-row  justify-content-center align-items-center">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input type="checkbox" id="toggle_mo" name="toggle_mo" class="switch-input">
                                                        <label for="toggle_mo" class="switch-label text-primary">{{__('rw_products.available_mo')}} 
                                                        <input type="hidden" id="available_mo" name="available_mo" value="{{ old('available_mo', $product->available_mo) }}">           
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" id="toggle_tue" name="toggle_tue" class="switch-input">
                                                        <label for="toggle_tue" class="switch-label text-primary">{{__('rw_products.available_tue')}} 
                                                        <input type="hidden" id="available_tue" name="available_tue" value="{{ old('available_tue', $product->available_tue) }}">           
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" id="toggle_wed" name="toggle_wed" class="switch-input">
                                                        <label for="toggle_wed" class="switch-label text-primary">{{__('rw_products.available_wed')}} 
                                                        <input type="hidden" id="available_wed" name="available_wed" value="{{ old('available_wed', $product->available_wed) }}">           
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" id="toggle_th" name="toggle_th" class="switch-input">
                                                        <label for="toggle_th" class="switch-label text-primary">{{__('rw_products.available_th')}} 
                                                        <input type="hidden" id="available_th" name="available_th" value="{{ old('available_th', $product->available_th) }}">           
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" id="toggle_fr" name="toggle_fr" class="switch-input">
                                                        <label for="toggle_fr" class="switch-label text-primary">{{__('rw_products.available_fr')}} 
                                                        <input type="hidden" id="available_fr" name="available_fr" value="{{ old('available_fr', $product->available_fr) }}">           
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" id="toggle_sat" name="toggle_sat" class="switch-input">
                                                        <label for="toggle_sat" class="switch-label text-primary">{{__('rw_products.available_sat')}} 
                                                        <input type="hidden" id="available_sat" name="available_sat" value="{{ old('available_sat', $product->available_sat) }}">           
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" id="toggle_sun" name="toggle_sun" class="switch-input">
                                                        <label for="toggle_sun" class="switch-label text-primary">{{__('rw_products.available_sun')}} 
                                                        <input type="hidden" id="available_sun" name="available_sun" value="{{ old('available_sun', $product->available_sun) }}">           
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>


                            <!-- PICTURES TAB -->
                                        <div class="tab-pane fade show" id="nav-pictures" role="tabpanel" aria-labelledby="nav-pictures-tab">
                                            <div class="card-header bg-light border-light">  
                                                <h5> {{__('rw_products.product_pictures')}}</h5>
                                            </div>
                                            <br>
                                            <div class="form-row">  
                                                <div class="form-group col-md-3">  
                                                    <input  type="file" id="productPic1" name="productPic1" 
                                                            class="dropify" 
                                                            data-max-file-size="2M" 
                                                            data-allowed-file-extensions="gif jpg jpeg png"
                                                            data-default-file="{{ old('picture_1', $product->picture_1) }}"/>   
                                                </div>
                                                <div class="form-group col-md-3">  
                                                    <input  type="file" id="productPic2" name="productPic2" 
                                                            class="dropify" 
                                                            data-max-file-size="2M" 
                                                            data-allowed-file-extensions="gif jpg jpeg png"
                                                            data-default-file="{{ old('picture_2', $product->picture_2) }}"/>   
                                                </div>
                                                <div class="form-group col-md-3"> 
                                                    <input  type="file" id="productPic3" name="productPic3" 
                                                            class="dropify" 
                                                            data-max-file-size="2M" 
                                                            data-allowed-file-extensions="gif jpg jpeg png"
                                                            data-default-file="{{ old('picture_3', $product->picture_3) }}"/> 
                                                </div>
                                                <div class="form-group col-md-3"> 
                                                    <input  type="file" id="productPic4" name="productPic4" 
                                                            class="dropify" 
                                                            data-max-file-size="2M" 
                                                            data-allowed-file-extensions="gif jpg jpeg png" 
                                                            data-default-file="{{ old('picture_4', $product->picture_4) }}"/> 
                                                </div>
                                                <div class="form-group col-md-3"> 
                                                    <input  type="file" id="productPic5" name="productPic5" 
                                                            class="dropify" 
                                                            data-max-file-size="2M" 
                                                            data-allowed-file-extensions="gif jpg jpeg png"
                                                            data-default-file="{{ old('picture_5', $product->picture_5) }}"/>  
                                                </div>
                                                <div class="form-group col-md-3"> 
                                                     <input  type="file" id="productPic6" name="productPic6" 
                                                            class="dropify" 
                                                            data-max-file-size="2M" 
                                                            data-allowed-file-extensions="gif jpg jpeg png" 
                                                            data-default-file="{{ old('picture_6', $product->picture_6) }}"/> 
                                                </div>
                                                <div class="form-group col-md-3"> 
                                                     <input  type="file" id="productPic7" name="productPic7" 
                                                            class="dropify" 
                                                            data-max-file-size="2M" 
                                                            data-allowed-file-extensions="gif jpg jpeg png"
                                                            data-default-file="{{ old('picture_7', $product->picture_7) }}"/>  
                                                </div>
                                                <div class="form-group col-md-3"> 
                                                     <input  type="file" id="productPic8" name="productPic8" 
                                                            class="dropify" 
                                                            data-max-file-size="2M" 
                                                            data-allowed-file-extensions="gif jpg jpeg png"
                                                            data-default-file="{{ old('picture_8', $product->picture_8) }}"/>  
                                                </div>
                                            </div>
                                        </div>                                   
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

<!-- MODAL FOR DELETE CONFIRMATION -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__('rw_products.attention')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{__('rw_products.del-product')}}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{__('rw_products.no')}}</button>
            <button id="modal-save" name="modal-save" type="button" class="btn btn-primary"> {{__('rw_products.yes')}}</button>
        </div>
        </div>
    </div>
    </div>
<!-- END MODAL -->



@endsection
@section('javascript')
    <script src="/js/dropify/dist/js/dropify.min.js"></script>
    <script type="text/javascript" charset="utf-8">

        $(document).ready(function() {

            $('.dropify').dropify({
                messages: {
                    'default': "{{__('rw_login.pic_default')}}",
                    'replace': "{{__('rw_login.pic_replace')}}",
                    'remove': "{{__('rw_login.pic_remove')}}",
                    'error':  "{{__('rw_login.pic_error')}}"
                },
                error: {
                    'fileSize': "{{__('rw_login.pic_max_size')}}",
                    'minWidth': "{{__('rw_login.pic_min_width')}}",
                    'maxWidth': "{{__('rw_login.pic_max_width')}}",
                    'minHeight': "{{__('rw_login.pic_min_height')}}",
                    'maxHeight': "{{__('rw_login.pic_max_height')}}",
                    'imageFormat': "{{__('rw_login.pic_image_format')}}",
                    'fileExtension': "{{__('rw_login.pic_file_extention')}}"
                }
            });

    //(RW) Enable / Disable category selects when Parent empty / Not empty

    // CHECK ON INIT
            var pors = $('#pors option:selected').val();
            var group = $('#group option:selected').val();
            var category = $('#category option:selected').val();
            var subCategory = $('#sub_category option:selected').val();
            var productId = $('#productId option:selected').val();


            if (pors !== "empty") {
                $("#group").prop('disabled', false);
                $("#category").prop('disabled', 'disabled');
                $.ajax({
                    url:'/my-products/get-group/' + pors,
                    method:"get",
                    dataType: "json",
                    success:function(data){
                        $('#group').empty();
                        $('#group').append('<option value="empty selected disabled">{{__("rw_products.select")}}</option>');
                        $.each(data, function(index, groupObj){
                            if(groupObj.id == group){
                                $('#group').append('<option value="'+ groupObj.id +'" selected="selected">'+ groupObj.category_name +'</option>');
                            }else{
                                 $('#group').append('<option value="'+ groupObj.id +'">'+ groupObj.category_name +'</option>');
                            }  
                        })

                    }
                });
               
            } else { 
                $('#group').empty();        
                $("#group").prop('disabled', 'disabled');               
            }

            if (group !== "empty") {
                $("#category").prop('disabled', false);
                console.log('group is NOT empty');
                $.ajax({
                    url:'/my-products/get-group/' + group,
                    method:"get",
                    dataType: "json",
                    success:function(data){
                        $('#category').empty();
                        $('#category').append('<option value="empty selected disabled">{{__("rw_products.select")}}</option>');
                        $.each(data, function(index, groupObj){
                            if(groupObj.id == category){
                                $('#category').append('<option value="'+ groupObj.id +'" selected="selected">'+ groupObj.category_name +'</option>');
                            }else{
                                $('#category').append('<option value="'+ groupObj.id +'">'+ groupObj.category_name +'</option>');
                            }
                        })

                    }
                });

            } else {
                $('#category').empty();
                $("#category").prop('disabled', 'disabled');        
            }

            if (category !== "empty") {
                $("#sub_category").prop('disabled', false);
                $.ajax({
                    url:'/my-products/get-group/' + category,
                    method:"get",
                    dataType: "json",
                    success:function(data){
                        $('#sub_category').empty();
                        $('#sub_category').append('<option value="empty selected disabled">{{__("rw_products.select")}}</option>');
                        $.each(data, function(index, groupObj){
                            if(groupObj.id == subCategory){
                                $('#sub_category').append('<option value="'+ groupObj.id +'" selected="selected">'+ groupObj.category_name +'</option>');
                            }else{
                                $('#sub_category').append('<option value="'+ groupObj.id +'">'+ groupObj.category_name +'</option>');
                            }
                        })

                    }
                });
            } else { 
                $('#sub_category').empty();
                $("#sub_category").prop('disabled', 'disabled');        
            }


    // CHECK ON PRESS'YES' BUTTON IN MODAL
            $("#modal-save").on('click', function() {
                console.log('OP SAVE GEDRUKT');
                window.location.href = "{{URL::to('my-products/delete/' . $product->id )}}"
            });

         
    // CHECK ON CHANGE PRODUCT OR SERVICE (PORS)
            $("#pors").on('change', function() {
                var RWCSRF = $('meta[name="csrf-token"]').attr('content');  
                var pors = $("#pors option:selected").val();
                if (pors !== "empty") {
                    $.ajax({
                        url:'/my-products/get-group/' + pors,
                        method:"get",
                        dataType: "json",
                        success:function(data){
                            $('#group').empty();
                            $('#group').append('<option value="empty selected disabled">{{__("rw_products.select")}}</option>');
                            $.each(data, function(index, groupObj){
                                $('#group').append('<option value="'+ groupObj.id +'">'+ groupObj.category_name +'</option>');
                            })

                        }
                    });
                    $("#group").prop('disabled', false); 
                    $('#category').empty();
                    $("#category").prop('disabled', 'disabled');    
                    $('#sub_category').empty();
                    $("#sub_category").prop('disabled', 'disabled');  
                } else {   
                    $('#group').empty();  
                    $("#group").prop('disabled', 'disabled');        
                }
            });

    // CHECK ON CHANGE GROUP 
            $("#group").on('change', function() {
                var RWCSRF = $('meta[name="csrf-token"]').attr('content');
                var group = $("#group option:selected").val();
                if (group !== "empty") {
                    $.ajax({
                        url:'/my-products/get-group/' + group,
                        method:"get",
                        dataType: "json",
                        success:function(data){
                            $('#category').empty();
                            $('#category').append('<option value="empty selected disabled">{{__("rw_products.select")}}</option>');
                            $.each(data, function(index, groupObj){
                                $('#category').append('<option value="'+ groupObj.id +'">'+ groupObj.category_name +'</option>');
                            })

                        }
                    });
                    $("#category").prop('disabled', false);
                    $('#sub_category').empty();
                    $("#sub_category").prop('disabled', 'disabled');       
                } else {  
                    $('#category').empty();   
                    $("#category").prop('disabled', 'disabled');        
                }
            });

    // CHECK ON CHANGE CATEGORY 
            $("#category").on('change', function() {
                var RWCSRF = $('meta[name="csrf-token"]').attr('content');
                var category = $("#category option:selected").val();
                if (category !== "empty") {
                    $.ajax({
                        url:'/my-products/get-group/' + category,
                        method:"get",
                        dataType: "json",
                        success:function(data){
                            $('#sub_category').empty();
                            $('#sub_category').append('<option value="empty selected disabled">{{__("rw_products.select")}}</option>');
                            $.each(data, function(index, groupObj){
                                $('#sub_category').append('<option value="'+ groupObj.id +'">'+ groupObj.category_name +'</option>');
                            })

                        }
                    });
                    $("#sub_category").prop('disabled', false);      
                } else { 
                    $('#sub_category').empty();    
                    $("#sub_category").prop('disabled', 'disabled');        
                }
            });

    //(RW) Set ALL FLAGES
    //Rent_belgium
            var belgiumSwitch = $('#rent_belgium').val();
            if(belgiumSwitch == 1){
                $('#toggle_belgium').prop('checked', true);
            }else{
                $('#toggle_belgium').prop('checked', false);
            }

            //(RW) Toggle belgium checkbox - Switch
            $(function() {
                $('#toggle_belgium').change(function() {
                    if($(this).prop('checked')){
                        $("#rent_belgium").val("1");
                    }else{
                        $("#rent_belgium").prop('value',0);
                        $("#toggle_belgium").prop('checked', false);
                    }
                })
            })

     //Rent_netherland
            var netherlandSwitch = $('#rent_netherlands').val();
            if(netherlandSwitch == 1){
                $('#toggle_netherlands').prop('checked', true);
            }else{
                $('#toggle_netherlands').prop('checked', false);
            }

            //(RW) Toggle netherland checkbox - Switch
            $(function() {
                $('#toggle_netherlands').change(function() {
                    if($(this).prop('checked')){
                        $("#rent_netherlands").val("1");
                    }else{
                        $("#rent_netherlands").prop('value',0);
                        $("#toggle_netherlands").prop('checked', false);
                    }
                })
            })

     //is_warranty
            var warrantySwitch = $('#is_warranty').val();
            if(warrantySwitch == 1){
                $('#toggle_warranty').prop('checked', true);
            }else{
                $('#toggle_warranty').prop('checked', false);
            }

            //(RW) Toggle is_warrantye checkbox - Switch
            $(function() {
                $('#toggle_warranty').change(function() {
                    if($(this).prop('checked')){
                        $("#is_warranty").val("1");
                    }else{
                        $("#is_warranty").prop('value',0);
                        $("#is_warranty").prop('checked', false);
                    }
                })
            })

    //is_home_delivery
            var homedeliverySwitch = $('#is_home_delivery').val();
            if(homedeliverySwitch == 1){
                $('#toggle_home_delivery').prop('checked', true);
            }else{
                $('#toggle_home_delivery').prop('checked', false);
            }

             //(RW) Toggle netherland checkbox - Switch
            $(function() {
                $('#toggle_home_delivery').change(function() {
                    if($(this).prop('checked')){
                        $("#is_home_delivery").val("1");
                    }else{
                        $("#is_home_delivery").prop('value',0);
                        $("#is_home_delivery").prop('checked', false);
                    }
                })
            })

    //available_mo
            var mondaySwitch = $('#available_mo').val();
            if(mondaySwitch == 1){
                $('#toggle_mo').prop('checked', true);
            }else{
                $('#toggle_mo').prop('checked', false);
            }

             //(RW) Toggle monday checkbox - Switch
            $(function() {
                $('#toggle_mo').change(function() {
                    if($(this).prop('checked')){
                        $("#available_mo").val("1");
                    }else{
                        $("#available_mo").prop('value',0);
                        $("#available_mo").prop('checked', false);
                    }
                })
            })

    //available_tue
            var tueSwitch = $('#available_tue').val();
            if(tueSwitch == 1){
                $('#toggle_tue').prop('checked', true);
            }else{
                $('#toggle_tue').prop('checked', false);
            }

             //(RW) Toggle tuesdaycheckbox - Switch
            $(function() {
                $('#toggle_tue').change(function() {
                    if($(this).prop('checked')){
                        $("#available_tue").val("1");
                    }else{
                        $("#available_tue").prop('value',0);
                        $("#available_tue").prop('checked', false);
                    }
                })
            })

    //available_wed
            var wedSwitch = $('#available_wed').val();
            if(wedSwitch == 1){
                $('#toggle_wed').prop('checked', true);
            }else{
                $('#toggle_wed').prop('checked', false);
            }

             //(RW) Toggle wednessdaycheckbox - Switch
            $(function() {
                $('#toggle_wed').change(function() {
                    if($(this).prop('checked')){
                        $("#available_wed").val("1");
                    }else{
                        $("#available_wed").prop('value',0);
                        $("#available_wed").prop('checked', false);
                    }
                })
            })

    //available_th
            var thSwitch = $('#available_th').val();
            if(thSwitch == 1){
                $('#toggle_th').prop('checked', true);
            }else{
                $('#toggle_th').prop('checked', false);
            }

            //(RW) Toggle thursdaycheckbox - Switch
            $(function() {
                $('#toggle_th').change(function() {
                    if($(this).prop('checked')){
                        $("#available_th").val("1");
                    }else{
                        $("#available_th").prop('value',0);
                        $("#available_th").prop('checked', false);
                    }
                })
            })

    //available_fr
            var frSwitch = $('#available_fr').val();
            if(frSwitch == 1){
                $('#toggle_fr').prop('checked', true);
            }else{
                $('#toggle_fr').prop('checked', false);
            }

            //(RW) Toggle fridayycheckbox - Switch
            $(function() {
                $('#toggle_fr').change(function() {
                    if($(this).prop('checked')){
                        $("#available_fr").val("1");
                    }else{
                        $("#available_fr").prop('value',0);
                        $("#available_fr").prop('checked', false);
                    }
                })
            })

    //available_sat
            var satSwitch = $('#available_sat').val();
            if(satSwitch == 1){
                $('#toggle_sat').prop('checked', true);
            }else{
                $('#toggle_sat').prop('checked', false);
            }

            //(RW) Toggle saturdaycheckbox - Switch
            $(function() {
                $('#toggle_sat').change(function() {
                    if($(this).prop('checked')){
                        $("#available_sat").val("1");
                    }else{
                        $("#available_sat").prop('value',0);
                        $("#available_sat").prop('checked', false);
                    }
                })
            })

    //available_sun
            var sunSwitch = $('#available_sun').val();
            if(sunSwitch == 1){
                $('#toggle_sun').prop('checked', true);
            }else{
                $('#toggle_sun').prop('checked', false);
            }

            //(RW) Toggle fridayycheckbox - Switch
            $(function() {
                $('#toggle_sun').change(function() {
                    if($(this).prop('checked')){
                        $("#available_sun").val("1");
                    }else{
                        $("#available_sun").prop('value',0);
                        $("#available_sun").prop('checked', false);
                    }
                })
            })


    //(RW) Slide UP  alert success messages
            $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert-success").alert('close');
            });
        });

// on error ajax error: function (data) {
//                console.log('Error:', data);
 //           }

    </script>
@endsection 
