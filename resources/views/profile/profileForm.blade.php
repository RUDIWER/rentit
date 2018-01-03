@extends('layouts.app')
@section('styles')
     <link href="/js/dropify/dist/css/dropify.min.css" rel="stylesheet">
@endsection


@section('content')
<div class="container h-100">
    <form class="form" role="form" name="profileForm" id="profileForm" method="POST" enctype="multipart/form-data" action="/my-profile/save">
    {{ csrf_field() }}
        <div class="row justify-content-md-centerrow justify-content-md-center">  
            <div class="col-lg-12">
                <div class="h-100 card card-primary">
                    <div class="card-header text-white bg-primary rw-title" style="padding-top:6px; padding-bottom:0px;">
                        <h5>
                            <div class="row h-100 justify-content-center align-items-center">  
                                <i class="material-icons" style="font-size: 40px">account_circle</i>  
                                &nbsp    
                                {{__('rw_profile.header')}}
                            </div>
                        </h5>
                    </div>
         <!-- BUTTON BAR  -->
                    <div class="card-header rw-buttonbar" style="padding:5px;">  
                        <b>                      
                            <a class="rw-icons rw-grey" href="{{ route('home') }}">
                                <i class="material-icons">arrow_back</i> 
                                {{__('rw_products.back')}}
                            </a>
                            <a class="rw-icons rw-grey pull-right" href="javascript:{}" onclick="document.getElementById('profileForm').submit(); return false;">
                                <i class="material-icons">save</i>  
                                {{__('rw_login.save')}}
                            </a>         
                        </b>        
                    </div>  
        <!-- TAB MENU --> 
                    <div class="card-header  bg-light" style="padding:0;">            
                        <nav class="nav nav-tabs" id="profileTab" role="tablist">
                            <a class="nav-item nav-link active"  style="padding:5px;" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">
                                <span class = "rw-icons"> 
                                    <i class="material-icons" style="text-align:center; font-size: 35px">info</i>
                                    <span class="rw-desktop">{{__('rw_profile.profile')}}</span>
                                </span>
                            </a>
                            &nbsp
                            <a class="nav-item nav-link"  style="padding:5px;" id="nav-photo-tab" data-toggle="tab" href="#nav-photo" role="tab" aria-controls="nav-photo" aria-selected="true">
                                <span class = "rw-icons"> 
                                    <i class="material-icons" style="text-align:center;  font-size: 35px">photo_camera</i>
                                    <span class="rw-desktop">{{__('rw_profile.photo')}}</span>
                                </span>
                            </a>
                            &nbsp
                            <a class="nav-item nav-link"  style="padding:5px;" id="nav-user-tab" data-toggle="tab" href="#nav-user" role="tab" aria-controls="nav-user" aria-selected="true">
                                <span class = "rw-icons"> 
                                    <i class="material-icons" style="text-align:center;  font-size: 35px">verified_user</i>
                                    <span class="rw-desktop">{{__('rw_profile.user')}}</span>
                                </span>
                            </a>
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
                    <!-- Profile -->
                                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="card-header bg-light border-light">  
                                            <h5> {{__('rw_profile.personal_info')}}</h5>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">                              
                                                <label for="first_name" class="col-form-label text-primary">{{__('rw_profile.firstname')}}</label>
                                                <input type="text" class="form-control rw-input" id="first_name" name="first_name" value="{{ old('first_name', $profile->first_name) }}"/> 
                                            </div>
                                            <div class="form-group col-md-8">                              
                                                <label for="last_name" class="col-form-label text-primary">{{__('rw_profile.lastname')}}</label>                                              
                                                <input type="text" class="form-control rw-input" id="last_name" name="last_name" value="{{ old('last_name', $profile->last_name) }}"/>                                               
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="birthday" class="text-primary">{{__('rw_profile.birth_date')}}</label>
                                                <input type="date" class="form-control rw-input" id="birthday" name="birthday" value="{{ old('birthday', $profile->birthday) }}"/>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="nationality" class="text-primary">{{__('rw_profile.nationality')}}</label>
                                                <input type="text" class="form-control rw-input" id="nationality" name="nationality" value="{{ old('nationality', $profile->nationality) }}"/>
                                            </div>
                                        </div>
                                    
                                        <div class="card-header bg-light border-light"> 
                                            <h5> {{__('rw_profile.address_info')}}</h5>
                                        </div>
                                        <br>
                                    
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="addr1_street" class="text-primary">{{__('rw_profile.street')}}</label>
                                                <input type="text" class="form-control rw-input" id="addr1_street" name = "addr1_street" value="{{ old('addr1_street', $profile->addr1_street) }}"/>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="addr1_housenr" class="text-primary">{{__('rw_profile.housenr')}}</label>
                                                <input type="text" class="form-control rw-input" id="addr1_housenr" name="addr1_housenr" value="{{ old('addr1_housenr', $profile->addr1_housenr) }}"/>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="addr1_bus" class="text-primary">{{__('rw_profile.bus')}}</label></label>
                                                <input type="text" class="form-control rw-input" id="addr1_bus" name="addr1_bus" value="{{ old('addr1_bus', $profile->addr1_bus) }}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label for="addr1_postcode" class="text-primary">{{__('rw_profile.postcode')}}</label>
                                                <input type="text" class="form-control rw-input" id="addr1_postcode" name="addr1_postcode" value="{{ old('addr1_postcode', $profile->addr1_postcode) }}"/>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="addr1_city" class="text-primary">{{__('rw_profile.city')}}</label>
                                                <input type="text" class="form-control rw-input" id="addr1_city" name="addr1_city" value="{{ old('addr1_city', $profile->addr1_city) }}"/>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="addr1_country" class="text-primary">{{__('rw_profile.country')}}</label>
                                                <div class="input-group rw-icons">
                                                    <select class="form-control rw-input" id="addr1_country" name="addr1_country" title="Selecteer...">
                                                        <option selected disabled>{{__('rw_profile.select')}}</option>
                                                        <option value="Belgium" {{ $profile->addr1_country == "Belgium" ?  'selected="selected"' : ''}}>{{__('rw_profile.belgium')}}</option>
                                                        <option value="Netherlands" {{ $profile->addr1_country == "Netherlands" ?  'selected="selected"' : ''}}>{{__('rw_profile.netherland')}}</option>
                                                    </select> 
                                                    <i class="material-icons">arrow_drop_down_circle</i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header bg-light border-light"> 
                                            <h5> {{__('rw_profile.contact_info')}}</h5>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">                              
                                                <label for="phone_1" class="col-form-label text-primary">{{__('rw_profile.phone')}}</label>
                                                <input type="text" class="form-control rw-input" id="phone_1" name="phone_1" value="{{ old('phone_1', $profile->phone_1)}}">
                                            </div>
                                            <div class="form-group col-md-4">                              
                                                <label for="mobile_1" class="col-form-label text-primary">{{__('rw_profile.mobile')}}</label>                                        
                                                <input type="text" class="form-control rw-input" id="mobile_1" name="mobile_1" value="{{ old('mobile_1', $profile->mobile_1) }}">                                               
                                            </div>
                                            <div class="form-group col-md-4">                              
                                                <label for="fax_1" class="col-form-label text-primary">{{__('rw_profile.fax')}}</label>                                              
                                                <input type="text" class="form-control rw-input" id="fax" name="fax_1" value="{{ old('fax_1', $profile->fax_1) }}">                                              
                                            </div>
                                        </div>
                                    
                                        <div class="card-header bg-light border-light"> 
                                            <div class="form-row">
                                                <h5>{{__('rw_profile.company_info')}}</h5>  
                                            </div>
                                            <div class="form-row">
                                                <h6>{{__('rw_profile.has_vat')}}</h6>
                                            </div>
                                        </div> 
                                        <br>     
                                    
                                        <div class="form-row">
                                            <div class="form-group col-md-6">                              
                                                <label for="company_name" class="col-form-label text-primary">{{__('rw_profile.company_name')}}</label>
                                                <div>
                                                    <input type="text" class="form-control rw-input" id="company_name" name="company_name" value="{{ old('company_name', $profile->company_name) }}">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">                              
                                                <label for="vat_number" class="col-form-label text-primary">{{__('rw_profile.vat_number')}}</label>
                                                <div>
                                                    <input type="text" class="form-control rw-input" id="vat_number" name="vat_number" value="{{ old('vat_number', $profile->vat_number) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="company_addr_street" class="text-primary">{{__('rw_profile.street')}}</label>
                                                <input type="text" class="form-control rw-input" id="company_addr_street" name="company_addr_street" value="{{ old('company_addr_street', $profile->company_addr_street) }}">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="company_addr_housenr text-primary" class="text-primary">{{__('rw_profile.housenr')}}</label>
                                                <input type="text" class="form-control rw-input" id="company_addr_housenr" name="company_addr_housenr" value="{{ old('company_addr_housenr', $profile->company_addr_housenr) }}">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="company_addr_bus" class="text-primary">{{__('rw_profile.bus')}}</label>
                                                <input type="text" class="form-control rw-input" id="company_addr_bus" name="company_addr_bus" value="{{ old('company_addr_bus', $profile->company_addr_bus) }}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label for="company_addr_zip" class="text-primary">{{__('rw_profile.postcode')}}</label>
                                                <input type="text" class="form-control rw-input" id="company_addr_postcode" name="company_addr_postcode" value="{{ old('company_addr_postcode', $profile->company_addr_postcode) }}">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="company_addr_city" class="text-primary">{{__('rw_profile.city')}}</label>
                                                <input type="text" class="form-control rw-input" id="company_addr_city" name="company_addr_city" value="{{ old('company_addr_city', $profile->company_addr_city) }}">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="company_addr_country" class="text-primary">{{__('rw_profile.country')}}</label>
                                                <input type="text" class="form-control rw-input" id="company_addr_country" name="company_addr_country" value="{{ old('company_addr_country', $profile->company_addr_country) }}">
                                            </div>
                                        </div>
                                    
                                        <div class="card-header bg-light border-light"> 
                                            <h5>{{__('rw_profile.other_info')}}</h5>
                                        </div>
                                        <br>
                                    
                                        <div class="form-row">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" id="toggle_newsletter" name="toggle_newsletter" class="switch-input">
                                                    <label for="toggle_newsletter" class="switch-label text-primary">{{__('rw_profile.newsletter')}} 
                                                    <input type="hidden" id="newsletter" name="newsletter" value="{{ old('newsletter', $profile->newsletter) }}">           
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                    <!-- PHOTO TAB ------------------------------>
                                    <div class="tab-pane fade" id="nav-photo" role="tabpanel" aria-labelledby="nav-photo-tab">
                                        <div class="form-group"> 
                                            <div class="row justify-content-center text-center"> 
                                                <div class="col-lg-4">                                                           
                                                    <br> 
                                                    <input  type="file" id="avatar" name="avatar" 
                                                            class="dropify" 
                                                            data-max-file-size="2M" 
                                                            data-allowed-file-extensions="gif jpg jpeg png" 
                                                            data-show-remove="false"    
                                                            data-default-file="{{ old('picture', $profile->picture) }}">  
                                                    <br>
                                                    <br>      
                                                </div>
                                            </div> <!-- class --> 
                                        </div> <!-- form group -->   
                                    </div>
                    <!--- USER INFO TAB -->
                                    <div class="tab-pane fade" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
                                        <div class="col-lg-12">
                                            <div class="alert alert-primary" role="alert">
                                                <h6>
                                                    U hebt een gebruiker aan gemaakt met de Nickname {{ $user->nickname}}.<br>
                                                    Het email adres is {{ $user->email}}.<br>

                                                    Indien deze gegevens NIET correct zijn gelieve ons te contacteren !
                                                </h6>
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

