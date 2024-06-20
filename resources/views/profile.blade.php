
    @extends('layouts.app')
    @section('content')

    <!-- This is Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <h2><a class="navbar-brand p-2 " href="#">🎂 BirthDay-Reminder</a></h2>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link" href="{{route("home")}}">Home </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{route("profile")}}">Profile</a>
        </li>
        </ul>
        
    </div>
    <h6 class="mt-2">{{auth()->user()->name}}&nbsp;&nbsp;</h6>
    <button class="btn btn-outline-success my-2 my-sm-0 "><a href="{{route("logout")}}" class="text-danger">Logout</a></button>&nbsp;&nbsp;
    </nav><br><br><br><br>

    <!-- This is to handle messages sent through session -->
    @if(session()->has('success'))
        <h5 class="popup-container2">{{ session('success') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;👍</h5>
    @endif
    @if(session()->has('error'))
        <h5 class="popup-container2">{{ session('error') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
    @endif

    <!-- This is section to display profile information -->
    <div class="page-content page-container " id="page-content" style="width:100%">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-8 col-md-12 mx-auto">
                    <div class="card user-card-full" style="height: 500px;">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile" style="height: 500px;">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                        <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius"
                                            alt="User-Profile-Image">
                                    </div>
                                    <h3 class="f-w-600">{{ auth()->user()->name }}</h3>
                                    <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h2 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h2>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Name</p>
                                            <h6 class="text-muted f-w-400">
                                                {{ auth()->user()->name }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400">
                                                {{ auth()->user()->email }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Phone</p>
                                            <h6 class="text-muted f-w-400">
                                                {{ auth()->user()->phone_no }}</h6>
                                        </div>
                                    </div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Notification frequency</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Days prior</p>
                                            <h6 class="text-muted f-w-400">1</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <button class="btn btn-success mt-5" onclick="openform()">Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popup-container3" id="registrationForm">
                                <form id="" action="{{ route('profile.post') }}" method="POST"
                                    class="mx-auto">
                                    @csrf
                                    <div class="form-group"><br><br>
                                        <label for="name">
                                            Name
                                        </label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                                            value="{{auth()->user()->name}}"  />
                                        @if($errors->has('name'))
                                            <span
                                                class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email">
                                            Email
                                        </label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Email"
                                            value="{{auth()->user()->email}}" />
                                        @if($errors->has('email'))
                                            <span
                                                class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="number">
                                            Notification frequency
                                        </label>
                                        <input type="number" name="frequency" class="form-control" id="frequency" />
                                    </div>
                                    <div class="form-group">
                                        <label for="Phone">
                                            Phone
                                        </label>
                                        <input type="phone" name="phone_no" class="form-control" id="phone"
                                        value="{{auth()->user()->phone_no}}" placeholder="Phone"  />
                                        @if($errors->has('phone_no'))
                                            <span
                                                class="text-danger">{{ $errors->first('phone_no') }}</span>
                                        @endif
                                    </div>
                                    <button class="btn btn-primary" type="submit">
                                        Save
                                    </button>
                                    <button class="btn btn-danger" onclick="openform()" >
                                        Cancel
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //popup functionality
        openform();
        function openform() {
            var form = document.getElementById("registrationForm");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
        if ("{{ $errors->has('name') }}" || "{{ $errors->has('email') }}" ||
            "{{ $errors->has('phone_no') }}") {
            openform();
        }

    </script>
    @endsection
