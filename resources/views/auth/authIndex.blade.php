@extends('layouts.app')

@section('content')
<div class="container h-100">
    <form class="form" method="POST" action="{{ route('login') }}">
        <div class="row justify-content-md-centerrow justify-content-md-center">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header text-white bg-primary rw-title" style="padding-top:7px; padding-bottom:0px;">
                        <h5>
                            <div class="row h-100 justify-content-center align-items-center"> 
                                <i class="material-icons" style="font-size: 40px">perm_identity</i>  
                                &nbsp  
                                {{__('rw_login.needed')}}
                            </div>
                        </h5>
                    </div>
        <!-- BUTTON BAR  -->
                    <div class="card-header rw-buttonbar">  
                        <b>                      
                            <a class="rw-icons rw-grey" href="javascript:history.back()">
                                <i class="material-icons">arrow_back</i> 
                                {{__('rw_products.back')}}
                            </a>

                    </div>
                   
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
@endsection
