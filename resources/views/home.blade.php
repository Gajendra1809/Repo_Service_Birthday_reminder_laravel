    @extends('layouts.app')
    @section('content')
    
    <!-- This is Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <h2><a class="navbar-brand p-2 " href="#">🎂 BirthDay-Reminder</a></h2>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route("home") }}">Home </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route("profile") }}">Profile</a>
                </li>
                <li class="nav-item">
                    <button onclick="openform()" class="btn btn-outline-success my-2 my-sm-0">Add
                        Birthday!</button>&nbsp;&nbsp;
                </li>
            </ul>

        </div>
        <h6 class="mt-2">{{ auth()->user()->name }}&nbsp;&nbsp;</h6>
        <button class="btn btn-outline-success my-2 my-sm-0 "><a href="{{ route("logout") }}"
                class="text-danger">Logout</a></button>&nbsp;&nbsp;
    </nav><br><br><br><br>




    <!-- This is to handle messages sent through session -->
    @if(session()->has('success'))
        <h5 class="popup-container2">
            {{ session('success') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;👍</h5>
    @endif
    @if(session()->has('error'))
        <h5 class="popup-container2">
            {{ session('error') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
    @endif
    @if($errors->has('phone'))
    <h5 class="popup-container2">Wrong phone formate&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
    @endif

    <!-- Popup form to add birthdays -->
    <div class="popup-container" id="birthdayForm">
        <form class="popup-form" action="{{ route("date.post") }}" method="POST">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{old('name')}}">
            @if($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span><br>
            @endif
            <label for="date">Date:</label>
            <input type="date" id="birthdate" name="birthdate" value="{{old('birthdate')}}">
            @if($errors->has('birthdate'))
                <span class="text-danger">{{ $errors->first('birthdate') }}</span><br>
            @endif
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone_no" value="{{old('phone_no')}}">
            @if($errors->has('phone_no'))
                <span class="text-danger">{{ $errors->first('phone_no') }}</span><br>
            @endif
            <div style="display:flex;gap: 3px">
                <button type="submit" style="background-color: green;">Submit</button>
                <button type="button" onclick="openform()" style="background-color: red;">Cancel</button>
            </div>
        </form>
    </div>


    <!-- List section for showing upcoming Birthdays of the year -->
    <div class="container">
        <h2>Upcoming Birthdays</h2>
        @if($birthday->isEmpty())
            <br>
            <p>No upcoming birthdays found!</p>
        @else
            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date of Birth</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($birthday as $bday)
                        <tr>
                            <td>{{ $bday->name }}</td>
                            <td>{{ date('jS F',strtotime($bday->birthdate)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <div>
            {{ $birthday->links('pagination::bootstrap-5') }}
        </div>
    </div><br><br>


    <!-- List section for showing all birthdates added -->
    <div class="container">
        {!! $dataTable->table(['class' => 'table table-bordered']) !!}
    </div>

    <script>

        //Pop form to add bithday
        openform();
        function openform() {
            var form = document.getElementById("birthdayForm");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }

        if ("{{ $errors->has('name') }}" || "{{ $errors->has('date') }}" ||
            "{{ $errors->has('phone_no') }}") {
            //console.log(localStorage.getItem('id'));
            openform();
        }     

    </script>
    @endsection

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush