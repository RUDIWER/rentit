@extends('layouts.app')

@section('content')
<input type="hidden" id="sentBox" name="sendBox" value="{{ $sentBox }}"/> 

<div class="container h-100">
    <div class="row justify-content-md-centerrow justify-content-md-center">
        <div class="col-lg-12">
            <div class="card card-primary">
                <div class="card-header text-white bg-primary rw-title" style="padding-top:6px; padding-bottom:0px;">
                    <h5>
                        <div class="row h-100 justify-content-center align-items-center"> 
                            <i class="material-icons" style="font-size: 40px">contact_mail</i> 
                            &nbsp 
                            @if($sentBox == 1)
                                {{__('rw_messaging.sentbox')}} 
                            @else
                                {{__('rw_messaging.inbox')}} 
                            @endif
                          
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
                        @if( $sentBox == 1)  <!--- if send items showed button to switch to inbox -->
                            <a class="rw-icons rw-grey pull-right" href="/my-messages/inbox">
                                <i class="material-icons">call_received</i>
                                {{__('rw_messaging.received_mail')}}
                            </a> 
                        @else
                            <a class="rw-icons rw-grey pull-right" href="/my-messages/sentbox">
                                <i class="material-icons">call_made</i>
                                {{__('rw_messaging.sent_mail')}}
                            </a> 
                        @endif   
                    </b>
                </div>
                <div class="card-body"> 
                    <div class="row justify-content-md-center"> 
                        <div id="dataTableWrapper" style="width:100%" class="dataTableParentHidden">           
                            <table id="messagesTable" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                                <thead class="thead-default">
                                    <tr>
                                        <th style="display:none;"></th>
                                        <th style="display:none;"></th>
                                        <th></th>
                                        <th>{{__('rw_messaging.fromto')}}</th>
                                        <th>{{__('rw_messaging.subject')}}</th>
                                        <th> {{__('rw_messaging.date')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($messages as $message)
                                    @if($message->unread == 1)
                                        <tr>
                                    @else
                                        <tr class="rw-blue">
                                    @endif
                                   
                                        @if($message->unread == 1)
                                            <td><i class="fas fa-envelope rw-orange" ></i></td>
                                        @else
                                            <td><i class="fas fa-envelope-open rw-blue"></i></td>
                                        @endif
                                            <td style="display:none;">{{ $message->chain_id }}</td>
                                            <td style="display:none;">{{ $message->id }}</td>
                                            @if($message->sender_id == $user->id)
                                                <td> {{__('rw_messaging.from_me')}} -> {{ $message->receiver->nickname }}</td>
                                            @else
                                            <td> {{__('rw_messaging.from')}} {{ $message->sender->nickname }} ->  {{__('rw_messaging.to_me')}}</td>
                                            @endif
                                            <td>{{ $message->title }}</td>
                                            <td>{{ $message->updated_at->diffForHumans()}}</td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script defer src="/fonts/vendor/font-awesome-5/svg-with-js/js/fontawesome-all.min.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        var sentBox = $('#sentBox').val();        
        var messagesTable = $('#messagesTable').DataTable( {
                                "info":    false,
                                "scrollY":        "35em",
                                "scrollCollapse": true,
                                "paging":         false,
                                language: {
                                    search: "{{__('rw_products.search')}}",
                                    zeroRecords: "{{__('rw_messaging.zero_records')}}"
                                },
                               
        });
        $('#dataTableWrapper').removeClass('dataTableParentHidden');

        //(RW) Click on table row
        $('#messagesTable').on('click', 'tr', function () {
            var row = messagesTable.row(this).data();
            var messageId = row[2];
            console.log(sentBox);
            var path = "./details/" + messageId + "/" + sentBox;
            window.location.href = path;
        });

        $('div.dataTables_filter input').focus();
    });
</script>
@endsection
