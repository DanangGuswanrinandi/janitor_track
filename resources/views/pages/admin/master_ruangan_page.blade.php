@extends('layouts.admin.app')

@section('title', 'Master Ruangan')

@section('navbar-title', 'Master Ruangan')

@section('navbar-subtitle', 'Kelola data ruangan sistem CleanTrack.')

@section('content')

    <div
        style="
            width: 100%;
        "
    >

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div
            style="
                margin-bottom: 24px;
            "
        >

            <h2
                style="
                    margin: 0;
                    color: #20252b;
                    font-size: 24px;
                    font-weight: 700;
                "
            >
                Data Master Ruangan
            </h2>

            <p
                style="
                    margin: 6px 0 0;
                    color: #98a1b2;
                    font-size: 13px;
                "
            >
                Kelola data ruangan dalam sistem CleanTrack.
            </p>

        </div>

        <div
            class="w-100 p-4 bg-white"
            style="
                box-sizing: border-box;
                border: 1px solid #edf0f5;
                border-radius: 14px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            "
        >

        {{-- =================================================
                 CARD HEADER
            ================================================== --}}

            <div
                class="d-flex align-items-center justify-content-between gap-3 mb-4"
            >

                {{-- TITLE --}}

                <div>

                    <h3
                        class="m-0 fw-semibold"
                        style="
                            color: #252a31;
                            font-size: 17px;
                        "
                    >
                        Daftar Ruangan
                    </h3>

                </div>


                {{-- =================================================
                     ADD ROOM BUTTON
                ================================================== --}}

                <button
                    type="button"
                    class="btn fw-semibold text-white d-flex align-items-center gap-2"
                    data-bs-toggle="modal"
                    data-bs-target="#addRoomModal"
                    style="
                        padding: 9px 16px;
                        border: 0;
                        border-radius: 9px;
                        background: #3478f6;
                        font-size: 13px;
                    "
                >

                    <i class="bi bi-plus-lg"></i>

                    <span>
                        Tambah Ruangan
                    </span>
                
                </button>

            </div>

    {{-- =====================================================
             RUANGAN TABLE
        ====================================================== --}}

        @include('components.admin.master_ruangan_page.ruangan_table')
    
    </div>


        

    </div>
    
    {{-- =========================================================
     ADD RUANGAN MODAL
    ========================================================== --}}

    <x-admin.master_ruangan_page.add_ruangan_modal />

   @push('scripts')

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        /*
        |--------------------------------------------------------------------------
        | ELEMENT
        |--------------------------------------------------------------------------
        */

        const modalElement =
            document.getElementById(
                'addRoomModal'
            );


        const mapElement =
            document.getElementById(
                'addRoomMap'
            );


        const latitudeInput =
            document.getElementById(
                'addRoomLatitude'
            );


        const longitudeInput =
            document.getElementById(
                'addRoomLongitude'
            );

        const useCurrentLocationButton =
            document.getElementById(
                'useCurrentRoomLocation'
            );


        const codeInput =
            document.getElementById(
                'addRoomCode'
            );


        if (
            !modalElement ||
            !mapElement ||
            !latitudeInput ||
            !longitudeInput
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | DEFAULT LOCATION
        |--------------------------------------------------------------------------
        |
        | Digunakan jika lokasi perangkat tidak
        | berhasil diperoleh.
        |
        */

        const defaultLatitude =
            -7.1578;


        const defaultLongitude =
            112.6418;


        /*
        |--------------------------------------------------------------------------
        | MAP STATE
        |--------------------------------------------------------------------------
        */

        let roomMap =
            null;


        let roomMarker =
            null;


        /*
        |--------------------------------------------------------------------------
        | GENERATE PREVIEW KODE RUANGAN
        |--------------------------------------------------------------------------
        |
        | FRONTEND SAJA.
        | Nomor final tetap akan dibuat oleh backend.
        |
        */

        function generateRoomCode() {

            const existingRows =
                document.querySelectorAll(
                    '[data-room-id]'
                );


            const nextNumber =
                existingRows.length + 1;


            codeInput.value =
                'RNG-' +
                String(
                    nextNumber
                ).padStart(
                    3,
                    '0'
                );

        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE KOORDINAT
        |--------------------------------------------------------------------------
        */

        function updateCoordinates(
            latitude,
            longitude
        ) {

            latitudeInput.value =
                Number(
                    latitude
                ).toFixed(7);


            longitudeInput.value =
                Number(
                    longitude
                ).toFixed(7);

        }


        /*
        |--------------------------------------------------------------------------
        | SET MARKER POSITION
        |--------------------------------------------------------------------------
        */

        function setMarkerPosition(
            latitude,
            longitude
        ) {

            if (!roomMarker) {
                return;
            }


            roomMarker.setLatLng([
                latitude,
                longitude
            ]);


            updateCoordinates(
                latitude,
                longitude
            );

        }


        /*
        |--------------------------------------------------------------------------
        | INITIALIZE MAP
        |--------------------------------------------------------------------------
        */

        function initializeRoomMap() {

            /*
            |--------------------------------------------------------------------------
            | MAP SUDAH ADA
            |--------------------------------------------------------------------------
            */

            if (roomMap) {

                roomMap.invalidateSize();

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | BUAT MAP
            |--------------------------------------------------------------------------
            */

            roomMap =
                L.map(
                    mapElement
                ).setView(
                    [
                        defaultLatitude,
                        defaultLongitude
                    ],
                    17
                );


            /*
            |--------------------------------------------------------------------------
            | OPEN STREET MAP
            |--------------------------------------------------------------------------
            */

            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                {
                    maxZoom: 20,

                    attribution:
                        '&copy; OpenStreetMap contributors'
                }
            ).addTo(
                roomMap
            );


            /*
            |--------------------------------------------------------------------------
            | MARKER
            |--------------------------------------------------------------------------
            */

            roomMarker =
                L.marker(
                    [
                        defaultLatitude,
                        defaultLongitude
                    ],
                    {
                        draggable: true
                    }
                ).addTo(
                    roomMap
                );


            /*
            |--------------------------------------------------------------------------
            | KOORDINAT AWAL
            |--------------------------------------------------------------------------
            */

            updateCoordinates(
                defaultLatitude,
                defaultLongitude
            );


            /*
            |--------------------------------------------------------------------------
            | MARKER DIGESER
            |--------------------------------------------------------------------------
            */

            roomMarker.on(
                'dragend',
                function () {

                    const position =
                        roomMarker.getLatLng();


                    updateCoordinates(
                        position.lat,
                        position.lng
                    );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | MAP DIKLIK
            |--------------------------------------------------------------------------
            */

            roomMap.on(
                'click',
                function (event) {

                    const latitude =
                        event.latlng.lat;


                    const longitude =
                        event.latlng.lng;


                    setMarkerPosition(
                        latitude,
                        longitude
                    );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | AMBIL LOKASI PERANGKAT
            |--------------------------------------------------------------------------
            */

            getCurrentLocation();

        }


        /*
        |--------------------------------------------------------------------------
        | GET CURRENT LOCATION
        |--------------------------------------------------------------------------
        */

        function getCurrentLocation() {

            if (
            useCurrentLocationButton
            ) {
            
                useCurrentLocationButton.disabled =
                    true;
            
                useCurrentLocationButton.style.opacity =
                    '0.6';
            
                useCurrentLocationButton.style.cursor =
                    'wait';
            
            }

            /*
            |--------------------------------------------------------------------------
            | BROWSER TIDAK MENDUKUNG GEOLOCATION
            |--------------------------------------------------------------------------
            */

            if (
                !navigator.geolocation
            ) {

                console.warn(
                    'Browser tidak mendukung Geolocation API.'
                );

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | REQUEST LOKASI
            |--------------------------------------------------------------------------
            */

            navigator.geolocation.getCurrentPosition(

                /*
                |--------------------------------------------------------------------------
                | BERHASIL
                |--------------------------------------------------------------------------
                */

                function (position) {
                
                    const latitude =
                        position.coords.latitude;
                
                
                    const longitude =
                        position.coords.longitude;
                
                
                    /*
                    |--------------------------------------------------------------------------
                    | PINDAHKAN MAP
                    |--------------------------------------------------------------------------
                    */
                
                    if (roomMap) {
                    
                        roomMap.setView(
                            [
                                latitude,
                                longitude
                            ],
                            18
                        );
                    
                    }
                
                
                    /*
                    |--------------------------------------------------------------------------
                    | PINDAHKAN MARKER
                    |--------------------------------------------------------------------------
                    */
                
                    setMarkerPosition(
                        latitude,
                        longitude
                    );
                
                
                    /*
                    |--------------------------------------------------------------------------
                    | AKTIFKAN KEMBALI BUTTON
                    |--------------------------------------------------------------------------
                    */
                
                    if (useCurrentLocationButton) {
                    
                        useCurrentLocationButton.disabled =
                            false;
                    
                        useCurrentLocationButton.style.opacity =
                            '1';
                    
                        useCurrentLocationButton.style.cursor =
                            'pointer';
                    
                    }
                
                },
            
            
                /*
                |--------------------------------------------------------------------------
                | GAGAL
                |--------------------------------------------------------------------------
                */
            
                function (error) {
                
                    console.warn(
                        'Lokasi perangkat tidak dapat diperoleh:',
                        error.message
                    );
                
                
                    /*
                    |--------------------------------------------------------------------------
                    | AKTIFKAN KEMBALI BUTTON
                    |--------------------------------------------------------------------------
                    */
                
                    if (useCurrentLocationButton) {
                    
                        useCurrentLocationButton.disabled =
                            false;
                    
                        useCurrentLocationButton.style.opacity =
                            '1';
                    
                        useCurrentLocationButton.style.cursor =
                            'pointer';
                    
                    }
                
                
                    /*
                    |--------------------------------------------------------------------------
                    | KEMBALI KE LOKASI DEFAULT
                    |--------------------------------------------------------------------------
                    */
                
                    if (roomMap) {
                    
                        roomMap.setView(
                            [
                                defaultLatitude,
                                defaultLongitude
                            ],
                            17
                        );
                    
                    }
                
                
                    setMarkerPosition(
                        defaultLatitude,
                        defaultLongitude
                    );
                
                },
            
            
                /*
                |--------------------------------------------------------------------------
                | OPTIONS
                |--------------------------------------------------------------------------
                */
            
                {
                    enableHighAccuracy: true,
                
                    timeout: 10000,
                
                    maximumAge: 0
                }
            
            );

        }

        /*
        |--------------------------------------------------------------------------
        | BUTTON USE CURRENT LOCATION
        |--------------------------------------------------------------------------
        */

        if (useCurrentLocationButton) {
        
            useCurrentLocationButton.addEventListener(
                'click',
                function () {
                
                    getCurrentLocation();
                
                }
            );
            
        }


        /*
        |--------------------------------------------------------------------------
        | MODAL OPEN
        |--------------------------------------------------------------------------
        */

        modalElement.addEventListener(
            'shown.bs.modal',
            function () {

                generateRoomCode();

                initializeRoomMap();


                /*
                |--------------------------------------------------------------------------
                | FIX LEAFLET SAAT MODAL DIBUKA
                |--------------------------------------------------------------------------
                */

                setTimeout(
                    function () {

                        if (roomMap) {

                            roomMap.invalidateSize();

                        }

                    },
                    100
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | RESET SAAT MODAL DITUTUP
        |--------------------------------------------------------------------------
        */

        modalElement.addEventListener(
            'hidden.bs.modal',
            function () {

                document
                    .getElementById(
                        'addRoomForm'
                    )
                    ?.reset();


                /*
                |--------------------------------------------------------------------------
                | KEMBALIKAN KE DEFAULT
                |--------------------------------------------------------------------------
                */

                if (roomMarker) {

                    roomMarker.setLatLng([
                        defaultLatitude,
                        defaultLongitude
                    ]);

                }


                if (roomMap) {

                    roomMap.setView(
                        [
                            defaultLatitude,
                            defaultLongitude
                        ],
                        17
                    );

                }


                updateCoordinates(
                    defaultLatitude,
                    defaultLongitude
                );

            }
        );

    }

);

</script>

@endpush

@endsection