@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row justify-content-center gy-3">
        <div class="col-xl-3 col-lg-4">
            <div class="common-sidebar__item api-sidebar-menu">
                <div class="common-sidebar__content">
                    <ul>
                        <li>
                            <a href="" class="api-sidebar-menu__link">@lang('Get Started')</a>
                            <ul class="api-sidebar-submenu">
                                <li class="api-sidebar-submenu__item">
                                    <a href="#introduction" class="api-sidebar-submenu__link">@lang('Introduction')</a>
                                </li>
                                <li class="api-sidebar-submenu__item">
                                    <a href="#api-key" class="api-sidebar-submenu__link">@lang('API key')</a>
                                </li>
                                <li class="api-sidebar-submenu__item">
                                    <a href="#purchase-code" class="api-sidebar-submenu__link">@lang('Purchase Code')</a>
                                </li>
                                <li class="api-sidebar-submenu__item">
                                    <a href="#php-code" class="api-sidebar-submenu__link">@lang('PHP Code')</a>
                                </li>
                                <li class="api-sidebar-submenu__item">
                                    <a href="#error-response" class="api-sidebar-submenu__link">@lang('Error Response')</a>
                                </li>
                                <li class="api-sidebar-submenu__item">
                                    <a href="#success-response" class="api-sidebar-submenu__link">@lang('Success Response')</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8">
            <div class="common-sidebar__item">
                <div class="common-sidebar__content">
                    <div class="api-docs-section mb-5" id="introduction">
                        <div class="api-content">
                            <h6>@lang('Introduction')</h6>
                            <p class="api-content__desc">
                                @lang('Using the ') <span class="text--base fw-bold">{{ __(gs('site_name')) }}</span> @lang('API is pretty simple. You can easily confirm product purchases by users with our straightforward integration. Our API is designed for seamless implementation into any web & mobile application, supporting both GET and POST requests while providing responses in JSON format. Remember, URLs are case-sensitive for accurate interaction.')
                            </p>
                        </div>
                    </div>
                    <div class="api-docs-section mb-5" id="api-key">
                        <div class="api-content">
                            <h6>@lang('Api Key')</h6>
                            @if ($apiKey)
                                <p class="api-content__desc">
                                    @lang('Get your API key from the below. The API key is used to authenticate the request and determine whether the request is valid or not. If you want to regenerate the API key from the below sync icon.')
                                </p>
                                <div class="form-group">
                                    <label for="" class="form-group-label mb-2">@lang('API Key')</label>
                                    <div class="input-group">
                                        <button class="input-group-text  c--p confirmationBtn" data-question="@lang('Are you sure to regenerate your API key? Your old API key stops working here if you do it!')" data-bs-toggle="tooltip"
                                            title="@lang('Regenerate API Key')" data-action="{{ route('user.api.key.generate') }}">
                                            <i class="las la-sync-alt"></i>
                                        </button>
                                        <input type="text" class="form-control  copyText" readonly value="{{ @$apiKey->key }}">
                                        <button class="input-group-text c--p coptBtn">
                                            <i class="las la-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <p class="api-content__desc">
                                    @lang('The API key is used to authenticate the request and determine whether the request is valid or not. If you want to generate the API key from the below generate button.')
                                </p>
                                <div class="text-center py-4">
                                    <img src="{{ asset('assets/images/api_key.png') }}" class="mb-2">
                                    <p class="fs-14 mb-3">@lang("You don't have any API keys. Generate your API key by clicking below the Generate button")</p>
                                    <button class="btn btn--base confirmationBtn" type="button"
                                        data-question="@lang('Are you sure to generate your API key?')"data-action="{{ route('user.api.key.generate') }}">@lang('Generate API Key')
                                    </button>
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="api-docs-section mb-5" id="purchase-code">
                        <div class="api-content">
                            <h6>@lang('Verify Purchase Code')</h6>
                            <p class="mb-3">
                                @lang('Effortlessly verify user product purchases through this endpoint, complete with sample success and error responses exemplified below for your convenience.')
                            </p>
                            <p class="api-content__desc mb-0">
                                @lang('URL:') <span class="text--primary">{{ route('api.purchase.code.verify') }}</span>
                            </p>
                            <p class="api-content__desc mb-0">
                                @lang('METHOD:') <span class="text--primary">@lang('POST')</span>
                            </p>
                            <p class="api-content__desc">
                                @lang('HEADER:') <span class="text--primary">@lang('apikey')</span>
                            </p>

                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center gap-4 ps-0 text-muted">
                                            <span>@lang('Param Name')</span>
                                            <span>@lang('purchase_code')</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center gap-4 ps-0 text-muted">
                                            <span>@lang('Param Type')</span>
                                            <span>@lang('string')</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center gap-4 ps-0 text-muted">
                                            <span>@lang('Validate')</span>
                                            <span class="badge badge--danger">@lang('Required')</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center gap-4 ps-0 text-muted">
                                            <span>@lang('Description')</span>
                                            <span>@lang('It is a unique identifier associated with a specific item purchase.')</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="api-docs-section mb-5" id="php-code">
                        <div class="api-content">
                            <h6>@lang('PHP Code')</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="right-highlited">
                                        <div class="code mb">
                                            <button class="right-highlited__button  clipboard-btn" data-clipboard-target="#php">
                                                <i class="las la-copy"></i>
                                            </button>
                                            <pre class="m-0 rounded-0">
                                                <code class="language-php" id="php">
