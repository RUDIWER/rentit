@extends('layouts.app')

@section('content')
<div class="container h-100">
    <form class="form" method="POST" action="{{ route('login') }}">
        <div class="row justify-content-md-centerrow justify-content-md-center">
            <div class="col-lg-6">
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
                                <i class="material-icons" style="font-size: 50px">lock</i>  
                                &nbsp  
                                {{__('rw_login.')}}
                            </div>
                        </h4>
                    </div>
                    </h2>
                    <br>
                    <div class="card-body">
                        <div class="row h-100 justify-content-center align-items-center"> 
                            <h5>{{__('rw_login.user_required')}}
                                <br><br>
                                <a class="nav-link" href="{{ route('login') }}">{{__('rw_login.login')}}</a>
                                <a class="nav-link" href="{{ route('register') }}">{{__('rw_login.register')}}</a> 
                            </h5>  
                        </div>
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
