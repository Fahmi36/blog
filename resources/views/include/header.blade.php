<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pulsa</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/coming-sssoon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/responsive.bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/css/login.css')}}"><div class="flat-form">

    <!-- Styles -->
</head>
<body>

    @yield('content')

</body>
<script src="{{asset('/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/bootstrap-notify.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    <?php if(Session::has('message')){ ?>
        $.notify({
            icon: "<span class='glyphicon glyphicon-bell'></span>",
            message: "{{ Session::get('message') }}"

        }, {
            type: "{{ Session::get('status') }}",
            timer: 4000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    <?php } ?>
    $(document).ready(function() {
        $('#list-harga').DataTable();
    } );
</script>
</html>
