import 'bootstrap/dist/css/bootstrap.min.css';
import * as bootstrap from 'bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';
import QRCode from 'qrcode';
import { Html5Qrcode } from 'html5-qrcode';
import Swal from 'sweetalert2';

import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

window.bootstrap = bootstrap;
window.L = L;
window.QRCode = QRCode;
window.Html5Qrcode = Html5Qrcode;
window.Swal = Swal;
