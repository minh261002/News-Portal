<!DOCTYPE html>
<html lang="">

<head>
    <base href="{{ env('APP_URL') }}" />
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('meta_title', 'News Portal')</title>
    <meta name="description" content="@yield('meta_description', 'News Portal')">
    <meta name="keywords" content="@yield('tags', 'News Portal')">
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
        })
    </script>

    @stack('scripts')
</body>

</html>
