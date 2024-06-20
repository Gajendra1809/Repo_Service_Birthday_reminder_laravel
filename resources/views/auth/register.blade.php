    @extends('layouts.app')

    @section('content')
    <h1 class="text-success text-center">
        Birthday Reminder
    </h1>
    <h5 class="text-center">Create an account and never forget to wish your loved one's...</h5>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    <div class="card-body">
                        <div>
                            @if(session()->has('success'))
                                <h3 class="text-success ">{{ session('success') }}</h3>
                            @endif
                            @if(session()->has('error'))
                                <h5 class="text-danger ">{{ session('error') }}</h5>
                            @endif
                        </div>
                        <form id="registrationForm" action="{{ route("register.post") }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">
                                    Name
                                </label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                                    value="{{old('name')}}" />
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                                    value="{{old('email')}}" />
                                @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">
                                    Password
                                </label>
                                <input type="password" name="password" class="form-control" id="password"
                                    value="{{old('password')}}" placeholder="Password"  />
                                @if($errors->has('password'))
                                    <span
                                        class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="Phone">
                                    Phone
                                </label>
                                <input type="text" name="phone_no" class="form-control" id="phone" placeholder="Phone"
                                    value="{{old('phone_no')}}" />
                                    @if($errors->has('phone_no'))
                                    <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                                @endif
                            </div>
                            <button class="btn btn-danger" type="submit">
                                Register
                            </button>
                        </form>
                        <p class="mt-3">
                            Alredy have an Account?
                            <a href="/">Login here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
