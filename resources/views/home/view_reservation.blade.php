<!DOCTYPE html>
<html>
<head>
    <base href="/public">
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="" type="">

  <title> Occasion Booker </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="home/css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="home/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="home/css/responsive.css" rel="stylesheet" />

</head>

<body>


    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            <span>
              Occasion Booker
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item active">
                <a class="nav-link" href="{{url('/')}}">Home<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}">Event</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}">Book</a>
              </li>
              <form class="form-inline">
                <!-- <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button> -->
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
                <a class="btn btn-success" href="{{ route('register') }}" style="background-color: #008000; border-color: #008000">Register</a>
                @endauth
                @endif
              </li>
            </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
  
    <!-- end slider section -->
  </div>

<section class="food_section layout_padding-bottom" id="occasion">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Event
        </h2>
      </div>

      <ul class="filters_menu">
        <!-- <li class="active" data-filter="*">All</li>
        <li data-filter=".burger">Birthday Party</li>
        <li data-filter=".pizza">Wedding</li>
        <li data-filter=".pasta">Christening</li>
        <li data-filter=".fries">Thanksgiving</li> -->
      </ul>

        <div class="row">
          <div class="col-sm-6 col-lg-4">
              <div>
                <div>
                  <img src="event_img/{{$event->image}}" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                  {{$event->event_title}}
                  </h5>
                  <p>
                  {{$event->description}}
                  </p>
                  <div class="options">
                    <h6>
                      {{$event->price}}
                    </h6>
                  </div>
                </div>
              </div>
              </div>
          </div>

          <div class="col-md-4">

                    <h1 style="font-size: 40px !important" >Reserve Event</h1>

                    <div>

                    @if(session()->has('message'))
                    <div class="alert alert-success" >
                    <button type="button" class="close" data-bs-dismiss="alert" >X</button>
                    {{session()->get('message')}}
                    </div>
                    @endif

                    </div>
                    @if($errors)

                    @foreach($errors->all() as $errors)

                    <li>
                        {{$errors}}
                    </li>
                    @endforeach
                    @endif

                    <form action="{{url('addreservation', $event->id)}}" method="Post" >

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
                        <input type="date" name="startDate" id="startDate" >
                    </div>
                    <div>
                        <label>End Date</label>
                        <input type="date" name="endDate" id="endDate" >
                    </div>
                    <div style="padding-top: 20px" >
                        <input type="submit" class="btn btn-primary" value="Book Event">
                    </div>
                    </form>
                </div>


            </div>

          
  </section>