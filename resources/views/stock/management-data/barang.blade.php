@extends('stock.management-data.layout')
@section('title','Data Barang')
@section('css')
@parent
@endsection
@section('button-tambah-data')
<button class="btn btn-info" data-toggle="modal" data-target="#exampleModal"> Tambah Data Barang</button>

@endsection
@section('table-header')


<tr>
    <th>No.</th>
    <th>Kode Barang</th>
    <th>Kategori Barang</th>
    <th>Nama Barang</th>
    <th>Satuan Unit</th>
    <th>Harga Satuan</th>
    <th>Harga Grosir</th>
    <th>Nilai Barang</th>
    <th>Created at</th>
    <th>Updated At</th>
    <th>Opsi</th>
</tr>
@endsection


@section('table-body')


@foreach($barang as $index => $i)

<tr>
    <td>{{ $index+1 }}</td>
    <td>{{ $i->kode_barang }}</td>
    <td>{{ $i->kategori->nama_kategori }}</td>
    <td>{{ $i->nama_barang }}</td>
    <td>{{ $i->unit->nama_satuan }}</td>
    <td class="harga">{{$i->harga_retail}}</td>
    <td class="harga">{{$i->harga_grosir}}</td>
    <td class="harga">{{$i->nilai_barang}}</td>
    <td class=>{{$i->created_at->toDateString()}}</td>
    <td class=>{{\Carbon\Carbon::parse($i->updated_at)->format('d-m-Y')}}</td>


    <td>

        <div class="dropright">

            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="menu-icon fas fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                <a class="dropdown-item" href="" data-form="Edit Data"> Edit</a>
                <a class="delete-jquery dropdown-item" data-method="delete"
                    href="{{ route('barang.destroy', $i->id ) }}">Delete</a>
                <a class="dropdown-item " href="#">Details</a>
            </div>
        </div>


</tr>
@endforeach
@endsection



@section('modalForm')


@endsection

<x-stock.stepper-barang :kategoriBarang="$kategoriBarang" :satuanUnit="$satuanUnit" :gudangs="$gudangs">
</x-stock.stepper-barang>
@section('scripts')
@parent
<script src="{{asset('js/stock/jquery.mask.min.js')}}"></script>
<script>
    const title = "@yield('title')".toLowerCase().replace('data','').trim();
    const idSidebarLink = `link-${title}`.trim();
    console.log(idSidebarLink);
    $('#link-dashboard').removeClass('active');
    $(`#link-manajemen-data`).addClass('active');
    $(`#${idSidebarLink}`).addClass('active')
</script>
<script>
    $('.harga').html();
      $('.harga').mask('000.000.000.000', {reverse: true});

</script>
@endsection