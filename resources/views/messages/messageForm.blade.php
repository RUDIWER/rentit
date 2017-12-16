@extends('layouts.app')

@section('content')
<div class="container h-100">
    <form class="form" method="POST" enctype="multipart/form-data"  action="/message/send/{{ $receiver->id }}/{{ $chain }}">
    {{ csrf_field() }}
        <div class="row justify-content-md-centerrow justify-content-md-center">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header text-white bg-primary rw-title">
                        <div class="rw-icons">
                            <i class="material-icons">arrow_back</i> 
                            <a class="text-white" href="javascript:history.back()">
                                {{__('rw_profile.back')}}
                            </a>
                        </div>
                        <h4>
                            <div class="row h-100 justify-content-center align-items-center"> 
                                <img src="{{ $receiverProfile->picture }}" width="60px" height="60px" class="rounded-circle"/>
                                <br>
                            </div>
                            <div class="row h-100 justify-content-center align-items-center"> 
                                <i class="material-icons" style="font-size: 50px">contact_mail</i>  
                                &nbsp  
                                {{__('rw_login.contact_title')}} {{ $receiver->nickname }}   
                            </div>
                        </h4>
                    </div>
                    </h2>
                    <br>
                    <div class="card-body"> 
                        @if($chain)
                            THIS IS A REPLY MESSAGE !!!!
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <h4>{{__('rw_profile.errors')}}</h4>
                                <br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif (\Session::has('msg'))
                            <div id="profile-success" class="alert alert-success">    
                                <h4>{{__('rw_profile.send')}}</h4>   
                            </div>
                        @endif  
                        <div class="form-row">
                            <div class="form-group col-md-12">                              
                                <label for="title" class="col-form-label text-primary">{{__('rw_messaging.title_label')}}</label>
                                <input type="text" class="form-control rw-input" id="title" name="title"  value="{{ old('title', $title )}}"/>
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="form-group col-md-12">                              
                                <label for="message" class="col-form-label text-primary">{{__('rw_login.mail_text')}}</label>
                                <textarea type="text" class="form-control rw-input" rows="10" id="message" name="message">{{ old('message') }}</textarea> 
                            </div>
                        </div> 
                        <div class="alert alert-warning">
                            <b>OPGELET !!!</b><br>
                            Neem geen contactgegevens op (zoals e-mailadres, Postadres, telefoonnumer, enz.) in je bericht.<br> 
                            Berichten die contactgegevens bevatten worden niet afgeleverd.<br> 
                            Voor je eigen veiligheid raden we je aan om alle communicatie en boekingen via ons platform te laten verlopen.
                        </div>
                    </div>  
                   
                    <div class="card-footer bg-light text-primary text-right">  
                        <button id="submit" type="submit" class="btn btn-primary">
                            <i class="material-icons" style="font-size:30px; vertical-align: middle;">mail_outline</i>{{__('rw_login.send')}}
                        </button>
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
