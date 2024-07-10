<!DOCTYPE html>
<html lang="">

<head>
    <base href="{{ env('APP_URL') }}" />
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>
        @hasSection('title')
            @yield('title')
        @else
            {{ $setting['site_seo_title'] }}
        @endif
    </title>
    <meta name="description"
        content="@hasSection('meta_description')
@yield('meta_description')
@else
{{ $setting['site_seo_description'] }}
@endif " />
    <meta name="keywords"
        content=" @hasSection('tags')
@yield('tags')
@else
{{ $setting['site_seo_keywords'] }}
@endif " />
    <meta name="og:title" content="@yield('meta_og_title')" />
    <meta name="og:description" content="@yield('meta_og_description')" />
    <meta name="og:image"
        content="@hasSection('meta_og_image')
@yield('meta_og_image')
@else
{{ asset($setting['site_logo']) }}
@endif" />
    <meta name="twitter:title" content="@yield('meta_tw_title')" />
    <meta name="twitter:description" content="@yield('meta_tw_description')" />
    <meta name="twitter:image" content="@yield('meta_tw_image')" />


    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" />

    <style>
        :root {
            --colorPrimary: {{ $setting['site_color'] }};
        }
    </style>
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
    <!-- Sweet Alert Js -->
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            /** change language **/
            $('#site-language').on('change', function() {
                let languageCode = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('language') }}",
                    data: {
                        language_code: languageCode
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            window.location.href = "{{ url('/') }}";
                        }
                    },
                    error: function(data) {
                        console.error(data);
                    }
                })
            })
        })

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        $(document).ready(function() {

            $('.delete-item').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Cảnh báo?',
                    text: "Dữ liệu bị xoá không thể khôi phục!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xoá!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $(this).attr('href');
                        console.log(url);
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            success: function(data) {
                                if (data.status === 'success') {
                                    Toast.fire({
                                        icon: 'success',
                                        title: data.message
                                    })
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000);
                                } else if (data.status === 'error') {
                                    Toast.fire({
                                        icon: 'error',
                                        title: data.message
                                    })
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }
                })
            })

            $('#form-newsletter').on('submit', function(e) {
                e.preventDefault();

                let email = $('#newsletter-email').val();

                if (email === '') {
                    $('#emailErr').text('Email không được để trống');
                }

                $.ajax({
                    method: 'POST',
                    url: "{{ route('register-newsletter') }}",
                    data: {
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            })
                            $('#newsletter-email').val('');
                            $('#emailErr').text('');
                        } else if (data.status === 'error') {
                            Toast.fire({
                                icon: 'error',
                                title: data.message
                            })
                        }
                    },
                    error: function(xhr, status, error) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Có lỗi xảy ra, vui lòng thử lại sau'
                        })
                    }
                });
            })
        })
    </script>

    @stack('scripts')
</body>

</html>
