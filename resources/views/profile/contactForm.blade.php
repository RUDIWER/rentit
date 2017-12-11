@extends('layouts.app')

@section('content')
<div class="container h-100">
    <form class="form" method="POST" action="{{ route('login') }}">
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
                                <img src="{{ $profile->picture }}" width="60px" height="60px" class="rounded-circle"/>
                                <br>
                            </div>
                            <div class="row h-100 justify-content-center align-items-center"> 
                                <i class="material-icons" style="font-size: 50px">lock</i>  
                                &nbsp  
                                {{__('rw_login.contact_title')}} {{ $loggedInUser->nickname }}   
                            </div>
                        </h4>
                    </div>
                    </h2>
                    <br>
                    <div class="card-body">                     
                        <div class="alert alert-danger">
                            OPGELET !!!<br>
                            Neem geen contactgegevens op (zoals e-mailadres, telefoonnumer, enz.) in je bericht.<br> 
                            Berichten die contactgegevens bevatten worden niet afgeleverd.<br> 
                            Voor je eigen veiligheid raden we je aan om alle communicatie en boekingen via ons platform te laten verlopen.
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">                              
                                <label for="mail_text" class="col-form-label text-primary">{{__('rw_login.mail_text')}}</label>
                                <textarea type="text" class="form-control rw-input" rows="10" id="mail_text" name="mail_text"></textarea> 
                            </div>
                        </div> 
                    </div>
               
                    <div class="card-footer bg-light text-primary text-right">  
                        <button id="submit" type="submit" class="btn btn-primary">
                                    <i class="material-icons" style="font-size:30px; vertical-align: middle;">mail_outlineslime</i>  
                                    {{__('rw_login.send')}}
                        </button>
                    </div>
                 </div>
            </div>
        </div>
    </form>    
</div>

<script>
window.onload = function() {
  document.getElementById("email").focus();
};
</script>
@endsection
