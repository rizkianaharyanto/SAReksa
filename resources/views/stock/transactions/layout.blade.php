@extends('stock.standard-layout')
@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/stock/datatables/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/stock/datatables/css/buttons.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/stock/datatables/css/select.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/stock/datatables/css/fixedHeader.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/stock/bootstrap-select/css/bootstrap-select.css')}}">

@endsection
@section('main-content')
@if (session('status'))
<div class="alert alert-warning">
    {{ session('status') }}
</div>
@endif
<div class="row">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">@yield('title')</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Transaksi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- data table  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">@yield('title') - Anda Dapat Mengexport ke bentuk yang anda inginkan</h5>
                @section('button-tambah-data')

                <button class="btn btn-primary" data-toggle="modal" data-target="#modal">Tambah data</button>
                @show
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                        <thead>
                            <tr>
                                @section('table-header')

                                @show
                            </tr>
                        </thead>
                        <tbody>
                            @section('table-body')

                            @show
                        </tbody>
                        <tfoot>
                            <tr>
                                @section('table-footer')

                                @endsection
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end data table  -->
    <!-- ============================================================== -->
    @section('modal-form')

    <x-stock.modal>
        <form action="@yield('modal-form-action')" method="@yield('modal-form-method')">
            @csrf
            @section('modal-content')

            @show
    </x-stock.modal>

    @show
</div>
@endsection
@section('scripts')
@parent

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="{{asset('vendor/stock/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/stock/multi-select/js/jquery.multi-select.js')}}"></script>

<script src="{{asset('vendor/stock/datatables/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/stock/datatables/js/data-table.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script src="{{asset('vendor/stock/bootstrap-select/js/bootstrap-select.js')}}"></script>

@endsection