@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-md-centerrow justify-content-md-center">  
            <div class="col-lg-12">
                <div class="h-100 card card-primary">
                    <div class="card-header text-white bg-primary rw-title">
                        <div class="rw-icons">
                            <i class="material-icons">arrow_back</i> 
                            <a class="text-white" href="{{ route('home') }}">
                                {{__('rw_products.back')}}
                            </a>
                        </div>
                        <h4>
                            <div class="row h-100 justify-content-center align-items-center">  
                                <i class="material-icons" style="font-size: 50px">card_giftcard</i>  
                                &nbsp    
                                {{__('rw_products.header')}}
                            </div>
                        </h4>
                    </div>
                   
                    <div class="card-body"> 
                        <div class="row justify-content-md-center">    
                            <table id="productTable" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                                <thead class="thead-default">
                                    <tr>
                                        <th>id</th>
                                        <th>{{__('rw_products.title')}}</th>
                                        <th> {{__('rw_products.sub_title')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->sub_title }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-primary text-right"> 
                   
                        <a href="/my-products/create" class="btn btn-primary pull-right">
                            <i class="material-icons" style="font-size:30px; vertical-align: middle;">add_box</i>
                            {{__('rw_products.add')}}
                        </a>   
                                              
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

    var productTable = $('#productTable').DataTable( {
                            "info":     false,
                            "order": [[ 0, "asc" ]],
                            "scrollY":        "25em",
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

    //(RW) Click on table row
    $('#productTable').on('click', 'tr', function () {
        console.log(productTable.row(this).data());
        var row = productTable.row(this).data();
        var productId = row[0];
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