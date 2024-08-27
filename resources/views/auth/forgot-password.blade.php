<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path=""
  data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Forgot Password</title>
    <meta name="description" content="" />

    <!-- Favicon -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ url('vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ url('vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ url('vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <script src="{{ url('js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <x-authentication-card>
                            <x-slot name="logo">
                                <div class="app-brand justify-content-center">
                                    <!-- <a href="index.html" class="app-brand-link gap-2"> -->
                                        <span class="app-brand-logo demo">
                                            <!-- SVG logo -->
                                        </span>
                                        <span class="app-brand-text demo text-body fw-bolder">SIIX</span>
                                    </a>
                                </div>
                            </x-slot>

                            <h4 class="mb-2">Forgot Password? 🔒</h4>
                            <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <x-validation-errors class="mb-4" />

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="mb-3">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="Enter your email" required autofocus autocomplete="username" />
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <x-button>{{ __('Send Reset Link') }}</x-button>
                                </div>
                            </form>

                            <div class="text-center">
                                <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                    {{ __('Back to login') }}
                                </a>
                            </div>
                        </x-authentication-card>
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Core JS -->
    <script src="{{ url('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ url('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('vendor/js/menu.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ url('js/main.js') }}"></script>
</body>
</html>
