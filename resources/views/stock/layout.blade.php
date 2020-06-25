<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @section('css')
    <link rel="stylesheet" href="{{asset('css/stock/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('css/stock/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/stock/fontawesome-free-5.12.1-web/css/all.css')}}">

    @show
</head>

<body>
    @include('stock.partials.sidebar')

    <div class="main-content">
        <div class="main-container">
            @section('content')
            <div class="top-menu">

                <a href="#" onclick="toggleSidebar()"> <i class="fas fa-bars"></i></a>
                <h3 id="header"></h3>
                <div class="user-info">
                    <h3>Arya Gamas Mahardika <i class="fas fa-user"></i></h3>
                    <p>Operator Gudang</p>

                </div>
            </div>
        </div>
        @show

    </div>
</body>
@section('scripts')

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<script>
    var menuAktif = document.querySelector('title').innerHTML.trim();
    var allMenus = document.querySelectorAll('.sidebar ul li');
    
    allMenus.forEach(menu => {
        
        let namaMenu = menu.innerText
        var mgmtData= /data*/i;
        if (namaMenu == menuAktif) {
            menu.classList.toggle('active')
        }else if (mgmtData.test(menuAktif)){
            if(menu.innerText.trim() == "Manajemen Data"){
                menu.classList.toggle('active')

            }
        }
        $('#header').html(menuAktif)
    });



    function toggleSidebar() {
      
        $(".sidebar").toggleClass("collapsed");
        $(".content").toggleClass("collapsed");

    }
    function toggleDropdown() {
       if ($(".dropdown-laporan").is(':visible')){
            $(".dropdown-laporan").slideToggle();

        }  $(".dropdown-data").slideToggle();
       

    }
   
    function togglePenyesuaian() {
        if ($(".dropdown-laporan").is(':visible')){
            $(".dropdown-laporan").slideToggle();

        }
        $(".dropdown-penyesuaian").slideToggle();
        
    }
    function toggleLaporan() {
        if ($(".dropdown-data").is(':visible') ) {
            $(".dropdown-data").slideToggle();

        }
        if ( $(".dropdown-penyesuaian").is(':visible')) {
            $(".dropdown-penyesuaian").slideToggle();

            
        }


        $(".dropdown-laporan").slideToggle();
        
    }
    
</script>

@show

</html>