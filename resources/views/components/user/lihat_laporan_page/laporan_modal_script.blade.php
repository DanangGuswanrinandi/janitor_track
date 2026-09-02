<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | ELEMENT
    |--------------------------------------------------------------------------
    */

    const viewModalElement =
        document.getElementById('viewLaporanModal');

    const editModalElement =
        document.getElementById('editLaporanModal');

    const deleteModalElement =
        document.getElementById('deleteLaporanModal');


    /*
    |--------------------------------------------------------------------------
    | URL ENDPOINT
    |--------------------------------------------------------------------------
    */

    const laporanShowUrl =
        "{{ url('/user/laporan/detail') }}";

    const laporanUpdateUrl =
        "{{ url('/user/laporan') }}";

    const laporanDeleteUrl =
        "{{ url('/user/laporan') }}";


    /*
    |--------------------------------------------------------------------------
    | CURRENT LOCATION - EDIT LAPORAN
    |--------------------------------------------------------------------------
    */

    const useCurrentEditLocation =
        document.getElementById(
            'useCurrentEditLocation'
        );

    const editLatitude =
        document.getElementById(
            'editLatitude'
        );

    const editLongitude =
        document.getElementById(
            'editLongitude'
        );

    const editLocationStatus =
        document.getElementById(
            'editLocationStatus'
        );


    if (useCurrentEditLocation) {

        useCurrentEditLocation.addEventListener(
            'click',
            function () {

                /*
                |------------------------------------------------------------------
                | CEK BROWSER SUPPORT
                |------------------------------------------------------------------
                */

                if (!navigator.geolocation) {

                    editLocationStatus.textContent =
                        'Browser tidak mendukung pengambilan lokasi.';

                    editLocationStatus.style.color =
                        '#dc3545';

                    return;

                }


                /*
                |------------------------------------------------------------------
                | STATUS
                |------------------------------------------------------------------
                */

                editLocationStatus.textContent =
                    'Sedang mengambil lokasi Anda...';

                editLocationStatus.style.color =
                    '#3478f6';


                useCurrentEditLocation.disabled =
                    true;


                /*
                |------------------------------------------------------------------
                | AMBIL LOKASI
                |------------------------------------------------------------------
                */

                navigator.geolocation.getCurrentPosition(

                    function (position) {

                        const latitude =
                            position.coords.latitude;

                        const longitude =
                            position.coords.longitude;


                        /*
                        |--------------------------------------------------------------
                        | MASUKKAN KE INPUT
                        |--------------------------------------------------------------
                        */

                        editLatitude.value =
                            latitude.toFixed(7);

                        editLongitude.value =
                            longitude.toFixed(7);


                        /*
                        |--------------------------------------------------------------
                        | STATUS BERHASIL
                        |--------------------------------------------------------------
                        */

                        editLocationStatus.textContent =
                            'Lokasi Anda berhasil diperbarui.';

                        editLocationStatus.style.color =
                            '#218838';


                        useCurrentEditLocation.disabled =
                            false;

                    },

                    function (error) {

                        console.error(
                            'Geolocation error:',
                            error
                        );


                        let message =
                            'Gagal mengambil lokasi.';


                        switch (error.code) {

                            case error.PERMISSION_DENIED:

                                message =
                                    'Izin lokasi ditolak. Silakan izinkan akses lokasi pada perangkat Anda.';

                                break;


                            case error.POSITION_UNAVAILABLE:

                                message =
                                    'Lokasi tidak tersedia. Pastikan GPS/lokasi perangkat aktif.';

                                break;


                            case error.TIMEOUT:

                                message =
                                    'Pengambilan lokasi terlalu lama. Silakan coba lagi.';

                                break;

                        }


                        editLocationStatus.textContent =
                            message;

                        editLocationStatus.style.color =
                            '#dc3545';


                        useCurrentEditLocation.disabled =
                            false;

                    },

                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }

                );

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | VIEW
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.laporan-action-view')
        .forEach(function (button) {

            button.addEventListener('click', async function () {

                const laporanId =
                    this.dataset.laporanId;


                /*
                |------------------------------------------------------------------
                | RESET MODAL
                |------------------------------------------------------------------
                */

                document
                    .getElementById('viewLaporanStatus')
                    .textContent = 'Memuat...';

                document
                    .getElementById('viewLaporanRuangan')
                    .textContent = 'Memuat...';

                document
                    .getElementById('viewLaporanLatitude')
                    .textContent = 'Memuat...';

                document
                    .getElementById('viewLaporanLongitude')
                    .textContent = 'Memuat...';

                document
                    .getElementById('viewLaporanKeterangan')
                    .textContent = 'Memuat...';

                document
                    .getElementById('viewLaporanWaktu')
                    .textContent = 'Memuat...';


                const foto =
                    document.getElementById(
                        'viewLaporanFoto'
                    );

                const noFoto =
                    document.getElementById(
                        'viewLaporanNoFoto'
                    );


                foto.style.display = 'none';
                foto.src = '';

                noFoto.style.display = 'inline';


                /*
                |------------------------------------------------------------------
                | REQUEST DATA
                |------------------------------------------------------------------
                */

                try {

                    const response =
                        await fetch(
                            `${laporanShowUrl}/${laporanId}`,
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


                    const result =
                        await response.json();


                    if (!result.success) {

                        throw new Error(
                            'Data laporan tidak ditemukan.'
                        );

                    }


                    const laporan =
                        result.data;


                    /*
                    |------------------------------------------------------------------
                    | ISI DATA MODAL
                    |------------------------------------------------------------------
                    */

                    document
                        .getElementById(
                            'viewLaporanStatus'
                        )
                        .textContent =
                            laporan.status ===
                            'terverifikasi'
                                ? 'Terverifikasi'
                                : 'Menunggu';


                    document
                        .getElementById(
                            'viewLaporanRuangan'
                        )
                        .textContent =
                            laporan.ruangan
                                ? `${laporan.ruangan.nama_ruangan} (${laporan.ruangan.kode_ruangan})`
                                : '-';


                    document
                        .getElementById(
                            'viewLaporanLatitude'
                        )
                        .textContent =
                            laporan.latitude ?? '-';


                    document
                        .getElementById(
                            'viewLaporanLongitude'
                        )
                        .textContent =
                            laporan.longitude ?? '-';


                    document
                        .getElementById(
                            'viewLaporanKeterangan'
                        )
                        .textContent =
                            laporan.keterangan ||
                            'Tidak ada keterangan';


                    /*
                    |------------------------------------------------------------------
                    | WAKTU
                    |------------------------------------------------------------------
                    */

                    if (laporan.created_at) {

                        const tanggal =
                            new Date(
                                laporan.created_at
                            );


                        document
                            .getElementById(
                                'viewLaporanWaktu'
                            )
                            .textContent =
                                tanggal.toLocaleString(
                                    'id-ID',
                                    {
                                        dateStyle:
                                            'long',
                                        timeStyle:
                                            'short'
                                    }
                                );

                    } else {

                        document
                            .getElementById(
                                'viewLaporanWaktu'
                            )
                            .textContent = '-';

                    }


                    /*
                    |------------------------------------------------------------------
                    | FOTO
                    |------------------------------------------------------------------
                    */

                    if (laporan.foto_kondisi) {

                        foto.src =
                            "{{ asset('storage') }}/" +
                            laporan.foto_kondisi;

                        foto.style.display =
                            'block';

                        noFoto.style.display =
                            'none';

                    }


                } catch (error) {

                    console.error(
                        'View laporan:',
                        error
                    );


                    document
                        .getElementById(
                            'viewLaporanStatus'
                        )
                        .textContent =
                            'Gagal memuat data laporan.';

                }

            });

        });


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.laporan-action-edit')
        .forEach(function (button) {

            button.addEventListener('click', async function () {

                const laporanId =
                    this.dataset.laporanId;


                /*
                |------------------------------------------------------------------
                | SIMPAN ID
                |------------------------------------------------------------------
                */

                editModalElement.dataset.laporanId =
                    laporanId;


                /*
                |------------------------------------------------------------------
                | RESET FORM
                |------------------------------------------------------------------
                */

                document
                    .getElementById('editRuangan')
                    .value = 'Memuat...';

                document
                    .getElementById('editLatitude')
                    .value = '';

                document
                    .getElementById('editLongitude')
                    .value = '';

                document
                    .getElementById('editKeterangan')
                    .value = '';


                const fotoPreview =
                    document.getElementById(
                        'editLaporanFotoPreview'
                    );

                fotoPreview.src = '';
                fotoPreview.style.display =
                    'none';


                /*
                |------------------------------------------------------------------
                | REQUEST DATA
                |------------------------------------------------------------------
                */

                try {

                    const response =
                        await fetch(
                            `${laporanShowUrl}/${laporanId}`,
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


                    const result =
                        await response.json();


                    if (!result.success) {

                        throw new Error(
                            'Data laporan tidak ditemukan.'
                        );

                    }


                    const laporan =
                        result.data;


                    /*
                    |------------------------------------------------------------------
                    | ISI FORM
                    |------------------------------------------------------------------
                    */

                    document
                        .getElementById(
                            'editRuangan'
                        )
                        .value =
                            laporan.ruangan
                                ? `${laporan.ruangan.nama_ruangan} (${laporan.ruangan.kode_ruangan})`
                                : '-';


                    document
                        .getElementById(
                            'editLatitude'
                        )
                        .value =
                            laporan.latitude ?? '';


                    document
                        .getElementById(
                            'editLongitude'
                        )
                        .value =
                            laporan.longitude ?? '';


                    document
                        .getElementById(
                            'editKeterangan'
                        )
                        .value =
                            laporan.keterangan ?? '';

                    document
                        .getElementById('editLocationStatus')
                        .textContent =
                            'Lokasi laporan saat ini.';

                    document
                        .getElementById('editLocationStatus')
                        .style.color =
                            '#98a1b2';

                    document
                        .getElementById('useCurrentEditLocation')
                        .disabled = false;


                    /*
                    |------------------------------------------------------------------
                    | FOTO LAMA
                    |------------------------------------------------------------------
                    */

                    if (laporan.foto_kondisi) {

                        fotoPreview.src =
                            "{{ asset('storage') }}/" +
                            laporan.foto_kondisi;

                        fotoPreview.style.display =
                            'block';

                    }


                    /*
                    |------------------------------------------------------------------
                    | RESET INPUT FOTO
                    |------------------------------------------------------------------
                    */

                    document
                        .getElementById(
                            'editFoto'
                        )
                        .value = '';


                } catch (error) {

                    console.error(
                        'Edit laporan:',
                        error
                    );

                    alert(
                        'Gagal mengambil data laporan.'
                    );

                }

            });

        });


    /*
    |--------------------------------------------------------------------------
    | SUBMIT EDIT
    |--------------------------------------------------------------------------
    */

    const editForm =
        document.getElementById(
            'editLaporanForm'
        );


    if (editForm) {

        editForm.addEventListener(
            'submit',
            function (event) {

                const laporanId =
                    editModalElement.dataset.laporanId;


                if (!laporanId) {

                    event.preventDefault();

                    alert(
                        'ID laporan tidak ditemukan.'
                    );

                    return;

                }


                editForm.action =
                    `${laporanUpdateUrl}/${laporanId}`;

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.laporan-action-delete')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const laporanId =
                    this.dataset.laporanId;


                const deleteForm =
                    document.getElementById(
                        'deleteLaporanForm'
                    );


                if (!deleteForm) {
                    return;
                }


                deleteForm.action =
                    `${laporanDeleteUrl}/${laporanId}`;

            });

        });

        /*
|--------------------------------------------------------------------------
| BULK SELECT LAPORAN
|--------------------------------------------------------------------------
*/

const selectAllLaporan =
    document.getElementById(
        'selectAllLaporan'
    );

const allLaporanCheckboxes =
    document.querySelectorAll(
        '.laporan-checkbox'
    );


/*
|--------------------------------------------------------------------------
| CHECKBOX YANG BOLEH DIPILIH
|--------------------------------------------------------------------------
*/

const laporanCheckboxes =
    document.querySelectorAll(
        '.laporan-checkbox:not(:disabled)'
    );


/*
|--------------------------------------------------------------------------
| CHECKBOX YANG TERKUNCI
|--------------------------------------------------------------------------
*/

const disabledLaporanCheckboxes =
    document.querySelectorAll(
        '.laporan-checkbox:disabled'
    );


/*
|--------------------------------------------------------------------------
| PAKSA CHECKBOX TERVERIFIKASI TIDAK TERPILIH
|--------------------------------------------------------------------------
*/

disabledLaporanCheckboxes.forEach(
    function (checkbox) {

        checkbox.checked = false;

    }
);


/*
|--------------------------------------------------------------------------
| UPDATE SELECT ALL
|--------------------------------------------------------------------------
*/

function updateSelectAllLaporan() {

    if (!selectAllLaporan) {
        return;
    }


    const total =
        laporanCheckboxes.length;


    const checked =
        document.querySelectorAll(
            '.laporan-checkbox:not(:disabled):checked'
        ).length;


    if (total === 0) {

        selectAllLaporan.checked =
            false;

        selectAllLaporan.indeterminate =
            false;

        selectAllLaporan.disabled =
            true;

        return;

    }


    selectAllLaporan.disabled =
        false;


    selectAllLaporan.checked =
        checked === total;


    selectAllLaporan.indeterminate =
        checked > 0 &&
        checked < total;

}


/*
|--------------------------------------------------------------------------
| SELECT ALL
|--------------------------------------------------------------------------
*/

if (selectAllLaporan) {

    selectAllLaporan.addEventListener(
        'change',
        function () {

            const shouldCheck =
                this.checked;


            /*
            |--------------------------------------------------------------
            | CHECKBOX YANG BOLEH DIPILIH
            |--------------------------------------------------------------
            */

            laporanCheckboxes.forEach(
                function (checkbox) {

                    checkbox.checked =
                        shouldCheck;

                }
            );


            /*
            |--------------------------------------------------------------
            | PASTIKAN YANG DISABLED TIDAK TERPILIH
            |--------------------------------------------------------------
            */

            disabledLaporanCheckboxes.forEach(
                function (checkbox) {

                    checkbox.checked =
                        false;

                }
            );


            updateSelectAllLaporan();

        }
    );

}


/*
|--------------------------------------------------------------------------
| INDIVIDUAL CHECKBOX
|--------------------------------------------------------------------------
*/

laporanCheckboxes.forEach(
    function (checkbox) {

        checkbox.addEventListener(
            'change',
            function () {

                updateSelectAllLaporan();

            }
        );

    }
);


/*
|--------------------------------------------------------------------------
| INITIALIZE
|--------------------------------------------------------------------------
*/

updateSelectAllLaporan();

        });

</script>
