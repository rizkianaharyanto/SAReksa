@extends('pembelian.template.table')

@section('judul', 'Faktur')

@section('halaman', 'Faktur')

@section('path')
<li><a href="#">Transaksi</a></li>
<li class="active">Faktur</li>
@endsection

@section('thead')
<tr>
    <th>Kode Faktur</th>
    <th>pemasok</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Status</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($fakturs as $faktur)
<tr>
    <td>{{ $faktur->kode_faktur }}</td>
    <td>{{ $faktur->pemasok->nama_pemasok }}</td>
    <td>{{ $faktur->tanggal }}</td>
    <td>{{ $faktur->total_harga }}</td>
    <td>{{ $faktur->status !=null ? $faktur->status  : '-' }} | 
        @if ($faktur->status_posting == 'sudah posting')
            sudah posting 
        @elseif ($faktur->status_posting == 'konfirmasi')
        <a href="/pembelian/ubahpsnfak/{{$faktur->id}}">posting</a>
        @else
        <a href="/pembelian/postingfak/{{$faktur->id}}">posting</a>
        @endif
    </td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/pembelian/fakturshow/{{$faktur->id}}">
            <button class="btn-info">
    
                <i style="cursor: pointer; " class="fas fa-info-circle">
                        <span></span>
                    </i>
            </button>
        </a>
        @if($faktur->status_posting == null)
        <!-- <a id="edit" href="/pembelian/fakturs/{{$faktur->id}}/edit">
            <button class="btn-warning">        
                <i style="cursor: pointer;" class="fas fa-edit">
                    <span></span>
                </i>
        </button>
        </a>
        <form method="POST" action="/pembelian/fakturs/{{$faktur->id}}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
        <a id="delete" data-toggle="modal" data-target="#delete-{{$faktur->id}}">
            <i style="cursor: pointer;" class="fas fa-trash">
                <span></span>
            </i>
        </a> -->
        @endif
    </td>
</tr>

@php
$delete = "delete-".$faktur->id
@endphp

<x-modal :id="$delete">
    <x-slot name="title">
        <h5 class="align-self-center">Hapus Faktur {{$faktur->kode_faktur}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-pembelian.faktur-delete :id="$faktur->id" />
    </x-slot>
</x-modal>
@endforeach

@endsection

@section('tambah')
<a href="/pembelian/fakturs/create">
    <button class="btn-sm btn-info">Tambah</button>
</a>

@endsection