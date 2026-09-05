<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        /*
        |--------------------------------------------------------------------------
        | VIEW MODAL
        |--------------------------------------------------------------------------
        */

        const viewModal =
            document.getElementById(
                'viewKelolaLaporanModal'
            );

        const viewUser =
            document.getElementById(
                'viewKelolaLaporanUser'
            );

        const viewRuangan =
            document.getElementById(
                'viewKelolaLaporanRuangan'
            );

        const viewKodeRuangan =
            document.getElementById(
                'viewKelolaLaporanKodeRuangan'
            );

        const viewFoto =
            document.getElementById(
                'viewKelolaLaporanFoto'
            );

        const viewFotoEmpty =
            document.getElementById(
                'viewKelolaLaporanFotoEmpty'
            );

        const viewLatitude =
            document.getElementById(
                'viewKelolaLaporanLatitude'
            );

        const viewLongitude =
            document.getElementById(
                'viewKelolaLaporanLongitude'
            );

        const viewKeterangan =
            document.getElementById(
                'viewKelolaLaporanKeterangan'
            );

        const viewCreatedAt =
            document.getElementById(
                'viewKelolaLaporanCreatedAt'
            );

        const viewUpdatedAt =
            document.getElementById(
                'viewKelolaLaporanUpdatedAt'
            );


        /*
        |--------------------------------------------------------------------------
        | VIEW - RESET
        |--------------------------------------------------------------------------
        */

        function resetViewModal() {

            if (viewUser) {
                viewUser.textContent = '-';
            }

            if (viewRuangan) {
                viewRuangan.textContent = '-';
            }

            if (viewKodeRuangan) {
                viewKodeRuangan.textContent = '-';
            }

            if (viewLatitude) {
                viewLatitude.textContent = '-';
            }

            if (viewLongitude) {
                viewLongitude.textContent = '-';
            }

            if (viewKeterangan) {
                viewKeterangan.textContent = '-';
            }

            if (viewCreatedAt) {
                viewCreatedAt.textContent = '-';
            }

            if (viewUpdatedAt) {
                viewUpdatedAt.textContent = '-';
            }

            if (viewFoto) {
                viewFoto.src = '';
                viewFoto.style.display = 'none';
            }

            if (viewFotoEmpty) {
                viewFotoEmpty.style.display = 'block';
            }
        }


        /*
        |--------------------------------------------------------------------------
        | VIEW - LOAD DATA
        |--------------------------------------------------------------------------
        */

        async function loadViewData(
            laporanId
        ) {

            resetViewModal();

            try {

                const response =
                    await fetch(
                        `/admin/kelola_laporan/${laporanId}`,
                        {
                            method: 'GET',

                            headers: {
                                'Accept':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );


                if (!response.ok) {

                    throw new Error(
                        'Gagal mengambil data laporan.'
                    );
                }


                const data =
                    await response.json();


                if (viewUser) {
                    viewUser.textContent =
                        data.user ?? '-';
                }

                if (viewRuangan) {
                    viewRuangan.textContent =
                        data.ruangan ?? '-';
                }

                if (viewKodeRuangan) {
                    viewKodeRuangan.textContent =
                        data.kode_ruangan ?? '-';
                }

                if (viewLatitude) {
                    viewLatitude.textContent =
                        data.latitude ?? '-';
                }

                if (viewLongitude) {
                    viewLongitude.textContent =
                        data.longitude ?? '-';
                }

                if (viewKeterangan) {
                    viewKeterangan.textContent =
                        data.keterangan ??
                        'Tidak ada keterangan';
                }

                if (viewCreatedAt) {
                    viewCreatedAt.textContent =
                        data.created_at ?? '-';
                }

                if (viewUpdatedAt) {
                    viewUpdatedAt.textContent =
                        data.updated_at ?? '-';
                }


                if (
                    data.foto &&
                    viewFoto
                ) {

                    viewFoto.src =
                        `{{ asset('storage') }}/${data.foto}`;

                    viewFoto.style.display =
                        'block';

                    if (viewFotoEmpty) {
                        viewFotoEmpty.style.display =
                            'none';
                    }

                }

            } catch (error) {

                console.error(
                    'View Laporan Error:',
                    error
                );

                alert(
                    'Gagal mengambil data laporan.'
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | VIEW - OPEN
        |--------------------------------------------------------------------------
        */

        if (viewModal) {

            viewModal.addEventListener(
                'show.bs.modal',
                function (event) {

                    const button =
                        event.relatedTarget;

                    if (!button) {
                        return;
                    }

                    const laporanId =
                        button.getAttribute(
                            'data-laporan-id'
                        );

                    if (!laporanId) {
                        return;
                    }

                    loadViewData(
                        laporanId
                    );
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | VIEW FOTO - SWEETALERT
        |--------------------------------------------------------------------------
        */

        if (viewFoto) {

            viewFoto.addEventListener(
                'click',
                function () {

                    const imageUrl =
                        this.src;

                    if (!imageUrl) {
                        return;
                    }

                    Swal.fire({

                        imageUrl: imageUrl,

                        imageAlt:
                            'Foto laporan',

                        showConfirmButton: false,

                        showCloseButton: true,

                        background: '#ffffff',

                        width: 'auto',

                        padding: '10px',

                        customClass: {

                            popup:
                                'view-kelola-laporan-photo-popup',

                            image:
                                'view-kelola-laporan-photo-image'

                        }

                    });

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | EDIT MODAL
        |--------------------------------------------------------------------------
        */

        const editModal =
            document.getElementById(
                'editKelolaLaporanModal'
            );

        const editForm =
            document.getElementById(
                'editKelolaLaporanForm'
            );

        const editUser =
            document.getElementById(
                'editKelolaLaporanUser'
            );

        const editRuangan =
            document.getElementById(
                'editKelolaLaporanRuangan'
            );

        const editFotoPreview =
            document.getElementById(
                'editKelolaLaporanFotoPreview'
            );

        const editLatitude =
            document.getElementById(
                'editKelolaLaporanLatitude'
            );

        const editLongitude =
            document.getElementById(
                'editKelolaLaporanLongitude'
            );

        const editKeterangan =
            document.getElementById(
                'editKelolaLaporanKeterangan'
            );

        const editStatus =
            document.getElementById(
                'editKelolaLaporanStatus'
            );

        const editMapElement =
            document.getElementById(
                'editKelolaLaporanMap'
            );

        let editMap = null;

        let editMarker = null;

        /*
        |--------------------------------------------------------------------------
        | EDIT - MAP
        |--------------------------------------------------------------------------
        */

        function initializeEditMap(
            latitude,
            longitude
        ) {

            if (!editMapElement) {
                return;
            }

            if (
                typeof L === 'undefined'
            ) {

                console.error(
                    'Leaflet belum tersedia.'
                );

                return;
            }


            const lat =
                parseFloat(latitude);

            const lng =
                parseFloat(longitude);


            if (
                Number.isNaN(lat) ||
                Number.isNaN(lng)
            ) {

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | BUAT MAP
            |--------------------------------------------------------------------------
            */

            if (!editMap) {

                editMap =
                    L.map(
                        editMapElement
                    ).setView(
                        [
                            lat,
                            lng
                        ],
                        18
                    );


                L.tileLayer(
                    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                    {
                        maxZoom: 22,
                        attribution: '&copy; OpenStreetMap'
                    }
                ).addTo(
                    editMap
                );


                /*
                |--------------------------------------------------------------------------
                | MARKER
                |--------------------------------------------------------------------------
                */

                editMarker =
                    L.marker(
                        [
                            lat,
                            lng
                        ],
                        {
                            draggable: true
                        }
                    ).addTo(
                        editMap
                    );


                /*
                |--------------------------------------------------------------------------
                | MARKER DRAG
                |--------------------------------------------------------------------------
                */

                editMarker.on(
                    'dragend',
                    function () {

                        const position =
                            editMarker.getLatLng();


                        updateEditCoordinates(
                            position.lat,
                            position.lng
                        );

                    }
                );

            } else {

                editMap.setView(
                    [
                        lat,
                        lng
                    ],
                    18
                );


                editMarker.setLatLng(
                    [
                        lat,
                        lng
                    ]
                );

            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE INPUT
            |--------------------------------------------------------------------------
            */

            updateEditCoordinates(
                lat,
                lng
            );


            /*
            |--------------------------------------------------------------------------
            | FIX MAP SIZE
            |--------------------------------------------------------------------------
            */

            setTimeout(
                function () {

                    if (editMap) {

                        editMap.invalidateSize();

                    }

                },
                200
            );

        }


        /*
        |--------------------------------------------------------------------------
        | EDIT - UPDATE COORDINATES
        |--------------------------------------------------------------------------
        */

        function updateEditCoordinates(
            latitude,
            longitude
        ) {

            if (editLatitude) {

                editLatitude.value =
                    Number(latitude).toFixed(7);

            }


            if (editLongitude) {

                editLongitude.value =
                    Number(longitude).toFixed(7);

            }

        }


        /*
        |--------------------------------------------------------------------------
        | EDIT - LOAD DATA
        |--------------------------------------------------------------------------
        */

        async function loadEditData(
            laporanId
        ) {

            try {

                const response =
                    await fetch(
                        `/admin/kelola_laporan/${laporanId}`,
                        {
                            method: 'GET',

                            headers: {
                                'Accept':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );


                if (!response.ok) {

                    throw new Error(
                        'Gagal mengambil data laporan.'
                    );
                }


                const data =
                    await response.json();


                if (editUser) {
                    editUser.value =
                        data.user ?? '';
                }

                if (editRuangan) {
                    editRuangan.value =
                        data.ruangan ?? '';
                }

                if (editLatitude) {

                    editLatitude.value =
                        data.latitude ?? '';

                }


                if (editLongitude) {

                    editLongitude.value =
                        data.longitude ?? '';

                }


                if (editStatus) {

                    editStatus.value =
                        data.status ?? 'menunggu';

                }


                if (editKeterangan) {

                    editKeterangan.value =
                        data.keterangan ?? '';

                }


                /*
                |--------------------------------------------------------------------------
                | INITIALIZE MAP
                |--------------------------------------------------------------------------
                */

                initializeEditMap(
                    data.latitude,
                    data.longitude
                );


                if (
                    data.foto &&
                    editFotoPreview
                ) {

                    editFotoPreview.src =
                        `{{ asset('storage') }}/${data.foto}`;

                    editFotoPreview.style.display =
                        'block';

                } else if (editFotoPreview) {

                    editFotoPreview.src = '';

                    editFotoPreview.style.display =
                        'none';
                }


                if (editForm) {

                    editForm.action =
                        `/admin/kelola_laporan/${laporanId}`;
                }

            } catch (error) {

                console.error(
                    'Edit Laporan Error:',
                    error
                );

                alert(
                    'Gagal mengambil data laporan.'
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | EDIT - OPEN
        |--------------------------------------------------------------------------
        */

        if (editModal) {

            editModal.addEventListener(
                'show.bs.modal',
                function (event) {

                    const button =
                        event.relatedTarget;

                    const laporanId =
                        button?.getAttribute(
                            'data-laporan-id'
                        );

                    if (!laporanId) {
                        return;
                    }

                    loadEditData(
                        laporanId
                    );
                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE MODAL
        |--------------------------------------------------------------------------
        */

        const deleteModal =
            document.getElementById(
                'deleteKelolaLaporanModal'
            );

        const deleteForm =
            document.getElementById(
                'deleteKelolaLaporanForm'
            );


        /*
        |--------------------------------------------------------------------------
        | DELETE - OPEN
        |--------------------------------------------------------------------------
        */

        if (deleteModal) {

            deleteModal.addEventListener(
                'show.bs.modal',
                function (event) {

                    const button =
                        event.relatedTarget;

                    if (!button) {
                        return;
                    }

                    const laporanId =
                        button.getAttribute(
                            'data-laporan-id'
                        );

                    if (!laporanId) {
                        return;
                    }

                    if (deleteForm) {

                        deleteForm.action =
                            `/admin/kelola_laporan/${laporanId}`;
                    }
                }
            );
        }

    }

);

</script>
