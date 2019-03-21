<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Pulsa</title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{asset('/css/material-dashboard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/demo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/jquery.toast.css')}}">
    <link rel="stylesheet" href="{{asset('/css/jquery-ui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/costum.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/morris.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <!-- Styles -->
</head> 
<body>
    <div class="wrapper">
        <div class="sidebar" data-color="green" data-image="{{asset('/images/sidebar-3.jpg')}}">
            <div class="logo">
                <a href="" class="simple-text">
                    Website pulsa
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                  <li class="nav-item active" id="dashboard">
                    <a class="nav-link" href="/dashboard">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item" id="deposit">
                    <a class="nav-link" href="javascript:void(0)" onclick="deposit()">
                        <i class="material-icons">add_circle</i> 
                        <p>Deposit</p>
                    </a>
                </li>
                <li class="nav-item" id="pulsa">
                    <a class="nav-link" href="javascript:void(0)" onclick="pulsa()">
                        <i class="material-icons">stay_primary_portrait</i> 
                        <p>Isi Pulsa</p>
                    </a>
                </li>
                <li class="nav-item" id="pln">
                    <a class="nav-link" href="javascript:void(0)" onclick="pln()">
                        <i class="material-icons">offline_bolt</i>
                        <p>Top Up Token PLN</p>
                    </a>
                </li>
                <li class="nav-item" id="transfer">
                    <a class="nav-link" href="javascript:void(0)" onclick="tranferpulsa()">
                        <i class="material-icons">compare_arrows</i>
                        <p>Paket Internet</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="#" data-toggle="collapse" data-target="#historyside" class="collapsed nav-link">
                        <i class="material-icons">history</i> 
                        <p>History <b class="caret pull-right"></b></p> 
                    </a>
                    <div class="collapse" id="historyside">
                        <ul class="nav nav-drop">
                            <li class="nav-item " id="historypulsa">
                                <a class="nav-link" href="javascript:void(0)" onclick="historypulsa()">
                                    <span class="sidebar-mini"> PP </span>
                                    <span class="sidebar-normal">Pembelian Pulsa</span>
                                </a>
                            </li>
                            <li class="nav-item " id="historypln">
                                <a class="nav-link" href="javascript:void(0)" onclick="historypln()">
                                    <span class="sidebar-mini"> PT </span>
                                    <span class="sidebar-normal">Pembelian Token PLN</span>
                                </a>
                            </li>                        
                        </ul>
                    </div>
                </li>
                <li class="nav-item ">
                    <a href="#" data-toggle="collapse" data-target="#listhargaside" class="collapsed nav-link">
                        <i class="material-icons">list</i> 
                        <p>List Harga <b class="caret pull-right"></b></p> 
                    </a>
                    <div class="collapse" id="listhargaside">
                        <ul class="nav nav-drop">
                            <li id="listharga">
                                <a class="nav-link" href="javascript:void(0)" onclick="listharga()">
                                    <span class="sidebar-mini"> <i class="material-icons">stay_primary_portrait</i>  </span>
                                    <span class="sidebar-normal">Harga Pulsa</span>
                                </a>
                            </li>
                            <li class="nav-item " id="listhargapln">
                                <a class="nav-link" href="javascript:void(0)" onclick="listhargapln()">
                                    <span class="sidebar-mini"> <i class="material-icons">offline_bolt</i> </span>
                                    <span class="sidebar-normal">Harga Token PLN</span>
                                </a>
                            </li> 
                            <li class="nav-item " id="listhargainet">
                                <a class="nav-link" href="javascript:void(0)" onclick="listhargainet()">
                                    <span class="sidebar-mini"> <i class="material-icons">compare_arrows</i> </span>
                                    <span class="sidebar-normal">Harga Data Internet</span>
                                </a>
                            </li>                       
                        </ul>
                    </div>
                </li>
                @if(Session::get('user')->role == 'admin')
                <li class="nav-item ">
                    <a href="#" data-toggle="collapse" data-target="#khusuadmin" class="collapsed nav-link">
                        <i class="material-icons">list</i> 
                        <p>Admin <b class="caret pull-right"></b></p> 
                    </a>
                    <div class="collapse" id="khusuadmin">
                        <ul class="nav nav-drop">
                            <li id="gantihargapulsa">
                                <a class="nav-link" href="javascript:void(0)" onclick="hargapulsa()">
                                    <span class="sidebar-mini"> <i class="material-icons">stay_primary_portrait</i>  </span>
                                    <span class="sidebar-normal">Harga Pulsa Asli</span>
                                </a>
                            </li>
                            <li id="gantihargapulsa">
                                <a class="nav-link" href="javascript:void(0)" onclick="gantihargapulsa()">
                                    <span class="sidebar-mini"> <i class="material-icons">stay_primary_portrait</i>  </span>
                                    <span class="sidebar-normal">Ganti Harga Pulsa</span>
                                </a>
                            </li>
                            <li class="nav-item " id="gantihargapln">
                                <a class="nav-link" href="javascript:void(0)" onclick="gantihargapln()">
                                    <span class="sidebar-mini"> <i class="material-icons">offline_bolt</i> </span>
                                    <span class="sidebar-normal">Ganti Harga PLN</span>
                                </a>
                            </li> 
                            <li class="nav-item " id="cekkonfirmasi">
                                <a class="nav-link" href="javascript:void(0)" onclick="cekkonfirmasi()">
                                    <span class="sidebar-mini"> <i class="material-icons">compare_arrows</i> </span>
                                    <span class="sidebar-normal">Cek Pembayaran</span>
                                </a>
                            </li>
                            <li class="nav-item " id="tambah_pembayaran">
                                <a class="nav-link" href="javascript:void(0)" onclick="tambah_pembayaran()">
                                    <span class="sidebar-mini"> <i class="material-icons">compare_arrows</i> </span>
                                    <span class="sidebar-normal">Tambah Pembayaran bank</span>
                                </a>
                            </li>                        
                        </ul>
                    </div>
                </li>
                @endif
                <li class="nav-item " id="setting">
                    <a class="nav-link" href="javascript:void(0)" onclick="setting()">
                        <i class="material-icons">settings</i> 
                        <p>Edit Profile</p> 
                    </a>
                </li>
                <li class="nav-item " >
                    <a class="nav-link" href="/logout">
                        <i class="material-icons">power_settings_new</i>
                        <p>Keluar</p>
                    </a>
                </li>
          <!-- <li class="nav-item active-pro ">
                <a class="nav-link" href="./upgrade.html">
                    <i class="material-icons">unarchive</i>
                    <p>Upgrade to PRO</p>
                </a>
            </li> -->
        </ul>
    </div>
