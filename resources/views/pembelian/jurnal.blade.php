@extends('template.table')

@section('judul', 'Jurnal Khusus Pembelian')

@section('halaman', 'Jurnal Khusus Pembelian')

@section('thead')
<tr>
    <th>Akun</th>
    <th>Debit</th>
    <th>Kredit</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($jurnals as $jurnal)
<tr>
    <td>Akun</td>
    <td>{{ $jurnal->debit }}</td>
    <td>{{ $jurnal->kredit }}</td>
    <td class="d-flex justify-content-between">
        <i onclick="" class="fas fa-info-circle"></i>
        <i onclick="" class="fas fa-edit"></i>
        <i onclick="" class="fas fa-trash"></i>
    </td>
</tr>
@endforeach
@endsection