@extends('layouts.app')

@section('content')
    <div class="container h-100">
    <input type="hidden" id="sentBox" name="sendBox" value="{{ $sentBox }}"/> 
        <div class="row justify-content-md-centerrow justify-content-md-center">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header text-white bg-primary rw-title"  style="padding-top:§px; padding-bottom:0px;">
                        <h5>
                            <div class="row h-100 justify-content-center align-items-center"> 
                                <i class="material-icons" style="font-size: 40px">contact_mail</i>  
                                &nbsp  
                                {{__('rw_login.contact_title')}} {{ $message->receiver->profile->nickname }}   
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
                            @if($message->sender_id != Auth::user()->id)                          
                                <a class="rw-icons rw-grey pull-right" href="/message/create/{{$message->sender_id}}/0/{{$message->chain_id}}">
                                    <i class="material-icons">reply</i>
                                    {{__('rw_messaging.reply')}}
                                </a>       
                            @endif 
                            <a id="delete" class="rw-icons rw-red pull-right" href="#" data-toggle="modal" data-target="#rw-alert-modal" >
                                <i class="material-icons">delete_forever</i>
                                {{__('rw_messaging.delete')}}&nbsp&nbsp&nbsp&nbsp&nbsp
                            </a> 
                        </b>
                    </div>
                    <br>
                    <div class="card-body"> 
                        
                        <div class="form-row">
                            <div class="form-group col-md-12">                              
                                <label for="title" class="col-form-label text-primary" style="padding-bottom:1em;">{{__('rw_messaging.title_label')}}</label><br>
                                <h6 class="card-subtitle mb-2 text-muted">{{$message->title}}</h6>
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="form-group col-md-12">                              
                                <label for="message" class="col-form-label text-primary">{{__('rw_messaging.subject_label')}}</label>
                                @if($message->sender_id != Auth::user()->id) 
                                    <div class="alert alert-info alert-block">
                                @else                         
                                    <div class="alert alert-success alert-block">
                                @endif
                                {{ $message->message }}
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="card-footer"> 
                        <b> 
                            <a class="rw-icons rw-grey pull-right" href="/my-messages/conversation/{{$message->chain_id}}">
                                <i class="material-icons">forum</i> 
                                {{__('rw_messaging.conversation')}}
                            </a>
                        </b>
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
            var sentBox = $('#sentBox').val(); 
            console.log(sentBox);          

            // CHECK ON PRESS'YES' BUTTON IN MODAL
            $("#modal-save").on('click', function() {
                console.log('OP SAVE GEDRUKT');
                window.location.href = "{{ URL::to('message/delete/' . $message->id . '/' . $sentBox) }}" 
            });
        });

      

    </script>
@endsection
