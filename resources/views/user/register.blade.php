@extends('user.master')
@section('title', 'Registration Page')

@section('content')
    <div class="bg-success vh-100">
        <div class="container">
            <div class="row vh-100 d-flex justify-content-center align-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                User Registration
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.register') }}" method="POST">
                                @csrf
                                @if (Session::get('error'))
                                    <div class="alert alert-success">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                                <div class="form-group"> 
                                    <label for="username">User Name</label>
                                    <input type="text" id ="username"class="form-control " name="username"  value="{{ old('username') }}"  >
                                    <p class="text-danger " >@error('username'){{ $message }} @enderror</p>
                                </div>
                                <div class="form-group ">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control engFont" id="email" name="email"  value="{{ old('email') }}" >
                                    <p class="text-danger engFont" >@error('email'){{ $message }} @enderror</p>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <p class="text-danger engFont">@error('password'){{ $message }} @enderror</p>
                                </div>
                                <div class="registration">
                                    <button type="submit" class="btn btn-primary">Registration</button>
                                </div>
                                <div class="form-group">
                                    <a class="d-block  text-muted" href="{{route('user.login')}}">I have already Account</a>
                                </div>
                                
                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
@endsection