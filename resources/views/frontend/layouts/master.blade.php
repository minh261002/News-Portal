<!DOCTYPE html>
<html lang="">

<head>
    <base href="{{ env('APP_URL') }}" />
    <meta charset="utf-8">
    <title>Top News HTML template </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet">
</head>

<body>

    @include('frontend.layouts.header')


    @yield('content')

    <section class="wrapper__section p-0">
        <div class="wrapper__section__components">
            @include('frontend.layouts.footer')
        </div>
    </section>

    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="{{ asset('frontend/js/index.bundle.js') }}"></script>
</body>

</html>