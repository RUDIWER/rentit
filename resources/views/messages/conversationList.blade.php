@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-md-centerrow justify-content-md-center">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header text-white bg-primary rw-title"  style="padding-top:§px; padding-bottom:0px;">
                        <h5>
                            <div class="row h-100 justify-content-center align-items-center"> 
                                <i class="material-icons" style="font-size: 40px">forum</i>  
                                &nbsp  
                                {{__('rw_messaging.conversation_title')}}  
                            </div>
                        </h5>
                    </div>
            <!-- BUTTON BAR  -->
                    <div class="card-header rw-buttonbar" style="padding:5px;">  
                        <b> 
                            <a class="rw-icons rw-grey" href="javascript:history.back()">
                                <i class="material-icons">arrow_back</i> 
                                {{__('rw_products.back')}}
                            </a>
                        </b>
                    </div>
                    <br>
        <!--   BODY -->
                    <div class="card-body"> 
                   
                    @foreach($messages as $message)
                        @if($message->sender_id != $message->owner_id)
                            <div class="row justify-content-start">
                                <div class="col-sm-10">
                                    <div class="alert alert-info alert-block">
                                        <strong>
                                            <div class="row h-100 justify-content-center align-items-center"> 
                                                <i class="material-icons">move_to_inbox</i>  
                                                {{__('rw_messaging.from')}} {{ $message->sender->nickname }} ->  {{__('rw_messaging.to_me')}}
                                                &nbsp&nbsp&nbsp({{ $message->updated_at->diffForHumans()}})
                                            </div>
                                        </strong>
                                        <hr>
                                        {{ $message->message }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row justify-content-end">
                                <div class="col-sm-10 offset-sm-2">
                                    <div class="alert alert-success alert-block">
                                        <strong>
                                            <div class="row h-100 justify-content-center align-items-center">      
                                                <i class="material-icons">send</i>  
                                                {{__('rw_messaging.from_me')}} -> {{ $message->receiver->nickname }}
                                                &nbsp&nbsp&nbsp({{ $message->updated_at->diffForHumans()}})         
                                            </div>
                                        </strong>
                                        <hr>  
                                       {{ $message->message }}
                                    </div>
                                </div>
                            </div>
                        @endif

                    @endforeach

                    
                    
                    </div> 
                </div>
            </div>
        </div>   
    </div>

<!-- Call to alertModal -->

    @component('/layouts/alertModal')
        {{__('rw_messaging.del-mail')}}
    @endcomponent


@endsection
@section('javascript')
    <script type="text/javascript" charset="utf-8">

        $(document).ready(function() {
        
          
        });
    </script>
@endsection
