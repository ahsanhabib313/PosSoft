@extends('master')
@section('title', 'Login Page')

@section('content')
    <div class="container-fluid bg-success p-5"" id="login">

        <h1 class=" text-center mb-3">বণিক সুপার সপ</h1>
        <section class="login col-md-6 offset-md-3">
            <div class="jumbotron">
                <h3 class="text-center font-weight-bold">Login</h3>
                <form>
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

                    <div class="form-check  ml-3">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label mr-5" for="rememberMe">Remember Password</label>

                    </div>

                    <button type="submit" class="btn btn-primary  ml-3 mt-2">Login</button>
                </form> 
                <a class="d-block pt-3 ml-3 font-weight-bold text-muted" href="#">Forget Password</a>
                <a class="d-block pt-3 ml-3 font-weight-bold text-muted" href="{{route('register')}}">Registration</a>
            </div>
        </section>

    </div>

@endsection