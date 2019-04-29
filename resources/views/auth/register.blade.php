@extends('layouts.main')

@section('title')
    Register - {{ config('app.name') }}
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Register</span>
                    <div class="row">
                        <form class="col s12" action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <input id="first_name" name="first_name" type="text">
                                    <label for="first_name">First Name</label>
                                    @if ($errors->has('first_name'))
                                        <span class="red-text">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-field col s12 m6">
                                    <input id="last_name" name="last_name" type="text">
                                    <label for="last_name">Last Name</label>
                                    @if ($errors->has('last_name'))
                                        <span class="red-text">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

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
                                <div class="input-field col s12 m6">
                                    <input id="password" name="password" type="password" class="validate">
                                    <label for="password">Password</label>
                                    @if ($errors->has('password'))
                                        <span class="red-text">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-field col s12 m6">
                                    <input id="password-confirm" name="password-confirm" type="password" class="validate">
                                    <label for="password-confirm">Confirm Password</label>
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
                    <a href="{{ route('login') }}">Log In</a>
                </div>
            </div>
        </div>
    </div>
@endsection
