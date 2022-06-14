@extends('user.master')
@section('title', 'Admin Login')


@section('content')
<div id="main-wrapper " class="bg-success vh-100">
    <div class="container">
        <div class="row justify-content-center align-content-center vh-100">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="header-title">Admin LogIn</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.login.check') }}" method="POST">
                            @csrf
                            @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                            @if (Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                            @endif
                            <div class="form-group ">
                                <label for="emial" class="">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                <p class="text-danger engFont">@error('email'){{ $message }} @enderror</p>
                            </div>
                            <div class="form-group ">
                                <label for="password" class="">Password</label>
                                <input type="password" class="form-control " id="password" name="password">
                                <p class="text-danger engFont">@error('email'){{ $message }} @enderror</p>
                            </div>
        
                            <div class="form-check mb-2">
                                <input type="checkbox"   name="rememberMe" class="form-check-input" id="rememberMe">
                                <label class="form-check-label mr-5" for="rememberMe"class="font-weight-bold">Remember Password</label>
                            </div> 
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary  ">Submit</button>
                            </div>
                            <div class="form-group">
                                <a class="d-block text-muted" href="{{route('admin.register')}}">Create a new Account</a>
                            </div>
                           
                        </form> 
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   

@endsection