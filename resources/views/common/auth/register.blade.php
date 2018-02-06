@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.action.register.title') }}</div>

                <div class="panel-body">
                    {{ Form::open(['route' => 'common.auth.register.action', 'method' => 'post', 'class' => 'form-horizontal']) }}

                    <div class="form-group {{ $errors->has('name_first') ? 'has-error' : '' }}">
                        {{ Form::label('name_first', trans('auth.fields.user.name_first.label'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('text', 'name_first', null, ['class' => 'form-control', 'placeholder' => trans('auth.fields.user.name_first.placeholder'), 'required' => true]) }}
                            @if ($errors->has('name_first'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name_first') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('name_last') ? 'has-error' : '' }}">
                        {{ Form::label('name_last', trans('auth.fields.user.name_last.label'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('text', 'name_last', null, ['class' => 'form-control', 'placeholder' => trans('auth.fields.user.name_last.placeholder'), 'required' => true]) }}
                            @if ($errors->has('name_last'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name_last') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('name_slug') ? 'has-error' : '' }}">
                        {{ Form::label('name_slug', trans('auth.fields.user.name_slug.label'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('text', 'name_slug', null, ['class' => 'form-control', 'placeholder' => trans('auth.fields.user.name_slug.placeholder'), 'required' => true]) }}
                            @if ($errors->has('name_slug'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name_slug') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        {{ Form::label('email', trans('auth.fields.user.email.label'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('auth.fields.user.email.placeholder'), 'required' => true]) }}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        {{ Form::label('password', trans('auth.fields.user.password.label'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('auth.fields.user.password.placeholder'), 'required' => true]) }}
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        {{ Form::label('password_confirmation', trans('auth.fields.user.password.label_confirm'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => trans('auth.fields.user.password.placeholder_confirm'), 'required' => true]) }}
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
{{--
                    @if(config('affiliate.show_on_registration'))
                    <div class="form-group {{ $errors->has('affiliate_code') ? 'has-error' : '' }}">
                        {{ Form::label('affiliate_code', trans('actor.user.affiliate.code'), ['class' => 'col-md-4 control-label']) }}
                        {{ Form::input('text', 'affiliate_code', Request::get('affiliate'), ['class' => 'form-control', 'placeholder' => trans('actor.user.affiliate.code')]) }}
                        @if ($errors->has('affiliate_code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('affiliate_code') }}</strong>
                            </span>
                        @endif
                    </div>
                    @else
                        {{ Form::hidden('affiliate_code', Request::get('affiliate')) }}
                    @endif

                    @if($role->show_on_registration && $role->fields)
                        <h4>{{ $role->title }} Meta</h4>
                        @foreach($role->fields as $field)
                            <div class="form-group">
                                <label class="text-capitalize">{!! $field->title !!}</label>
                                {!! $field->render() !!}
                            </div>
                        @endforeach
                    @endif

                    <div class="form-group clearfix">
                        <div class="checkbox-custom checkbox-inline checkbox-primary pull-xs-left">
                            <input type="checkbox" value="agree" name="agreement">
                            <label for="agreement">{{ trans('actor.user.auth.agreement') }}</label>
                            @if ($errors->has('agreement'))
                            <span class="help-block">
                                <strong>{{ $errors->first('agreement') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    @if (config('actor.captcha.registration'))
                    <div class="form-group">
                        <div class="checkbox checkbox-secondary">
                            {!! Form::captcha() !!}
                            {{ Form::hidden('captcha_status', 'true') }}
                        </div>
                    </div>
                    @endif
--}}

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {{ Form::submit(trans('auth.action.register.button'), ['class' => 'btn btn-primary btn-block']) }}
                        </div>
                    </div>

                    {{ Form::close() }}

                    <p class="sign-up-link">{{ trans('auth.action.login.link') }} <a href="{{ route('common.auth.login') }}">{{ trans('auth.action.login.button') }}</a></p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
