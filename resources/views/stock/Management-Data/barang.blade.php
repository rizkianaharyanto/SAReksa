@extends('stock.Management-Data.layout')
@section('css')
@parent

@endsection
@section('title')
Data Barang
@endsection
   
    @section('tableHeader')
  
      
    <tr>
        <th>Kode Barang</th>
        <th>Kategori Barang</th>
        <th>Jenis Barang</th>
        <th>Satuan Unit</th>
        <th>Harga Satuan</th>
        <th>Harga Grosir</th>
        <th>Nilai Barang</th>
        <th>Created at</th>
        <th>Updated At</th>
        <th>Opsi</th>
    </tr>
    @endsection


    @section('tableBody')


        @foreach($data as $index => $i)

        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $i->kategori_barang }}</td>
            <td>{{$i->jenis_barang}}</td>
            <td>{{$i->unit->nama_satuan}}</td>
            <td class="harga">{{$i->harga_retail}}</td>
            <td class="harga">{{$i->harga_grosir}}</td>
            <td class="harga">{{$i->nilai_barang}}</td>
            <td class="harga">{{\Carbon\Carbon::parse($i->created_at)->format('d-m-Y')}}</td>
            <td class="harga">{{\Carbon\Carbon::parse($i->updated_at)->format('d-m-Y')}}</td>


            <td>

                <div class="dropright">
                    
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fas fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu" >
                    <!-- Dropdown menu links -->
                    <a class="dropdown-item" href="" data-form="Edit Data" data-toggle="modal" data-target=#modal> Edit</a>
                    <a class="delete-jquery dropdown-item" data-method="delete"
                    href="{{ route('barang.destroy', $i->id ) }}">Delete</a>
                    <a class="dropdown-item "href="#">Details</a>
                    </div>
                </div>

            </td>
                
                
                {{-- <span>
                    <a href="" data-form="Edit Data" data-toggle="modal" data-target=#modal> Edit</a></span> |
                <span>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <a class="delete-jquery" data-method="delete"
                        href="{{ route('barang.destroy', $i->id ) }}">Delete</a> </span></td>
        </tr> --}}
        @endforeach
    @endsection
    
@section('modalId')
modalKategoriBarang
@endsection 

@section('modalForm')
<label for="kodeKategori">Kode Kategori </label>
<input class="form-control" type="text" id="kodeKategori" name="kode_kategori">
<label for="namaKategori">Nama Kategori </label>
<input class="form-control" type="text" name="nama_kategori" id="namaKategori">
@endsection

@section('scripts')
@parent
<script src="{{asset('js/stock/jquery.mask.min.js')}}"></script>

<script>
    $('.harga').html();
      $('.harga').mask('000.000.000.000.000.000', {reverse: true});

</script>
@endsection