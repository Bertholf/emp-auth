@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <h2>Clients</h2>
                    <passport-clients></passport-clients>
                    <hr />
                    <h2>Authorized Clients</h2>
                    <passport-authorized-clients></passport-authorized-clients>
                    <hr />
                    <h2>Personal Access Token</h2>
                    <passport-personal-access-tokens></passport-personal-access-tokens>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
