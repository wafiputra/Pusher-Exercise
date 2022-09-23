@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to, {{ config('app.name', 'Laravel') }}</div>

                <div class="card-body">
                    <center>
                        <h1>
                            LANDING PAGE
                        </h1>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
