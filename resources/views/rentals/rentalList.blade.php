@extends('layouts.app')
@section('content')
    <div class="container h-100">
        <div class="row justify-content-md-centerrow justify-content-md-center">  
            <div class="col-lg-12">
                <div class="h-100 card card-primary">
                    <div class="card-header text-white bg-primary rw-title" style="padding-top:6px; padding-bottom:0px;">
                        <h5>
                            @if($renting == 1)
                                <div class="row h-100 justify-content-center align-items-center">  
                                    <i class="material-icons" style="font-size: 40px ">euro_symbol</i>  
                                    <i class="material-icons" style="font-size: 40px ">arrow_forward</i> 
                                    &nbsp    
                                    {{__('rw_rentit.rent_header')}}
                                </div>
                            @else
                                <div class="row h-100 justify-content-center align-items-center">  
                                    <i class="material-icons" style="font-size: 40px ">euro_symbol</i>
                                    <i class="material-icons" style="font-size: 40px ">arrow_back</i> 
                                    &nbsp    
                                    {{__('rw_rentit.lease_header')}}
                                </div>
                            @endif
                        </h5>
                    </div>
        <!-- BUTTON BAR  -->
                    <div class="card-header rw-buttonbar" style="padding:5px;">                      
                        <b>     
                            <a class="rw-icons rw-grey" href="{{ route('home') }}">
                                <i class="material-icons">arrow_back</i>
                                {{__('rw_products.back')}}
                            </a>
                        <!--
                            <a class="rw-icons rw-grey pull-right" href="/my-products/create">
                                <i class="material-icons">add_box</i>
                                {{__('rw_products.add')}}
                            </a> 
                        -->
                        </b>
                    </div>
                    <div class="card-body"> 
                        <div class="row justify-content-md-center"> 
                            <div id="dataTableWrapper" style="width:100%" class="dataTableParentHidden">
                                <table id="rentals-table" class="dn table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                                    <thead class="thead-default">
                                        <tr>
                                            <th>id</th>
                                            <th>{{__('rw_rentit.rental_status')}}</th>
                                            <th>{{__('rw_rentit.product_title')}}</th>
                                            <th> {{__('rw_rentit.owner')}}</th>
                                            <th>{{__('rw_rentit.created_at')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rentals as $rental)
                                        <tr>
                                            <td>{{ $rental->id }}</td>
                                            <td>{{ $rental->status_id }}</td>
                                            <td>{{ $rental->product->title}}</td>
                                            <td>{{ $rental->owner->nickname }}</td>
                                            <td>{{ $rental->created_at }}</td>
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
</div>
</div> <!-- (RW) end #app vue instance !!!! -->

@endsection
@section('javascript')
<script type="text/javascript" charset="utf-8">

$(document).ready(function() {

    var rentalTable = $('#product-table').DataTable( {
                            "info":     false,
                            "order": [[ 0, "asc" ]],
                            "scrollY": "25em",
                            "scrollCollapse": true,
                            "paging":         false,
                            language: {
                                search: "{{__('rw_products.search')}}",
                                zeroRecords: "{{__('rw_products.zero_records')}}"
                            },
                            "columnDefs": [
                                {
                                    "targets": [ 0 ],
                                    "visible": false,
                                    "searchable": false
                                },
                            ]
                                  
    });
    $('#dataTableWrapper').removeClass('dataTableParentHidden');

    //(RW) Click on table row
    $('#rental-table').on('click', 'tr', function () {
        console.log(productTable.row(this).data());
        var row = productTable.row(this).data();
        var rentalId = row[0];
        var path = "./my-products/edit/" + productId;
        window.location.href = path;
    });

    $('div.dataTables_filter input').focus();

    //(RW) Slide UP  alert success messages
    $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-success").alert('close');
    });
   
});

</script>

@endsection