@extends('layouts.main')

@section('container')
    <div class="container-fluid">
        <section class="ftco-section">
            <div class="container">
                @if (session()->has('status'))
                    <div class="failed-data" data-failed="{{ session('status') }} "></div>
                @endif
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5">
                        <h1 class="heading-section">{{ $ucapan }}</h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                            <h3 class="mb-4 text-center">Have an account?</h3>
                            <form action="/" method="post" class="signin-form">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email adress"
                                        required />
                                </div>
                                <div class="form-group">
                                    <input id="password-field" name="password" type="password" class="form-control"
                                        placeholder="Password" required />
                                    <span toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary submit px-3">
                                        Sign In
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
