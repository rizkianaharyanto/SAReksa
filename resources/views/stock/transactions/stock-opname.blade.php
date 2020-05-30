@extends('Management-Data.layout')

@section('tableHeader')

@section('css')
    @parent
@endsection
<tr>
    <th>Tanggal</th>
    <th>Kode Referensi</th>
    <th>Gudang</th>
    <th>Deskripsi</th>
    <th>Departemen</th>
    <th>Opsi</th>
</tr>
@endsection


@section('tableBody')



    <tr>
        @foreach ($stokOp as $op)
            
        <td>{{\Carbon\Carbon::parse($op->created_at)->format('d/m/Y')}}</td>
        <td>{{ $op->kode_ref }}</td>
        <td>{{ $op->gudang->kode_gudang}}</td>
        <td> {{ $op->deskripsi }} </td>
        <td> {{ $op->departemen }} </td>
        <td> <span>
                <a href="" data-form="Edit Data" data-toggle="modal" data-target=#modal> Edit</a></span> |
            <span>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <a class="delete-jquery" data-method="delete"
                    href="{{ route('stock-opname.destroy', $op->id ) }}">Delete</a> </span></td>
    
        @endforeach
    </tr>
@endsection
<x-steppermodal/>


<script>

</script>