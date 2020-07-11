@extends('penjualan.template.table', [
    'elementActive' => 'pembayaran'
])
@section('judul', 'Pembayaran Piutang')

@section('menu', 'Pembayaran Piutang')

@section('thead')
<tr>
    <th>Kode Pembayaran</th>
    <th>Pelanggan</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Posting</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($pembayarans as $pembayaran)
<tr>
    <td>{{ $pembayaran->kode_pembayaran }}</td>
    <td>{{ $pembayaran->pelanggan->nama_pelanggan }}</td>
    <td>{{ $pembayaran->tanggal }}</td>
    <td>{{ $pembayaran->total }}</td>
    <td>
        @if($pembayaran->status_posting == 'belum posting')Belum
        @else Sudah
        @endif
    </td>
    <td class="d-flex justify-content-between">
        <a title="Details" id="details" href="/penjualan/pembayarandetails/{{$pembayaran->id}}">
            <i style="cursor: pointer;color:#212120 " class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        @if($pembayaran->status_posting == 'belum posting')
        <a title="Edit" id="edit" href="/penjualan/pembayarans/{{$pembayaran->id}}/edit">
            <i style="cursor: pointer;color:#212120" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a title="Posting" id="posting"  data-toggle="modal" data-target="#posting-{{$pembayaran->id }}" title='Posting'>
        <i onmouseover="" style="cursor: pointer;color: #212120" class="fas fa-file-upload" title='Posting'>
                <span></span>
            </i>
        </a>
        @endif
        @if($pembayaran->status_posting == 'belum posting')
        <a title="Delete" id="delete" data-toggle="modal" data-target="#delete-{{$pembayaran->id }}">
            <i style="cursor: pointer;color:#212120" class="fas fa-trash">
                <span></span>
            </i>
        </a>
        @endif
    </td>
</tr>

@php
$delete = "delete-".$pembayaran->id
@endphp

@php
$posting = "posting-".$pembayaran->id
@endphp
<x-modal :id="$delete">
    <x-slot name="title">
        <h5 class="align-self-center">Hapus Pembayaran {{$pembayaran->kode_pembayaran}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-penjualan.pembayaran-delete :id="$pembayaran->id" />
    </x-slot>
</x-modal>
<x-modal :id="$posting">
    <x-slot name="title">
        <h5 class="align-self-center">Posting Pembayaran {{$pembayaran->kode_pembayaran}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-penjualan.pembayaran-posting :id="$pembayaran->id" />
    </x-slot>
</x-modal>
@endforeach
@endsection

@section('tambah')
<a href="/penjualan/pembayarans/create">
<a href="/penjualan/pembayarans/create" class="btn" style="background-color:#212120; color:white" >Tambah</a>

</a>
@endsection