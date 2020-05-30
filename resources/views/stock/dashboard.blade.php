@extends('stock.layout')
@section('title')Dashboard @endsection
@section('side')
@endsection

@section('content')
@parent


    <div class="chart-container">
        <canvas id="stockSales">

        </canvas>
    </div>
    <div class="rank-table">
        <h3>Rangking Performa Penjualan Barang</h3>
        <table class="tabel-penjualan">
            <thead>
                <th>No</th>
                <th>Nama barang</th>
                <th>Total Penjualan</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td> Lorem ipsum</td>
                    <td>Rp.50.000.000</td>
                </tr>

                <tr>
                    <td>1</td>
                    <td> Lorem ipsum</td>
                    <td>Rp.50.000.000</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td> Lorem ipsum</td>
                    <td>Rp.50.000.000</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td> Lorem ipsum</td>
                    <td>Rp.50.000.000</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="right-table">
        <h3>List Gudang</h3>
        <table class="tabel-gudang">
            <thead>
                <th>No</th>
                <th>Nama barang</th>
                <th>Status</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td> Warehouse</td>
                    <td>Aktif</td>
                </tr>

                <tr>
                    <td>2</td>
                    <td> Rumah</td>
                    <td>Tidak Aktif</td>
                </tr>

            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
{{-- <script src="{{asset('js/dashboard-chart.js')}}"></script> --}}
<script src="{{asset('js/stock/roundedbar.js')}}"></script>

<script src="{{asset('js/stock/chart-config.js')}}"></script>

<script>
   
        var ctxBar = document.getElementById("stockSales");
                var myBarChart = new Chart(ctxBar, {
                    type: 'bar',
                    data: data,
                    options: options
                });

                // Horizontal Bar Chart
                
   
</script>

@endsection