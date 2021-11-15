@extends('master')
@section('title', 'Registration Page')

@section('content')
    <div class="container-fluid bg-success p-5"" id="login">

        <h1 class=" text-center mb-3">বণিক সুপার সপ</h1>
        <section class="login col-md-6 offset-md-3">
            <div class="jumbotron">
                <h3 class="text-center font-weight-bold">Registration</h3>
                <form>
                    <div class="form-group col-md-11">
                        <label for="emial">Username</label>
                        <input type="username" class="form-control" id="email"  placeholder="Enter your username">
                        <p class="text-danger">username Error has been show</p>
                    </div>
                    <div class="form-group col-md-11">
                        <label for="emial">Email</label>
                        <input type="email" class="form-control" id="email"  placeholder="Enter your email">
                        <p class="text-danger">Email Error has been show</p>
                    </div>
                    <div class="form-group col-md-11">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password">
                        <p class="text-danger">Password Error has been show</p>
                    </div>
                    <button type="submit" class="btn btn-primary  ml-3 mt-2">Register</button>
                </form>
                <a class="d-block pt-3 ml-3 font-weight-bold text-muted" href="{{route('login')}}">I have account already</a>
            </div>
        </section>

    </div>

@endsection