</div>
<div class="main-panel">
 <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
          <ul class="navbar-nav">
<!--             <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Mike John responded to your email</a>
              <a class="dropdown-item" href="#">You have 5 new tasks</a>
              <a class="dropdown-item" href="#">You're now friend with Andrew</a>
              <a class="dropdown-item" href="#">Another Notification</a>
              <a class="dropdown-item" href="#">Another One</a>
          </div>
      </li> -->
  </ul>
</div>
</div>
</nav>
<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <div class="windows8">
        <div class="wBall" id="wBall_1">
          <div class="wInnerBall"></div>
      </div>
      <div class="wBall" id="wBall_2">
          <div class="wInnerBall"></div>
      </div>
      <div class="wBall" id="wBall_3">
          <div class="wInnerBall"></div>
      </div>
      <div class="wBall" id="wBall_4">
          <div class="wInnerBall"></div>
      </div>
      <div class="wBall" id="wBall_5">
          <div class="wInnerBall"></div>
      </div>
  </div>
</div>
</div>

<div id="content" class="content">
   <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_balance_wallet</i>
            </div>
            <p class="card-category">Saldo Anda</p>
            @foreach($data as $saldo)
            <h3 class="card-title"><?php echo "Rp " . number_format($saldo->saldo,2,',','.'); ?>
            @endforeach
        </h3>
    </div>
    <div class="card-footer">
      <div class="stats">
        <i class="material-icons text-danger">warning</i>
        <a href="javascript:void(0);" onclick="deposit()">Tambah Saldo</a>
    </div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
    <div class="card-header card-header-success card-header-icon">
      <div class="card-icon">
        <i class="material-icons">store</i>
    </div>
    <p class="card-category">Data Pembelian</p>
    <h3 class="card-title"><?php echo count($pembelian) ?></h3>
</div>
<div class="card-footer">
  <div class="stats">
    <i class="material-icons">date_range</i> Last 24 Hours
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
    <div class="card-header card-header-danger card-header-icon">
      <div class="card-icon">
        <i class="material-icons">info_outline</i>
    </div>
    <p class="card-category">Deposit Pending</p>
    <h3 class="card-title"><?= count($pending) ?></h3>
</div>
<div class="card-footer">
  <div class="stats">
    <i class="material-icons">local_offer</i> Daftar Deposit
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
    <div class="card-header card-header-info card-header-icon">
      <div class="card-icon">
        <i class="material-icons">person</i>
    </div>
    <p class="card-category">Jumlah User</p>
    <h3 class="card-title"><?= count($person)?></h3>
</div>
<div class="card-footer">
  <div class="stats">
    <i class="material-icons">update</i> Just Updated
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="card card-chart" id="morris-line-chart">
        <div class="card-header card-header">
        </div>
        <div class="card-body">
          <h4 class="card-title">Grafik Pembelian </h4>
          <div id="morris-line" class="graph"></div>
                      <!-- <p class="card-category">
                        <span class="text-success"><i class="material-icons">
arrow_upward
</i> 55% </span> increase in today sales.</p>
                      </div>
                      <div class="card-footer">
                        <div class="stats">
                          <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                    </div> -->
                </div>
            </div>

        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="{{asset('/js/jq.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{asset('/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/bootstrap-material-design.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/perfect-scrollbar.jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/raphael-min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/morris.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/bootstrap-notify.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/material-dashboard.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/demo.js')}}"></script>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script src="{{asset('/js/jquery-ui.js')}}"></script>
<script src="{{asset('/js/costum.js')}}"></script>
<script type="text/javascript">
    $(function() {
        <?php if(Session::has('message')){ ?>
            $.notify({
                icon: "notifications",
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
    // data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type
    var tax_data = [
    <?php foreach ($grafik as $datanya) { ?>
        {
            "period": "<?=$datanya->DayDate?>",
            "Pembelian": <?=$datanya->credits?>
            
        },
        <?php } ?>];
    // Line Chart
    Morris.Line({
        element: 'morris-line',
        data: tax_data,
        xkey: 'period',
        ykeys: ['Pembelian', 'sorned'],
        labels: ['Pembelian', '']
    });
});
    $(document).ready(function() {
        $(".fancybox-button").fancybox({
            helpers     : {
                title   : { type : 'inside' },
                buttons : {},
                overlay : {
                    css : {
                        'background' : 'rgba(0, 0, 0, 0.85)'
                    }
                }
            }
        });
    });

</script>
</html>