&lt;?php
    $parameters = [
        'purchase_code' => 'Product purchase code',
    ];

    $header = [
        'apikey:your api key'
    ];

    $url ={{ route('api.purchase.code.verify') }};

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS,  $parameters);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
?&gt;
                                                </code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="api-docs-section mb-5" id="error-response">
                        <div class="api-content">
                            <h6>@lang('Error Response')</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="code">
                                        <pre class="">
                                            <code class="language-php h-100">
{
    "status": "error",
    "status_code": 422,
    "message": [
        "error" : [
            "The purchase code field is required.",
            "The selected purchase code is invalid.",
        ]
    ]
}
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="api-docs-section" id="success-response">
                        <div class="api-content">
                            <h6>@lang('Success Response')</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="code">
                                        <pre class="">
                                            <code class="language-php h-100">

{
    "status": "success",
    "status_code": 200,
    "message": [
        "success" : [
            "Purchase code matched.",
        ]
    ]
}

                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <x-confirmation-modal frontend="true" />
@endsection

@push('script')
    <script src="{{ asset($activeTemplateTrue . 'js/vendor/highlight.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/vendor/clipboard.min.js') }}"></script>

    <script>
        (function($) {
            $('.coptBtn').on('click', function(e) {
                var copyText = $(this).siblings('.copyText')[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                copyText.blur();
                notify('success',"API Key Copied")
            });

            new ClipboardJS('.clipboard-btn');

            $(".clipboard-btn").on('click', function(e) {
                $(this).addClass('copied');
                setTimeout(() => {
                    $(this).removeClass('copied');
                }, 15000);
            });
        })(jQuery)
    </script>
@endpush


@push('style')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/vendor/highlight.css') }}">
    <style>
        .api-sidebar-menu {
            position: sticky;
            top: 60px;
        }

        .api-sidebar-submenu__link {
            color: #464646;
        }

        .api-sidebar-menu__link {
            color: #464646;
            position: relative;
        }

        .api-sidebar-menu__link::before {
            position: absolute;
            content: '';
            top: 50%;
            left: -14px;
            margin-top: -1px;
            width: 10px;
            height: 2px;
            background-color: #21252d;
        }

        .code {
            position: relative;
            border-radius: 10px !important;
            overflow: hidden;
        }

        .table {
            border: 1px solid hsl(var(--black) / .1);
        }

        .right-highlited__button {
            position: absolute;
            right: 20px;
            top: 20px;
            color: #fff;
            font-size: 25px;
        }

        .api-sidebar-submenu {
            padding-left: 15px;
            border-left: 1px solid #cacaca;
            margin: -5px 0;
            margin-top: 5px;
        }

        .api-sidebar-submenu__item {
            padding: 5px 0;
        }

        @media (max-width:991px) {
            .api-sidebar-menu {
                padding: 20px 30px;
            }
        }

        .api-content__desc {
            margin-bottom: 20px;
            margin-top: 8px;
            font-size: 14px;
        }

        .copied::after {
            position: absolute;
            top: 8px;
            right: 0;
            width: 100px;
            display: block;
            content: "Copied";
            font-size: 12px;
            padding: 5px 5px;
            color: #fff;
            border-radius: 3px;
            background-color: transparent;
        }

        .form-group-label {
            color: #34495e;
            font-size: 16px;
            font-weight: 500;
        }

        pre[class*=language-] {
            margin: 0px !important
        }

        /* new */

        .form-control:focus {
            box-shadow: none;
        }
    </style>
@endpush
