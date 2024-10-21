@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $user = auth()->user();
    @endphp

    <div class="container">
        <div class="row justify-content-center pt-60 pb-120">
            <div class="col-md-12 col-lg-8 col-xl-7">
                <div class="card custom--card">
                    <div class="card-body">
                        <div class="alert alert-primary mb-4" role="alert">
                            <strong>
                                @lang('Complete your profile')
                            </strong>
                            <p>@lang('You need to complete your profile by providing below information.')</p>
                        </div>
                        <form method="POST" action="{{ route('user.data.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <div class="form-group">
                                        <label class="form--label">@lang('Username')</label>
                                        <input type="text" class="form--control form--control--sm checkUser" name="username" value="{{ old('username') }}" required>
                                        <small class="text-danger usernameExist"></small>
                                    </div>
                                </div>

                                <div class="form-group col-sm-6">

                                    <label class="form--label">@lang('Country')</label>
                                    <select name="country" class="form--control form--control--sm select2">
                                        @foreach ($countries as $key => $country)
                                            <option @selected($country->country == old('country')) data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">
                                                {{ __($country->country) }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group col-sm-6">

                                    <label class="form--label">@lang('Mobile')</label>
                                    <div class="input-group">
                                        <span class="input-group-text mobile-code bg--base text-white"></span>
                                        <input type="hidden" name="mobile_code">
                                        <input type="hidden" name="country_code">
                                        <input type="number" class="form-control form--control form--control--sm checkUser" name="mobile" value="{{ old('mobile') }}" required>
                                    </div>
                                    <small class="text-danger mobileExist"></small>

                                </div>

                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('Address')</label>
                                    <input type="text" class="form-control form--control form--control--sm" name="address" value="{{ old('address') }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('State')</label>
                                    <input type="text" class="form-control form--control form--control--sm" name="state" value="{{ old('state') }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('Zip Code')</label>
                                    <input type="text" class="form-control form--control form--control--sm" name="zip" value="{{ old('zip') }}">
                                </div>

                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('City')</label>
                                    <input type="text" class="form-control form--control form--control--sm" name="city" value="{{ old('city') }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn--base btn--sm w-100">
                                @lang('Submit')
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('script')
    <script>
        "use strict";
        (function($) {

            @if($mobileCode)
            $(`option[data-code={{ $mobileCode }}]`).attr('selected','');
            @endif


            $('select[name=country]').on('change',function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
                var value = $('[name=mobile]').val();
                var name = 'mobile';
                checkUser(value,name);
            });

            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));


            $('.checkUser').on('focusout', function(e) {
                var value = $(this).val();
                var name = $(this).attr('name')
                checkUser(value,name);
            });

            function checkUser(value,name){
                var url = '{{ route('user.checkUser') }}';
                var token = '{{ csrf_token() }}';

                if (name == 'mobile') {
                    var mobile = `${value}`;
                    var data = {
                        mobile: mobile,
                        mobile_code:$('.mobile-code').text().substr(1),
                        _token: token
                    }
                }
                if (name == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                     if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.field} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            }
        })(jQuery);
    </script>
@endpush