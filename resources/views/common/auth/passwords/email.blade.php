@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.action.password_request.title') }}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Form::open(['route' => 'common.auth.password.request.action', 'method' => 'post', 'class' => 'form-horizontal']) }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', trans('auth.fields.user.email.label'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::email('email', old('email'), ['class' => 'form-control', 'required' => 'required']) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit(trans('auth.action.password_request.button'), ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
