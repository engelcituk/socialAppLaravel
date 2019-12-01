
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card border-0 bg-light px-4 py-2">
                    <form action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Email:</label>
                                <input class="form-control border-0" type="email" name="email" placeholder="Tu email">
                            </div>
                            <div class="form-group">
                                <label for="">Contraseña:</label>
                                <input class="form-control border-0" type="password" name="password" placeholder="Su contraseña">
                            </div>
                            <button class="btn btn-primary btn-block" id="login-btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
