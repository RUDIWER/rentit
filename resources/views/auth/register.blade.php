@extends('layouts.app   ')

@section('content')
    <div class="container h-100">
        <form class="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="row justify-content-md-centerrow justify-content-md-center">
                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header text-white bg-primary rw-title">
                            <div class="rw-icons">
                                <i class="material-icons">arrow_back</i> 
                                <a class="text-white" href="/">
                                    {{__('rw_profile.back')}}
                                </a>
                            </div>
                            <h4>
                                <div class="row h-100 justify-content-center align-items-center">  
                                    <i class="material-icons" style="font-size: 50px">people</i>  
                                    &nbsp    
                                    {{__('rw_login.register')}}
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                              @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <br>
                            <div class="row justify-content-md-center">
                                <div class="col-lg-8">      
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="nickname" class="col-form-label text-primary">{{__('rw_login.nickname')}}</label>                    
                                            <div class="input-group rw-icons">
                                                <i class="material-icons">favorite</i>&nbsp  
                                                <input id="nickname" type="text" class="rw-input form-control {{ $errors->has('nickname') ? 'is-invalid' : '' }}" name="nickname" placeholder="{{__('rw_login.ph_nickname')}}" value="{{ old('nickname') }}" required autofocus>
                                                @if ($errors->has('nickname'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('nickname') }}
                                                    </div>
                                                @endif  
                                            </div> 
                                        </div>
                                    </div>
                                    <br>
                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email" class="col-form-label text-primary">{{__('rw_login.email')}}</label>                    
                                            <div class="input-group">
                                                <div class="input-group rw-icons">
                                                    <i class="material-icons">email</i>&nbsp  
                                                    <input id="email" type="email" class="rw-input form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" placeholder="{{__('rw_login.ph_email')}}" value="{{ old('email') }}" required> 
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback">
                                                            {{ $errors->first('email') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div> 
                                            <small id="emailHelp" class="form-text text-muted">{{__('rw_login.share_email')}}</small> 
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="gender" class="col-form-label text-primary">{{__('rw_login.gender')}}</label> 
                                            <div class="input-group">                   
                                                <select class="custom-select" id="gender" name="gender" required>
                                                    <option selected="selected" value="male">{{__('rw_login.male')}}</option>
                                                    <option value="female">{{__('rw_login.female')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="password" class="col-form-label text-primary">{{__('rw_login.password')}}</label> 
                                            <div class="input-group rw-icons">
                                                <i class="material-icons">lock</i>&nbsp  
                                                <input id="password" type="password" class="rw-input form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="{{__('rw_login.ph_password')}}" required>
                                                @if ($errors->has('password'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                                @endif
                                            </div>        
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group rw-icons">
                                                <i class="material-icons">lock_outline</i>&nbsp  
                                                <input id="password-confirm" type="password" class="rw-input form-control" name="password_confirmation" placeholder="{{__('rw_login.confirm_password')}}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End body -->
                        <div class="card-footer  bg-light text-primary text-right">            
                            <button type="submit" class="btn btn-primary">
                            {{__('rw_login.register')}}
                            </button>                     
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('javascript')
    <script>
    window.onload = function() {
    document.getElementById("nickname").focus();
    };
    </script>
@endsection
