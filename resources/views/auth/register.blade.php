@extends('master')
@section('title', 'Registration Page')

@section('content')
    <div class="container-fluid bg-success p-5"" id="login" >

        <h1 class=" text-center mb-3">তারক ভান্ডার</h1>
        <section class="login col-md-6 offset-md-3">
            <div class="jumbotron">
                @if (session('error'))
                <div class="alert alert-success">
                    {{ session('error') }}
                </div>
            @endif
                <h3 class="text-center font-weight-bold">এডমিন রেজিস্ট্রেশন করুন</h3>
                <form action="{{ route('employee.registration') }}" method="POST">
                    @csrf
                    <div class="form-group col-md-11"> 
                        <label for="emial">নাম</label>
                        <input type="username" class="form-control engFont" name="username"  value="{{ old('username') }}"  placeholder="নাম প্রবেশ করুন" >
                        <p class="text-danger engFont" >@error('username'){{ $message }} @enderror</p>
                    </div>
                    <div class="form-group col-md-11">
                        <label for="emial">ইমেইল</label>
                        <input type="email" class="form-control engFont" id="email" name="email"  value="{{ old('email') }}"  placeholder="ইমেইল প্রবেশ করুন" >
                        <p class="text-danger engFont" >@error('email'){{ $message }} @enderror</p>
                    </div>
                    <div class="form-group col-md-11">
                        <label for="password">পাসওয়ার্ড(ইংরেজিতে)</label>
                        <input type="password" class="form-control engFont" id="password" name="password" placeholder="পাসওয়ার্ড প্রবেশ করুন">
                        <p class="text-danger engFont">@error('password'){{ $message }} @enderror</p>
                    </div>
                    <button type="submit" class="btn btn-primary  ml-3 mt-2">রেজিস্টার</button>
                </form>
                <a class="d-block pt-3 ml-3 font-weight-bold text-muted" href="{{route('login')}}">আমার আগের একাউন্ট আছে</a>
            </div>
        </section>
 
    </div>

@endsection