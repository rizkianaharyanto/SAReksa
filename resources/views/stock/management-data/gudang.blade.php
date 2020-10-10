@extends('stock.management-data.layout')
@section('css')
@parent

@endsection

@section('title','Data Gudang')



@section('table-header')

<tr>
    <th>No</th>
    <th>Kode Gudang</th>
    <th>Alamat</th>
    <th>No Telp</th>
    <th>Status</th>
    <th>Dibuat Pada</th>
    <th>Terakhir Diubah</th>
    <th>Opsi</th>
</tr>
@endsection


@section('table-body')


@foreach ($allData as $index => $w)

<tr>
    <td>{{$index+1}}</td>
    <td>{{$w->kode_gudang}}</td>
    <td>{{$w->alamat}}</td>
    <td>{{$w->no_telp}}</td>
    <td>{{$w->status}}</td>
    <td class=>{{date('d-m-Y',strtotime($w->created_at))}}</td>
    <td class=>{{date('d-m-Y',strtotime($w->updated_at))}}</td>


    <td>
        <div class="dropright">

            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="menu-icon fas fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                
@if(auth()->user()->role->role_name == 'Admin Gudang')
                <a href="" class="dropdown-item" data-form="Edit Data" data-toggle="modal" data-target="#modalEdit{{$w->id}}">
                    Edit</a>
                <a class="delete-jquery dropdown-item" data-toggle="modal" style="cursor: pointer" data-target="#modalDelete{{$w->id}}">Delete</a>
                @endif
                <a class="dropdown-item " href="/stok/Management-Data/gudang/{{$w->id}}">Details</a>

                <!-- <a class="delete-jquery">Delete</a> -->
            </div>
        </div>
    <td>
        @php
        $action = '/stok/Management-Data/gudang/'.$w->id;

        @endphp
        <x-stock.master-data.modal-edit :action="$action" :id="$w->id">

            <x-slot name="content">
                @method('PUT')
                <label for="field1">Kode Gudang </label>
                <input class="form-control" value="{{$w->kode_gudang}}" type="text" name="kode_gudang" id="field1" required>
                <label for="field2">Alamat </label>
                <textarea class="form-control" type="textarea" name="alamat" id="field2" rows="5" required>{{$w->alamat}}</textarea>
                <label for="field3">No Telpon: </label>
                <input class="form-control" type="text" value="{{$w->no_telp}}" name="no_telp" required id="field3">
                <label for="field4">Status</label>
                <select class="form-control" name="status" id="field4" required>
                    <option value="aktif">Aktif</option>
                    <option value="tidak aktif">Tidak Aktif</option>
                </select>
            </x-slot>
        </x-stock.master-data.modal-edit>


    </td>

    <x-stock.modal-stock-delete :deleteAction="$action" :id="$w->id">
        <x-slot name="header">
            {{$w->kode_gudang}}
        </x-slot>

    </x-stock.modal-stock-delete>


<tr>




    @endforeach
    @endsection

    @section('modalId')
    modalGudang
    @endsection





    @section('modal-form')
    @parent
    @section('modal-content')

    @section('modal-form-action','/stok/Management-Data/gudang')
    @section('modal-form-method','POST')
    <label for="field1">Kode Gudang </label>

    <input class="form-control" type="text" name="kode_gudang" id="field1" required>
    <label for="field2">Alamat </label>
    <textarea class="form-control" type="textarea" name="alamat" id="field2" rows="5" required></textarea>
    <label for="field3">No Telpon: </label>
    <input class="form-control" type="text" name="no_telp" required id="field3">
    <label for="field4">Status</label>
    <select class="form-control" name="status" id="field4" required>
        <option value="aktif">Aktif</option>
        <option value="tidak aktif">Tidak Aktif</option>
    </select>
    @endsection

    @endsection

    @section('scripts')
    @parent
    <script>
        const title = "@yield('title')".toLowerCase().replace('data', '').trim();
        const idSidebarLink = `link-${title}`.trim();
        console.log(idSidebarLink);
        $('#link-dashboard').removeClass('active');
        $(`#link-manajemen-data`).addClass('active');
        $(`#${idSidebarLink}`).addClass('active')
    </script>

    @endsection