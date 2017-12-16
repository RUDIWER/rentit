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
                            &nbsp 
                            {{__('rw_messaging.inbox')}} 
                        </div>
                    </h4>
                </div>
                <div class="card-body"> 
                    <div class="row justify-content-md-center"> 
                        <div id="dataTableWrapper" style="width:100%" class="dataTableParentHidden">   
                            <table id="messageHeaderTable" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                                <thead class="thead-default">
                                    <tr>
                                        <th style="display:none;">nr</th>
                                        <th></th>
                                        <th>{{__('rw_messaging.fromto')}}</th>
                                        <th>{{__('rw_messaging.subject')}}</th>
                                        <th> {{__('rw_messaging.date')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($messageHeaders as $messageHeader)
                                    @if($messageHeader->unread == 1)
                                        <tr>
                                    @else
                                        <tr class="rw-blue">
                                    @endif
                                        @if($messageHeader->unread == 1)
                                            <td><i class="fas fa-envelope rw-orange" ></i></td>
                                        @else
                                            <td><i class="fas fa-envelope-open rw-blue"></i></td>
                                        @endif
                                            <td style="display:none;">{{ $messageHeader->chain_id }}</td>
                                            @if($messageHeader->sender_id == $user->id)
                                                <td>Van mij -> {{ $messageHeader->receiver->nickname }}</td>
                                            @else
                                            <td>Van {{ $messageHeader->sender->nickname }} -> mij</td>
                                            @endif
                                            <td>{{ $messageHeader->title }}</td>
                                            <td>{{ $messageHeader->updated_at->diffForHumans()}}</td>
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
    console.log('Test');

    $(document).ready(function() {

        var messageHeaderTable = $('#messageHeaderTable').DataTable( {
                                "info":    false,
                                "scrollY":        "25em",
                                "scrollCollapse": true,
                                "paging":         false,
                                language: {
                                    search: "{{__('rw_products.search')}}",
                                    zeroRecords: "{{__('rw_products.zero_records')}}"
                                },
                               
        });
        $('#dataTableWrapper').removeClass('dataTableParentHidden');


        //(RW) Click on table row
        $('#messageHeaderTable').on('click', 'tr', function () {
            var row = messageHeaderTable.row(this).data();
            console.log(row);
            var chainId = row[1];
            console.log(chainId);
            var path = "./my-messages/details/" + chainId;
            window.location.href = path;
        });

        $('div.dataTables_filter input').focus();
    });
</script>
@endsection
