@extends('layouts.app')

@section('content')
<div class="container h-100">
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
                            <i class="material-icons" style="font-size: 50px">contact_mail</i>  
                        </div>
                    </h4>
                </div>
                <div class="card-body"> 
                    @foreach($messageHeaders as $messageHeader)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-light">   
                                    <div class="card-header">
                                        <b>{{ $messageHeader->sender_nickname }} aan mij</b><br>
                                        Titel : {{ $messageHeader->title }}                                 
                                    </div>
                                </div>
                            </div>
                        </div>        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
@endsection
