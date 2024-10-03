<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="home/css/bootstrap.css">
    <link rel="stylesheet" href="home/css/style.css">
    <title>Occasion Booker - View Reservation</title>
</head>

<body>

    <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container">
                <img src="logo/logo1.png" width="250px">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#occasion">Event</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#book">Book</a></li>
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item"><x-app-layout></x-app-layout></li>
                            @else
                                <li class="nav-item"><a class="btn btn-primary" href="{{ route('login') }}">Log In</a></li>
                                <li class="nav-item"><a class="btn btn-success" href="{{ route('register') }}">Register</a></li>
                            @endauth
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <section class="food_section layout_padding-bottom" id="occasion">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Our Events</h2>
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
                                    <a class="btn btn-primary" href="#book" data-event-id="{{$event->id}}" data-event-title="{{$event->event_title}}" style="background-color: #008000; border-color: #008000" onclick="openReservationForm(this)">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="book_section layout_padding" id="book">
        <div class="container">
            <div class="heading_container">
                <h1>Reserve Event</h1>
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form id="reservationForm" action="{{ url('addreservation') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_id" id="event_id">
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" @if(Auth::check()) value="{{ Auth::user()->name }}" @endif>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" @if(Auth::check()) value="{{ Auth::user()->email }}" @endif>
                    </div>
                    <div>
                        <label>Phone</label>
                        <input type="number" name="phone" @if(Auth::check()) value="{{ Auth::user()->phone }}" @endif>
                    </div>
                    <div>
                        <label>Start Date</label>
                        <input type="date" name="startDate" id="startDate" required>
                    </div>
                    <div>
                        <label>End Date</label>
                        <input type="date" name="endDate" id="endDate" required>
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
            <div class="footer-info">
                <p>&copy; <span id="displayYear"></span> All Rights Reserved By Occasion Booker</p>
            </div>
        </div>
    </footer>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        function openReservationForm(button) {
            const eventId = button.getAttribute('data-event-id');
            const eventTitle = button.getAttribute('data-event-title');
            document.getElementById('event_id').value = eventId;
            document.getElementById('reservationForm').scrollIntoView({ behavior: 'smooth' });
        }
    </script>

</body>

</html>