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

                {{-- =====================================================
             SUCCESS ALERT
        ====================================================== --}}

        @if (session('success'))

            <div
                class="alert d-flex align-items-center gap-2 mb-4"
                style="
                    border: 1px solid #cfe2ff;
                    border-radius: 10px;
                    background: #eaf1ff;
                    color: #3478f6;
                    font-size: 13px;
                "
            >

                <i class="bi bi-check-circle-fill"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif

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

    <x-admin.master_ruangan_page.add_ruangan_modal
        :next-room-code="$nextRoomCode"
    />
    <x-admin.master_ruangan_page.edit_ruangan_modal />

    <x-admin.master_ruangan_page.delete_ruangan_modal />

    <x-admin.master_ruangan_page.view_ruangan_modal />

   @push('scripts')

<script>

    /*
        |--------------------------------------------------------------------------
        | Modal View
        |--------------------------------------------------------------------------
        */

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const qrContainer =
                document.getElementById(
                    'viewRoomQrCode'
                );


            const qrText =
                document.getElementById(
                    'viewRoomQrCodeText'
                );


            const downloadButton =
                document.getElementById(
                    'downloadRoomQrButton'
                );


            if (
                !qrContainer ||
                !qrText ||
                !downloadButton
            ) {
                return;
            }


            let currentQrCode =
                '';


            document
                .querySelectorAll(
                    '.room-action-view'
                )
                .forEach(
                    function (button) {

                        button.addEventListener(
                            'click',
                            async function () {

                                const kodeRuangan =
                                    button.dataset.kodeRuangan;


                                currentQrCode =
                                    button.dataset.qrCode ||
                                    kodeRuangan;


                                document
                                    .getElementById(
                                        'viewRoomCode'
                                    )
                                    .textContent =
                                        kodeRuangan;


                                document
                                    .getElementById(
                                        'viewRoomName'
                                    )
                                    .textContent =
                                        button.dataset.namaRuangan;


                                document
                                    .getElementById(
                                        'viewRoomLocation'
                                    )
                                    .textContent =
                                        button.dataset.lokasi;


                                document
                                    .getElementById(
                                        'viewRoomCoordinate'
                                    )
                                    .textContent =
                                        `${button.dataset.latitude}, ${button.dataset.longitude}`;


                                document
                                    .getElementById(
                                        'viewRoomCreatedAt'
                                    )
                                    .textContent =
                                        button.dataset.createdAt;


                                document
                                    .getElementById(
                                        'viewRoomUpdatedAt'
                                    )
                                    .textContent =
                                        button.dataset.updatedAt;


                                qrText.textContent =
                                    currentQrCode;


                                qrContainer.innerHTML =
                                    '';


                                const canvas =
                                    document.createElement(
                                        'canvas'
                                    );


                                await QRCode.toCanvas(
                                    canvas,
                                    currentQrCode,
                                    {
                                        width: 220,
                                        margin: 2
                                    }
                                );


                                qrContainer.appendChild(
                                    canvas
                                );

                            }
                        );

                    }
                );


            downloadButton.addEventListener(
                'click',
                async function () {

                    if (!currentQrCode) {
                        return;
                    }


                    const canvas =
                        document.createElement(
                            'canvas'
                        );


                    await QRCode.toCanvas(
                        canvas,
                        currentQrCode,
                        {
                            width: 800,
                            margin: 3
                        }
                    );


                    const link =
                        document.createElement(
                            'a'
                        );


                    link.download =
                        `${currentQrCode}.jpg`;


                    link.href =
                        canvas.toDataURL(
                            'image/jpeg',
                            0.95
                        );


                    link.click();

                }
            );

        }
    );


    /*
        |--------------------------------------------------------------------------
        | Modal Delete
        |--------------------------------------------------------------------------
        */
    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const deleteForm =
                document.getElementById(
                    'deleteRoomForm'
                );


            const deleteRoomName =
                document.getElementById(
                    'deleteRoomName'
                );


            if (
                !deleteForm ||
                !deleteRoomName
            ) {
                return;
            }


            document
                .querySelectorAll(
                    '.room-action-delete'
                )
                .forEach(
                    function (button) {

                        button.addEventListener(
                            'click',
                            function () {

                                const roomId =
                                    button.dataset.roomId;


                                const roomName =
                                    button.dataset.namaRuangan;


                                deleteRoomName.textContent =
                                    roomName;


                                deleteForm.action =
                                    `/admin/master-ruangan/${roomId}`;

                            }
                        );

                    }
                );

        }
    );

    /*
|--------------------------------------------------------------------------
| MODAL EDIT RUANGAN
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'DOMContentLoaded',
    function () {

        /*
        |--------------------------------------------------------------------------
        | ELEMENT
        |--------------------------------------------------------------------------
        */

        const editModalElement =
            document.getElementById(
                'editRoomModal'
            );


        const editMapElement =
            document.getElementById(
                'editRoomMap'
            );


        const editForm =
            document.getElementById(
                'editRoomForm'
            );


        const editRoomCode =
            document.getElementById(
                'editRoomCode'
            );


        const editRoomName =
            document.getElementById(
                'editRoomName'
            );


        const editRoomLocation =
            document.getElementById(
                'editRoomLocation'
            );


        const editRoomLatitude =
            document.getElementById(
                'editRoomLatitude'
            );


        const editRoomLongitude =
            document.getElementById(
                'editRoomLongitude'
            );


        const useCurrentEditLocationButton =
            document.getElementById(
                'useCurrentEditRoomLocation'
            );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI ELEMENT
        |--------------------------------------------------------------------------
        */

        if (
            !editModalElement ||
            !editMapElement ||
            !editForm ||
            !editRoomLatitude ||
            !editRoomLongitude
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | MAP STATE
        |--------------------------------------------------------------------------
        */

        let editRoomMap =
            null;


        let editRoomMarker =
            null;


        /*
        |--------------------------------------------------------------------------
        | ROOM YANG SEDANG DIEDIT
        |--------------------------------------------------------------------------
        */

        let currentEditRoom =
            null;


        /*
        |--------------------------------------------------------------------------
        | UPDATE KOORDINAT
        |--------------------------------------------------------------------------
        */

        function updateEditCoordinates(
            latitude,
            longitude
        ) {

            editRoomLatitude.value =
                Number(
                    latitude
                ).toFixed(7);


            editRoomLongitude.value =
                Number(
                    longitude
                ).toFixed(7);

        }


        /*
        |--------------------------------------------------------------------------
        | SET MARKER POSITION
        |--------------------------------------------------------------------------
        */

        function setEditMarkerPosition(
            latitude,
            longitude
        ) {

            if (!editRoomMarker) {
                return;
            }


            editRoomMarker.setLatLng(
                [
                    latitude,
                    longitude
                ]
            );


            updateEditCoordinates(
                latitude,
                longitude
            );

        }


        /*
        |--------------------------------------------------------------------------
        | INITIALIZE MAP
        |--------------------------------------------------------------------------
        */

        function initializeEditRoomMap(
            latitude,
            longitude
        ) {

            /*
            |--------------------------------------------------------------------------
            | MAP SUDAH ADA
            |--------------------------------------------------------------------------
            */

            if (editRoomMap) {

                editRoomMap.setView(
                    [
                        latitude,
                        longitude
                    ],
                    18
                );


                setEditMarkerPosition(
                    latitude,
                    longitude
                );


                setTimeout(
                    function () {

                        editRoomMap.invalidateSize();

                    },
                    100
                );


                return;

            }


            /*
            |--------------------------------------------------------------------------
            | BUAT MAP
            |--------------------------------------------------------------------------
            */

            editRoomMap =
                L.map(
                    editMapElement
                ).setView(
                    [
                        latitude,
                        longitude
                    ],
                    18
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
                editRoomMap
            );


            /*
            |--------------------------------------------------------------------------
            | MARKER
            |--------------------------------------------------------------------------
            */

            editRoomMarker =
                L.marker(
                    [
                        latitude,
                        longitude
                    ],
                    {
                        draggable: true
                    }
                ).addTo(
                    editRoomMap
                );


            /*
            |--------------------------------------------------------------------------
            | KOORDINAT AWAL
            |--------------------------------------------------------------------------
            */

            updateEditCoordinates(
                latitude,
                longitude
            );


            /*
            |--------------------------------------------------------------------------
            | MARKER DIGESER
            |--------------------------------------------------------------------------
            */

            editRoomMarker.on(
                'dragend',
                function () {

                    const position =
                        editRoomMarker.getLatLng();


                    updateEditCoordinates(
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

            editRoomMap.on(
                'click',
                function (event) {

                    const latitude =
                        event.latlng.lat;


                    const longitude =
                        event.latlng.lng;


                    setEditMarkerPosition(
                        latitude,
                        longitude
                    );

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | GET CURRENT LOCATION
        |--------------------------------------------------------------------------
        */

        function getCurrentEditLocation() {

            if (
                useCurrentEditLocationButton
            ) {

                useCurrentEditLocationButton.disabled =
                    true;


                useCurrentEditLocationButton.style.opacity =
                    '0.6';


                useCurrentEditLocationButton.style.cursor =
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


                enableCurrentLocationButton();

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | REQUEST LOKASI
            |--------------------------------------------------------------------------
            */

            navigator.geolocation.getCurrentPosition(

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

                    if (editRoomMap) {

                        editRoomMap.setView(
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

                    setEditMarkerPosition(
                        latitude,
                        longitude
                    );


                    enableCurrentLocationButton();

                },


                function (error) {

                    console.warn(
                        'Lokasi perangkat tidak dapat diperoleh:',
                        error.message
                    );


                    enableCurrentLocationButton();

                },


                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }

            );

        }


        /*
        |--------------------------------------------------------------------------
        | ENABLE BUTTON
        |--------------------------------------------------------------------------
        */

        function enableCurrentLocationButton() {

            if (
                useCurrentEditLocationButton
            ) {

                useCurrentEditLocationButton.disabled =
                    false;


                useCurrentEditLocationButton.style.opacity =
                    '1';


                useCurrentEditLocationButton.style.cursor =
                    'pointer';

            }

        }


        /*
        |--------------------------------------------------------------------------
        | BUTTON USE CURRENT LOCATION
        |--------------------------------------------------------------------------
        */

        if (
            useCurrentEditLocationButton
        ) {

            useCurrentEditLocationButton.addEventListener(
                'click',
                function () {

                    getCurrentEditLocation();

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | BUTTON EDIT
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(
                '.room-action-edit'
            )
            .forEach(
                function (button) {

                    button.addEventListener(
                        'click',
                        function () {

                            /*
                            |--------------------------------------------------------------------------
                            | AMBIL DATA RUANGAN
                            |--------------------------------------------------------------------------
                            */

                            const roomId =
                                button.dataset.roomId;


                            const kodeRuangan =
                                button.dataset.kodeRuangan || '';


                            const namaRuangan =
                                button.dataset.namaRuangan || '';


                            const lokasi =
                                button.dataset.lokasi || '';


                            const latitude =
                                parseFloat(
                                    button.dataset.latitude
                                );


                            const longitude =
                                parseFloat(
                                    button.dataset.longitude
                                );


                            /*
                            |--------------------------------------------------------------------------
                            | SIMPAN ROOM AKTIF
                            |--------------------------------------------------------------------------
                            */

                            currentEditRoom = {
                                id: roomId,
                                latitude: latitude,
                                longitude: longitude
                            };


                            /*
                            |--------------------------------------------------------------------------
                            | ISI FORM
                            |--------------------------------------------------------------------------
                            */

                            editRoomCode.value =
                                kodeRuangan;


                            editRoomName.value =
                                namaRuangan;


                            editRoomLocation.value =
                                lokasi;


                            updateEditCoordinates(
                                latitude,
                                longitude
                            );


                            /*
                            |--------------------------------------------------------------------------
                            | FORM ACTION
                            |--------------------------------------------------------------------------
                            */

                            editForm.action =
                                `/admin/master-ruangan/${roomId}`;

                        }
                    );

                }
            );


        /*
        |--------------------------------------------------------------------------
        | MODAL OPEN
        |--------------------------------------------------------------------------
        */

        editModalElement.addEventListener(
            'shown.bs.modal',
            function () {

                if (
                    !currentEditRoom
                ) {
                    return;
                }


                initializeEditRoomMap(
                    currentEditRoom.latitude,
                    currentEditRoom.longitude
                );


                /*
                |--------------------------------------------------------------------------
                | FIX LEAFLET SAAT MODAL DIBUKA
                |--------------------------------------------------------------------------
                */

                setTimeout(
                    function () {

                        if (
                            editRoomMap
                        ) {

                            editRoomMap.invalidateSize();


                            editRoomMap.setView(
                                [
                                    parseFloat(
                                        editRoomLatitude.value
                                    ),
                                    parseFloat(
                                        editRoomLongitude.value
                                    )
                                ],
                                18
                            );

                        }

                    },
                    100
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | MODAL CLOSE
        |--------------------------------------------------------------------------
        */

        editModalElement.addEventListener(
            'hidden.bs.modal',
            function () {

                currentEditRoom =
                    null;


                enableCurrentLocationButton();

            }
        );

    }

);

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