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
                @foreach($messages as $message)
                    @if($message->sender_id == $user->id)
                        <div class="row">
                            <div class="col-md-10">
                                <div class="card">            
                                    <div class="card-header text-white bg-secondary">
                                        <b>ik aan {{ $message->receiver_nickname }}</b><br>
                                        Titel : {{ $message->title }}
                                        <hr class="rw-hr-white"> 
                                        <br>  
                                        Boodschap : {{$message->message}}<br>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                      
                    @else
                        <div class="row  justify-content-md-center">
                            <div class="col-md-10">
                                <div class="card">   
                                    <div class="card-header text-white bg-dark">
                                        <b>{{ $message->sender_nickname }} aan mij</b><br>
                                        Titel : {{ $message->title }}
                                        <hr>
                                        <br>
                                        Boodschap : {{$message->message}}<br><br>
                                        <a class="text-white" href="{{ route('message.create',['id'=> $message->sender_id, 'chain' => $message->chain_id]) }}">Reply</a>
                                    </div>
                                </div>
                                <br>
                            </div>  
                        </div>      
                    @endif       
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
@endsection
