@extends('layout')
@section('css')
@parent
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
@section('title')
Konfigurasi
@endsection
@section('content')
@parent
<div class="form-group">
    <div class="roles">
        <label for="user-role">Role User</label>
        <select class="form-control" name="user_role" id="role">
            <option selected>--Pilih Role User--</option>
         @foreach ($roles as $role)
        <option value="{{$role->id}}">{{$role->name}}</option>
         @endforeach
        </select>

        <form method=post action='/rolebaru' style='display:block' id=rolebaru>
        @csrf
            <button id='submitnewroles' type=submit>Submit</button>
        </form>
        <button type="button" id="addrole">Tambah Role</button>
        <h3 style="color:white">Permissions</h3>
    </div>
    <form action="/updatepermissions" method="post" style="display:block">
        @csrf
        <div class="permissions">
            @foreach ($permission as $p)
            <input style="display:inline" type="checkbox" value="{{$p->id}}" name="permissions[]"
                id="permission{{$p->id}}">
            <label for="permission{{$p->id}}">{{$p->name}}</label>

            @endforeach
        </div>
        <button type="submit">
            Update
        </button>
    </form>
</div>
@endsection
@section('scripts')
@parent

<script>
    $(document).ready(function () {
        var i = 0
        $('#rolebaru').hide();
        $('#addrole').click(function (params) {
            $('#rolebaru').show();

            $('form button').before("<label for='rolename"+i+"'>Nama Role Baru :</label><input type='text' name='name[]' id='rolename"+i+"' placeholder='Manager'>")
            i++

        })
        
     
        $('select').change(function () {
        
        $roleId = $(this).val();
        url = '/config/getrolepermissions/' + $roleId;
        $.get(url,function(data) {
            $(".permissions input").prop("checked",false);
               
            $.each(data,function (key,val) {
                 $(".permissions input").each(function(){
                  
                    if (val.id == $(this).val()) {
                        $(this).prop("checked",true);
                    }
                })
            })
        }

        )
    })
  
  
});
</script>
@endsection