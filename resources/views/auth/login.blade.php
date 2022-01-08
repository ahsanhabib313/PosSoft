@extends('master')
@section('title', 'Login Page')

@section('content')
    <div class="container-fluid bg-success p-5"" id="login">

        <h1 class=" text-center mb-3">তারক ভান্ডার</h1> 
        <section class="login col-md-6 offset-md-3">
            <div class="jumbotron">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <h3 class="text-center font-weight-bold">লগইন করুন</h3>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group col-md-11">
                        <label for="emial" class="font-weight-bold">ইমেইল</label>
                        <input type="email" class="form-control engFont" id="email" name="email"  placeholder="ইমেইল প্রবেশ করুন" value="{{ old('email') }}">
                        <p class="text-danger engFont">@error('email'){{ $message }} @enderror</p>
                    </div>
                    <div class="form-group col-md-11">
                        <label for="password" class="font-weight-bold">পাসওয়ার্ড</label>
                        <input type="password" class="form-control engFont" id="password" name="password" placeholder="পাসওয়ার্ড প্রবেশ করুন">
                        <p class="text-danger engFont">@error('email'){{ $message }} @enderror</p>
                    </div>

                    <div class="form-check  ml-3">
                        <input type="checkbox"   name="rememberMe" class="form-check-input" id="rememberMe">
                        <label class="form-check-label mr-5" for="rememberMe"class="font-weight-bold">পাসওয়ার্ড সেভ করুন</label>
                    </div> 

                    <button type="submit" class="btn btn-primary  ml-3 mt-2">লগইন</button>
                </form> 
             
            </div>
        </section>

    </div>

@endsection