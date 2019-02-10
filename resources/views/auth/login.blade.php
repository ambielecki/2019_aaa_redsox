@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Login</span>
                        <div class="row">
                            <form class="col s12" action="{{ route('login') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="email" name="email" type="text">
                                        <label for="email">Email</label>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" name="password" type="password" class="validate">
                                        <label for="password">Password</label>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s12">
                                        <label>
                                            <input type="checkbox" name="remember">
                                            <span>Remember Me</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s12">
                                        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="card-action">
                        <a href="#">Forgot Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
