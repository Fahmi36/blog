@extends('include.header')
@section('content')
<nav class="navbar navbar-transparent navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="{{url('login')}}">
                    <i class="fa fa-facebook-square"></i>
                    Login
                </a>
            </li>
             <li>
                <a href="{{url('register')}}">
                    <i class="fa fa-twitter"></i>
                    Register
                </a>
            </li>
            <!--  <li>
                <a href="{{url('list-harga')}}">
                    <i class="fa fa-envelope-o"></i>
                   Daftar Harga
                </a>
            </li> -->
       </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>
<div class="main" style="background-image: url('images/default.jpg')">

<!--    Change the image source '/images/default.jpg' with your favourite image.     -->

    <div class="cover black" data-color="black"></div>

<!--   You can change the black color for the filter with those colors: blue, green, red, orange       -->

    <div class="container">
        <h1 class="logo cursive">
            Beli Pulsa
        </h1>
<!--  H1 can have 2 designs: "logo" and "logo cursive"           -->

        <div class="content">
            <h4 class="motto">Website Pulsa Termurah, Pembayaran via bank di indonesia</h4>
            <div class="subscribe">
                <h5 class="info-text">
                    Register sekarang banyak untungnya
                </h5>
            </div>
        </div>
    </div>
    <div class="footer">

    </div>
 </div>

@endsection
