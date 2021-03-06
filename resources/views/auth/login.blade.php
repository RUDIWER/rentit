@extends('layouts.app')

@section('content')
<div class="container h-100">
    <form id="loginForm" class="form" method="POST" action="{{ route('login') }}">
        <div class="row justify-content-md-centerrow justify-content-md-center">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header text-white bg-primary rw-title" style="padding-top:6px; padding-bottom:0px;">
                        <h5>
                            <div class="row h-100 justify-content-center align-items-center"> 
                                <i class="material-icons" style="font-size: 40px">lock</i>  
                                &nbsp  
                                {{__('rw_login.login')}}
                            </div>
                        </h5>
                    </div>
        <!-- BUTTON BAR  -->
                    <div class="card-header rw-buttonbar" style="padding:5px;">  
                        <b>                      
                            <a class="rw-icons rw-grey" href="/">
                                <i class="material-icons">arrow_back</i> 
                                {{__('rw_profile.back')}}
                            </a>
                            <a class="rw-icons rw-grey pull-right" href="javascript:{}" onclick="document.getElementById('loginForm').submit(); return false;">
                                <i class="material-icons">done</i> 
                                {{__('rw_login.login')}}
                            </a>
                        </b> 
                    </div>                      
                    <br>
                    <div class="card-body">
                        {{ csrf_field() }}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="email" class="col-form-label text-primary">{{__('rw_login.email')}}</label>                    
                                <div class="input-group rw-icons">  
                                    <i class="material-icons">email</i>&nbsp  
                                    <input id="email" type="email" class="rw-input form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" placeholder="{{__('rw_login.ph_email')}}" value="{{ old('email') }}" required autofocus>   
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>   
                                <small id="emailHelp" class="form-text text-muted">{{__('rw_login.share_email')}}</small>                              
                               
                            </div>
                        </div>
                        <br><br>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="password" class="col-form-label text-primary">{{__('rw_login.password')}}</label>                    
                                <div class="input-group rw-icons">
                                    <i class="material-icons">vpn_key</i>&nbsp 
                                    <input id="password" type="password" class="rw-input form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="{{__('rw_login.ph_password')}}" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="rw-input form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}> {{__('rw_login.remember_me')}}
                                    </label>
                                </div>
                            </div>
                        </div> 
                        <a class="btn btn-link pull-right" href="{{ route('password.request') }}">
                            {{__('rw_login.forgot_password')}}
                        </a>             
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
