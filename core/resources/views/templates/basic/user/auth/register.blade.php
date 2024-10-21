@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $register = getContent('register.content', true);
        $socialLogin = getContent('social_login.content', true);
        $policyPages = getContent('policy_pages.element', false, null, true);
    @endphp

    <section class="account py-120">
        <div class="account-inner">
            <div class="container">
                <div class="row gy-4 flex-wrap-reverse align-items-center">
                    <div class="col-lg-7 d-lg-block d-none">
                        <div class="account-thumb-wrapper">
                            <div class="text-start">
                                <h3 class="account-thumb-wrapper__title">{{ __(@$register->data_values->heading) }}</h3>
                            </div>
                            <div class="account-thumb">
                                <img src="{{ frontendImage('register', @$register->data_values->image, '680x450') }}" alt="@lang('Image')">
                                <img src="{{ getImage($activeTemplateTrue . 'images/curve-shape.png') }}" alt="@lang('Image')" class="account-thumb__element one">
                                <img src="{{ getImage($activeTemplateTrue . 'images/banner-shape2.png') }}" alt="@lang('Image')" class="account-thumb__element two">
                                <div class="design-qty flex-center">
                                    <div class="design-qty__content">
                                        <span class="design-qty__icon"> <img src="{{ frontendImage('register', @$register->data_values->icon_image, '30x20') }}" alt="@lang('Image')"> </span>
                                        <span class="design-qty__number text--base">{{ __(@$register->data_values->icon_title) }}</span>
                                        <span class="design-qty__text">{{ __(@$register->data_values->icon_subtitle) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="account-form">
                            <div class="text-center mb--4">
                                <h5 class="account-form__title mb-2">{{ __(@$register->data_values->title) }}</h5>
                                <p>{{ __(@$register->data_values->subtitle) }}</p>
                            </div>
                            @php
                                $credentials = gs('socialite_credentials');
                            @endphp
                            @if ($credentials->google->status == Status::ENABLE || $credentials->facebook->status == Status::ENABLE || $credentials->linkedin->status == Status::ENABLE)
                                <div class="mb-4">
                                    <ul class="social-login-list d-flex gap-3 flex-wrap">
                                        @if ($credentials->facebook->status == Status::ENABLE)
                                            <li class="social-login-list__item facebook flex-fill">
                                                <a href="{{ route('user.social.login', 'facebook') }}" class="social-login-list__link">
                                                    <span class="icon"><i class="icon-Fackbook"></i></span>
                                                    @lang('Facebook')
                                                </a>
                                            </li>
                                        @endif

                                        @if ($credentials->google->status == Status::ENABLE)
                                            <li class="social-login-list__item google flex-fill">
                                                <a href="{{ route('user.social.login', 'google') }}" class="social-login-list__link">
                                                    <span class="icon"><i class="icon-google-1"></i></span>
                                                    @lang('Google')
                                                </a>
                                            </li>
                                        @endif

                                        @if ($credentials->linkedin->status == Status::ENABLE)
                                            <li class="social-login-list__item linkedin flex-fill">
                                                <a href="{{ route('user.social.login', 'linkedin') }}" class="social-login-list__link">
                                                    <span class="icon"><i class="fab fa-linkedin"></i></span>
                                                    @lang('Linkedin')
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="mb-4">
                                    <div class="another-login text-center">
                                        <hr class="bar">
                                        <span class="another-login__text">@lang('OR')</span>
                                        <hr class="bar">
                                    </div>
                                </div>
                            @endif
                            <form action="{{ route('user.register') }}" method="POST" class="verify-gcaptcha">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">

                                            <label class="form--label">@lang('First Name')</label>
                                            <input type="text" class="form-control form--control form--control--sm" name="firstname" value="{{ old('firstname', @$user->firstname) }}" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">

                                            <label class="form--label">@lang('Last Name')</label>
                                            <input type="text" class="form-control form--control form--control--sm" name="lastname" value="{{ old('lastname', @$user->lastname) }}" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-12">
                                        <div class="form-group">
                                            <label class="form--label">@lang('E-Mail Address')</label>
                                            <input type="email" class="form--control form--control--sm checkUser" name="email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form--label">@lang('Password')</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control form--control form--control--sm @if (gs('secure_password')) secure-password @endif" name="password" required>
                                                <span class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#password"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form--label">@lang('Confirm Password')</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control form--control form--control--sm" name="password_confirmation" required>
                                                <span class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#password_confirmation"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <x-captcha />
                                    </div>
                                    @if (gs('agree'))
                                        <div class="form-group form--checks">
                                            <input type="checkbox" id="agree" @checked(old('agree')) name="agree" class="form-check-input" required>
                                            <label for="agree" class="form-check-label"> @lang('I agree with')</label>
                                            <span>
                                                @foreach ($policyPages as $policy)
                                                    <a class="fw-500 forgot-pass fs-14" href="{{ route('policy.pages', $policy->slug) }}" target="_blank">{{ __($policy->data_values->title) }}</a>
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </span>
                                        </div>
                                    @endif
                                    <div class="col-sm-12">
                                        <div class="form-group mt-2">
                                            <button class="btn btn--base btn--md w-100" id="recaptcha">@lang('Sign Up')</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="have-account">
                                            <p class="have-account__text">@lang('Have an account?') <a href="{{ route('user.login') }}" class="have-account__link  fw-500">@lang('Sign In')</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal custom--modal register fade custom--modal" id="existModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <p class="text-center mb-0 fs-16 fw-500">@lang('You already have an account please') <a href="{{ route('user.login') }}" class="">@lang('Login')</a></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark btn--sm" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('script')
    <script>
        "use strict";
        (function($) {

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';

                var data = {
                    email: value,
                    _token: token
                }

                $.post(url, data, function(response) {
                    if (response.data != false) {
                        $('#existModalCenter').modal('show');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
