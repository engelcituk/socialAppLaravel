@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card border-0 bg-light">
                    <form action="{{route('statuses.store')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <textarea class="form-control border-0 bg-light" name="body" placeholder="¿Qué estas pensando Nazky?"></textarea>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" id="createStatus">Publicar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