@endsection
@section('javascript')
    <script src="/js/dropify/dist/js/dropify.min.js"></script>
    <script type="text/javascript" charset="utf-8">

        window.onload = function() {
            document.getElementById("first_name").focus();
        };

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

            //(RW) Slide UP  alert success messages
            $("#profile-success").fadeTo(2000, 500).slideUp(500, function(){
            // $("#profile-success").alert('close');
                setTimeout(function() {
                    $('.alert').fadeOut('slow');}, 3000
                );    
            }); 

            //(RW) Set switch on init 
            var newsletterSwitch = $('#newsletter').val();
            console.log('newsletter switch : ' + newsletterSwitch );
            if(newsletterSwitch == 1){
                console.log('setchecked');
                $('#toggle_newsletter').prop('checked', true);
            }else{
                $('#toggle_newsletter').prop('checked', false);
            }

            //(RW) Toggle newsletter checkbox - Switch
            $(function() {
                $('#toggle_newsletter').change(function() {
                    if($(this).prop('checked')){
                        console.log('checked');
                        $("#newsletter").val("1");
                    }else{
                        console.log('UNchecked');
                        $("#newsletter").prop('value',0);
                        $("#toggle_newsletter").prop('checked', false);
                    }
                })
            })
        
            //(RW) Upload Profile picture
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
    </script>
@endsection

