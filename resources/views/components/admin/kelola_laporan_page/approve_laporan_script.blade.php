<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | ELEMENT
    |--------------------------------------------------------------------------
    */

    const modalElement =
        document.getElementById('approveLaporanModal');

    const userElement =
        document.getElementById('approveLaporanUser');

    const createdAtElement =
        document.getElementById('approveLaporanCreatedAt');

    const updatedAtElement =
        document.getElementById('approveLaporanUpdatedAt');

    const fotoElement =
        document.getElementById('approveLaporanFoto');

    const fotoEmptyElement =
        document.getElementById('approveLaporanFotoEmpty');

    const ruanganElement =
        document.getElementById('approveLaporanRuangan');

    const kodeRuanganElement =
        document.getElementById('approveLaporanKodeRuangan');

    const latitudeLaporanElement =
        document.getElementById('approveLaporanLatitude');

    const longitudeLaporanElement =
        document.getElementById('approveLaporanLongitude');

    const latitudeRuanganElement =
        document.getElementById('approveRuanganLatitude');

    const longitudeRuanganElement =
        document.getElementById('approveRuanganLongitude');

    const validationTextElement =
        document.getElementById('approveLaporanValidationText');

    const distanceElement =
        document.getElementById('approveLaporanDistance');

    const approveButton =
        document.getElementById('approveLaporanButton');


    /*
    |--------------------------------------------------------------------------
    | RESET MODAL
    |--------------------------------------------------------------------------
    */

    function resetModal() {

        userElement.textContent = '-';

        createdAtElement.textContent = '-';

        updatedAtElement.textContent = '-';

        ruanganElement.textContent = '-';

        kodeRuanganElement.textContent = '-';

        latitudeLaporanElement.textContent = '-';

        longitudeLaporanElement.textContent = '-';

        latitudeRuanganElement.textContent = '-';

        longitudeRuanganElement.textContent = '-';


        /*
        |--------------------------------------------------------------------------
        | RESET FOTO
        |--------------------------------------------------------------------------
        */

        fotoElement.src = '';

        fotoElement.style.display = 'none';

        fotoEmptyElement.style.display = 'block';


        /*
        |--------------------------------------------------------------------------
        | RESET VALIDASI
        |--------------------------------------------------------------------------
        */

        validationTextElement.textContent =
            'Memeriksa koordinat...';

        validationTextElement.style.color =
            '#5f6875';

        distanceElement.textContent = '';


        /*
        |--------------------------------------------------------------------------
        | RESET BUTTON
        |--------------------------------------------------------------------------
        */

        approveButton.disabled = true;

    }


    /*
    |--------------------------------------------------------------------------
    | AMBIL DATA LAPORAN
    |--------------------------------------------------------------------------
    */

    async function loadApprovalData(laporanId) {

        resetModal();


        try {

            const response = await fetch(
                `/admin/kelola_laporan/${laporanId}/approval-data`,
                {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }
            );


            /*
            |--------------------------------------------------------------------------
            | CEK RESPONSE
            |--------------------------------------------------------------------------
            */

            if (!response.ok) {

                throw new Error(
                    'Gagal mengambil data laporan.'
                );

            }


            const data =
                await response.json();


            /*
            |--------------------------------------------------------------------------
            | USER
            |--------------------------------------------------------------------------
            */

            userElement.textContent =
                data.user ?? '-';


            /*
            |--------------------------------------------------------------------------
            | WAKTU
            |--------------------------------------------------------------------------
            */

            createdAtElement.textContent =
                data.created_at ?? '-';

            updatedAtElement.textContent =
                data.updated_at ?? '-';


            /*
            |--------------------------------------------------------------------------
            | FOTO
            |--------------------------------------------------------------------------
            */

            if (data.foto) {

                fotoElement.src =
                    `{{ asset('storage') }}/${data.foto}`;

                fotoElement.style.display =
                    'block';

                fotoEmptyElement.style.display =
                    'none';

            } else {

                fotoElement.src = '';

                fotoElement.style.display =
                    'none';

                fotoEmptyElement.style.display =
                    'block';

            }


            /*
            |--------------------------------------------------------------------------
            | RUANGAN
            |--------------------------------------------------------------------------
            */

            ruanganElement.textContent =
                data.ruangan ?? '-';

            kodeRuanganElement.textContent =
                data.kode_ruangan ?? '-';


            /*
            |--------------------------------------------------------------------------
            | KOORDINAT LAPORAN
            |--------------------------------------------------------------------------
            */

            latitudeLaporanElement.textContent =
                data.latitude_laporan ?? '-';

            longitudeLaporanElement.textContent =
                data.longitude_laporan ?? '-';


            /*
            |--------------------------------------------------------------------------
            | KOORDINAT MASTER RUANGAN
            |--------------------------------------------------------------------------
            */

            latitudeRuanganElement.textContent =
                data.latitude_ruangan ?? '-';

            longitudeRuanganElement.textContent =
                data.longitude_ruangan ?? '-';


            /*
            |--------------------------------------------------------------------------
            | HASIL VALIDASI RADIUS
            |--------------------------------------------------------------------------
            */

            if (data.is_valid) {

                /*
                |--------------------------------------------------------------------------
                | KOORDINAT SESUAI
                |--------------------------------------------------------------------------
                */

                validationTextElement.textContent =
                    'Laporan valid. Koordinat sesuai dengan lokasi ruangan.';

                validationTextElement.style.color =
                    '#218838';

                distanceElement.textContent =
                    `Jarak: ${data.distance} meter`;


            } else {

                /*
                |--------------------------------------------------------------------------
                | KOORDINAT TIDAK SESUAI
                |--------------------------------------------------------------------------
                */

                validationTextElement.textContent =
                    'Koordinat tidak sesuai dengan lokasi ruangan.';

                validationTextElement.style.color =
                    '#dc3545';

                distanceElement.textContent =
                    `Jarak: ${data.distance} meter (maksimal 3 meter)`;

            }


            /*
            |--------------------------------------------------------------------------
            | ADMIN TETAP BOLEH APPROVE
            |--------------------------------------------------------------------------
            */

            approveButton.disabled = false;


            /*
            |--------------------------------------------------------------------------
            | SIMPAN ID LAPORAN
            |--------------------------------------------------------------------------
            */

            approveButton.dataset.laporanId =
                data.id;


        } catch (error) {

            console.error(
                'Approval Data Error:',
                error
            );


            validationTextElement.textContent =
                'Gagal mengambil data laporan.';

            validationTextElement.style.color =
                '#dc3545';


            distanceElement.textContent =
                'Silakan coba lagi.';


            approveButton.disabled =
                true;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | EVENT MODAL DIBUKA
    |--------------------------------------------------------------------------
    */

    if (modalElement) {

        modalElement.addEventListener(
            'show.bs.modal',
            function (event) {

                /*
                |--------------------------------------------------------------------------
                | TOMBOL YANG MEMBUKA MODAL
                |--------------------------------------------------------------------------
                */

                const button =
                    event.relatedTarget;


                if (!button) {

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | AMBIL ID LAPORAN
                |--------------------------------------------------------------------------
                */

                const laporanId =
                    button.getAttribute(
                        'data-laporan-id'
                    );


                if (!laporanId) {

                    console.error(
                        'ID laporan tidak ditemukan.'
                    );

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | LOAD DATA
                |--------------------------------------------------------------------------
                */

                loadApprovalData(
                    laporanId
                );

            }
        );

    }

});

</script>
