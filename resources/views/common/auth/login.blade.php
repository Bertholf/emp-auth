@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.action.login.title') }}</div>

                <div class="panel-body">
                    {{ Form::open(['route' => 'common.auth.login.action', 'method' => 'post', 'class' => 'form-horizontal']) }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', trans('auth.fields.user.email.label'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::email('email', old('email'), ['id' => 'email', 'class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::label('password', trans('auth.fields.user.password.label'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::input('password','password', old('password'), ['id' => 'password', 'class' => 'form-control', 'required' => 'required', 'placeholder' => trans('auth.fields.user.password.placeholder')]) }}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        {{ Form::input('checkbox','remember', old('remember') ? 'checked' : '') }} {{ trans('auth.action.login.remember') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {{ Form::submit(trans('auth.action.login.button'), ['class' => 'btn btn-primary']) }}

                                <a class="btn btn-link" href="{{ route('common.auth.password.request') }}">
                                    {{ trans('auth.action.password_request.link') }}
                                </a>
                            </div>
                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
