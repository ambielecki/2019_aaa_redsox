@extends('layouts.main')

@section('title')
    Log In - {{ config('app.name') }}
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Login</span>
                    <div class="row">
                        <form class="col s12" action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="email" name="email" type="text">
                                    <label for="email">Email</label>
                                    @if ($errors->has('email'))
                                        <span class="red-text">
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
                                        <span class="red-text">
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
                    <a href="/password/reset">Forgot Password</a><a href="{{ route('register') }}">Register</a>
                </div>
            </div>
        </div>
    </div>
@endsection
