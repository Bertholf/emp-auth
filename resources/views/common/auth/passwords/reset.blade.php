@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.action.password_request.title') }}</div>

                <div class="panel-body">
                    {{ Form::open(['route' => 'common.auth.password.reset.action', 'method' => 'post', 'class' => 'form-horizontal']) }}
                        {{ Form::hidden('token', $token) }}
                        @if ($errors->has('token'))
                            <span class="help-block">
                                <strong>{{ $errors->first('token') }}</strong>
                            </span>
                        @endif

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', trans('auth.fields.user.email.label'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::input('email', 'email', old('email'), ['id' => 'email', 'class' => 'form-control', 'required' => 'required', 'placeholder' => trans('auth.fields.user.email.placeholder')]) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::label('password', trans('auth.fields.user.password.label'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::input('password', 'password', old('password'), ['id' => 'password', 'class' => 'form-control', 'required' => 'required', 'placeholder' => trans('auth.fields.user.password.placeholder')]) }}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {{ Form::label('password_confirmation', trans('auth.fields.user.password.label_confirm'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::input('password', 'password_confirmation', null, ['id' => 'password_confirmation', 'class' => 'form-control', 'required' => 'required', 'placeholder' => trans('auth.fields.user.password.placeholder_confirm')]) }}
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit(trans('auth.action.password_reset.button'), ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
