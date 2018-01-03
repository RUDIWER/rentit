@extends('layouts.app')

@section('content')
<div class="container h-100">
    <form id="mailForm" class="form" method="POST" enctype="multipart/form-data"  action="/message/send/{{ $receiver->id }}/{{ $chain }}">
    {{ csrf_field() }}
        <div class="row justify-content-md-centerrow justify-content-md-center">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header text-white bg-primary rw-title" style="padding-top:6px; padding-bottom:0px;">
                        <h5>
                            <div class="row h-100 justify-content-center align-items-center"> 
                                <i class="material-icons" style="font-size: 40px">contact_mail</i>  
                                &nbsp  
                                {{__('rw_login.contact_title')}}  
                            </div>
                        </h5>
                    </div>
        <!-- BUTTON BAR  -->
                    <div class="card-header rw-buttonbar" style="padding:5px;">  
                        <b>                      
                            <a class="rw-icons rw-grey" href="javascript:window.history.go(-2);">
                                <i class="material-icons">arrow_back</i> 
                                {{__('rw_products.back')}}
                            </a>
                            <a class="rw-icons rw-grey pull-right" href="javascript:{}" onclick="document.getElementById('mailForm').submit(); return false;">
                                <i class="material-icons" style="font-size:30px; vertical-align: middle;">mail_outline</i>
                                {{__('rw_login.send')}}
                            </a>
                        </b>
                    </div>        
                    <br>
                    <div class="card-body"> 
                        @include('/layouts/flash-messages')
                        @if($chain)
                            <h6 class="rw-orange">{{__('rw_messaging.reply_message')}} {{ $receiver->nickname }}  </h6>
                        @endif 
                        <div class="form-row">
                            <div class="form-group col-md-12">                              
                                <label for="title" class="col-form-label text-primary"  style="padding-bottom:1em;">{{__('rw_messaging.title_label')}}</label><br>
                                <input type="hidden" id="title" name="title" value="{{ old('title', $title) }}"/> 

                                <h6 class="card-subtitle mb-2 text-muted">{{$title}}</h6>
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="form-group col-md-12">                              
                                <label for="mailto" class="col-form-label text-primary">{{__('rw_messaging.mail_to')}} {{ $receiver->nickname }}</label>     
                        <div class="form-row">
                            <div class="form-group col-md-12">                              
                                <label for="message" class="col-form-label text-primary">{{__('rw_login.mail_text')}}</label>
                                <textarea type="text" class="form-control rw-input" rows="10" id="message" name="message">{{ old('message') }}</textarea> 
                            </div>
                        </div> 
                        <div class="alert alert-warning">
                           
                            <b class="rw-icons"> <i class="material-icons">warning</i>  OPGELET !!!</b><br>
                            Neem geen contactgegevens op (zoals e-mailadres, Postadres, telefoonnumer, enz.) in je bericht.<br> 
                            Berichten die contactgegevens bevatten worden niet afgeleverd.<br> 
                            Voor je eigen veiligheid raden we je aan om alle communicatie en boekingen via ons platform te laten verlopen.
                        </div>
                    </div>  
                 </div>
            </div>
        </div>
    </form>    
</div>
@endsection
@section('javascript')
    <script type="text/javascript" charset="utf-8">
        window.onload = function() {
        document.getElementById("message").focus();
        };

        $(document).ready(function() {
            //(RW) Slide UP  alert success messages
            $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert-success").alert('close');
            });
        });

    </script>
@endsection
