@extends('pembelian.template.table')

@section('judul', 'Penerimaan Barang')

@section('halaman', 'Penerimaan Barang')

@section('thead')
<tr>
    <th>Kode Penerimaan</th>
    <th>pemasok</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Status</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($penerimaans as $penerimaan)
<tr>
    <td>{{ $penerimaan->kode_penerimaan }}</td>
    <td>{{ $penerimaan->pemasok->nama_pemasok }}</td>
    <td>{{ $penerimaan->tanggal }}</td>
    <td>{{ $penerimaan->total_harga }}</td>
    <td>
        @if ($penerimaan->status == 'sudah posting')
            sudah posting 
        @elseif ($penerimaan->status == 'selesai')
            selesai
        @elseif ($penerimaan->status == 'konfirmasi')
        <a href="/pembelian/ubahpsn/{{$penerimaan->id}}">posting</a>
        @else
        <a href="/pembelian/postingpnm/{{$penerimaan->id}}">konfirmasi</a>
        @endif
    </td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/pembelian/penerimaanshow/{{$penerimaan->id}}">
            <i style="cursor: pointer; " class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        @if($penerimaan->status == null)
        <a id="edit" href="/pembelian/penerimaans/{{$penerimaan->id}}/edit">
            <i style="cursor: pointer;" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a id="delete" data-toggle="modal" data-target="#delete-{{$penerimaan->id }}">
            <i style="cursor: pointer;" class="fas fa-trash">
                <span></span>
            </i>
        </a>
        @endif
    </td>
</tr>

@php
$delete = "delete-".$penerimaan->id
@endphp

<x-modal :id="$delete">
    <x-slot name="title">
        <h5 class="align-self-center">Hapus penerimaan {{$penerimaan->kode_penerimaan}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-pembelian.penerimaan-delete :id="$penerimaan->id" />
    </x-slot>
</x-modal>

@endforeach
@endsection


@section('tambah')
<a href="/pembelian/penerimaans/create">
    <i class="fas fa-plus mr-4" style="font-size:30px;color:#00BFA6; cursor: pointer;">
        <span></span>
    </i>
</a>
<a href="/pembelian/penerimaans/laporan">
      <i id="filter" onmouseover="tulisan()" class="fas fa-file-alt mr-4" style="font-size:25px;color:#00BFA6;cursor: pointer;">
        <span></span>
      </i>
    </a>
@endsection