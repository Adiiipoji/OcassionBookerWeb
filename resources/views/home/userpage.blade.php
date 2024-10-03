<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="" type="">

  <title> Eventrix </title>

  <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <link href="home/css/font-awesome.min.css" rel="stylesheet" />
  <link href="home/css/style.css" rel="stylesheet" />
  <link href="home/css/responsive.css" rel="stylesheet" />

</head>

<body>

  <div class="hero_area">
    <div class="bg-box">
      <img src="home/images/ggs.jpg" alt="">
    </div>
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <img src="logo/logo2.png" width="250px">

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item active">
                <a class="nav-link" href="index.html">Home<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#occasion">Event</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#book">Book</a>
              </li>
              <form class="form-inline">
              </form>
              @if (Route::has('login'))
              @auth
              <li class="nav-item">
              <x-app-layout>
              </x-app-layout>
              </li>
              @else
              <li class="nav-item">
                <a class="btn btn-primary" id="logincss" href="{{ route('login') }}" style="background-color: #008000; border-color: #008000">Log In</a>
              </li>
              <li class="nav-item">
                <a class="btn btn-success" href="{{ route('register') }} " style="background-color: #008000; border-color: #008000">Register</a>
                @endauth
                @endif
              </li>
            </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
  </div>

  <section class="food_section layout_padding-bottom" id="occasion">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Event
        </h2>
      </div>

        <div class="row">
    @foreach($events as $event)
    <div class="col-sm-6 col-lg-4">
        <div class="box">
            <div>
                <div class="img-box">
                    <img src="event_img/{{$event->image}}" alt="">
                </div>
                <div class="detail-box">
                    <h5>{{$event->event_title}}</h5>
                    <p>{{$event->description}}</p>
                    <div class="options">
                        <h6>{{$event->price}}</h6>
                        <a class="btn btn-primary" href="{{url('event_details', $event->id)}}" style="background-color: #008000; border-color: #008000">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
    </div>
</section>

<section class="about_section layout_padding" id="about">
    <div class="container">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/logo.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                We Are Eventrix
              </h2>
            </div>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in some form, by injected humour, or randomised words which don't look even slightly believable. If you
              are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
              the middle of text. All
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>


<section class="book_section layout_padding" id="book">
    <div class="container">
        <div class="heading_container">
            <h1 style="font-size: 40px !important">Reserve Event</h1>

            <div>
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
            </div>
            @if($errors)
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            @endif

            <form action="{{url('addreservation')}}" method="POST">
                @csrf
                <div>
                    <label>Name</label>
                    <input type="text" name="name" @if(Auth::id()) value="{{Auth::user()->name}}" @endif >
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="email" @if(Auth::id()) value="{{Auth::user()->email}}" @endif >
                </div>
                <div>
                    <label>Phone</label>
                    <input type="number" name="phone" @if(Auth::id()) value="{{Auth::user()->phone}}" @endif>
                </div>
                <div>
                    <label>Start Date</label>
                    <input type="date" name="startDate" required>
                </div>
                <div>
                    <label>End Date</label>
                    <input type="date" name="endDate" required>
                </div>
                <div style="padding-top: 20px">
                    <input type="submit" class="btn btn-primary" style="background-color: #008000; border-color: #008000" value="Book Event">
                </div>
            </form>
        </div>
    </div>
</section>

<footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>
              Contact Us
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Arellano Street, Dagupan City, Pangasinan
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call #09632854430
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  occasionbooker@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="" class="footer-logo">
              Eventrix
            </a>
            <p>
              Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with
            </p>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>
            Opening Hours
          </h4>
          <p>
            Everyday
          </p>
          <p>
            10.00 Am -10.00 Pm
          </p>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By Eventrix
        </p>
      </div>
    </div>
  </footer>


<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>

</body>

</html>