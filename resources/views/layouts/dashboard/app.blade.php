<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description"
          content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">

    <title>Vali Admin - Free Bootstrap 4 Admin Template</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard_files/css/main.css')}}">

    <!-- jquery-3.3.1 -->
    <script src="{{asset('dashboard_files/js/jquery-3.3.1.min.js')}}"></script>

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!--Noty -->
    <link rel="stylesheet" href="{{asset('dashboard_files/plugins/noty/noty.css')}}">
    <script src="{{asset('dashboard_files/plugins/noty/noty.min.js')}}"></script>

    @stack('styles')

</head>
<body class="app sidebar-mini">
<!-- Navbar-->
@include('layouts.dashboard._header')
<!-- Sidebar menu-->
@include('layouts.dashboard._aside')
<main class="app-content">

    @yield('content')

    @include('partials._session')

</main>

<!-- Essential javascripts for application to work-->

<script src="{{asset('dashboard_files/js/popper.min.js')}}"></script>
<script src="{{asset('dashboard_files/js/bootstrap.min.js')}}"></script>
{{--<script src="{{asset('dashboard_files/plugins/select2/select2.min.js')}}"></script>--}}
<script src="{{asset('dashboard_files/js/plugins/select2.min.js')}}"></script>

<script src="{{asset('dashboard_files/js/main.js')}}"></script>

<script src="{{asset('dashboard_files/js/custom/movie.js')}}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        let switchery = new Switchery(html, {
            size: 'small',
            color: '#64bd63',
            secondaryColor: '#e9302d',
            jackColor: '#fff',
            jackSecondaryColor: '#fff'
        });
    });

    $(document).ready(function () {
        $('.tasks-switch').change(function () {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let task_id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('tasks.changeStatus') }}',
                data: {'status': status, 'task_id': task_id},
                success: function (data) {
                    //  console.log(data.success)
                    getData();
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.success);
                }
            });
        });
    });
function getData(){
    $.ajax({
        type: 'GET', //THIS NEEDS TO BE GET
        url: '{{ route('tasks.getData') }}',
       // dataType: 'json',
        success: function (data) {
           // console.log(data);
           $('.tbody').html(data);

        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function (html) {
            let switchery = new Switchery(html, {
                size: 'small',
                color: '#64bd63',
                secondaryColor: '#e9302d',
                jackColor: '#fff',
                jackSecondaryColor: '#fff'
            });
        });

        },error:function(){
             console.log(data);
        }
    });
}
0

</script>
</body>
</html>
