@if (session('success'))

    <div
        id="{{ $id ?? 'successAlert' }}"
        class="alert d-flex align-items-center gap-2 mb-4 position-relative overflow-hidden"
        style="
            border: 1px solid #cfe2ff;
            border-radius: 10px;
            background: #eaf1ff;
            color: #3478f6;
            font-size: 13px;
            padding-bottom: 15px;
        "
    >

        {{-- =================================================
             ICON
        ================================================== --}}

        <i class="bi bi-check-circle-fill"></i>


        {{-- =================================================
             MESSAGE
        ================================================== --}}

        <span>
            {{ session('success') }}
        </span>


        {{-- =================================================
             PROGRESS BAR
        ================================================== --}}

        <div
            class="success-alert-progress"
            style="
                position: absolute;
                left: 0;
                bottom: 0;
                width: 0%;
                height: 3px;
                background: #3478f6;
                transition: width {{ $duration ?? 4000 }}ms linear;
            "
        ></div>

    </div>


    @push('scripts')

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                function () {

                    const successAlert =
                        document.getElementById(
                            '{{ $id ?? 'successAlert' }}'
                        );


                    if (!successAlert) {
                        return;
                    }


                    const progressBar =
                        successAlert.querySelector(
                            '.success-alert-progress'
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | START PROGRESS BAR
                    |--------------------------------------------------------------------------
                    */

                    setTimeout(
                        function () {

                            if (progressBar) {

                                progressBar.style.width =
                                    '100%';

                            }

                        },
                        50
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | AUTO CLOSE
                    |--------------------------------------------------------------------------
                    */

                    setTimeout(
                        function () {

                            successAlert.style.transition =
                                'opacity 0.3s ease, transform 0.3s ease';

                            successAlert.style.opacity =
                                '0';

                            successAlert.style.transform =
                                'translateY(-5px)';


                            setTimeout(
                                function () {

                                    successAlert.remove();

                                },
                                300
                            );

                        },
                        {{ $duration ?? 4000 }}
                    );

                }
            );

        </script>

    @endpush

@endif
