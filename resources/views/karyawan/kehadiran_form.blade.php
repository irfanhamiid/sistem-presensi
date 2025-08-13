@extends('layouts.app')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Presensi Kehadiran</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Data</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Presensi Kehadiran</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <button id="openCameraBtn" class="btn btn-primary">Buka Kamera</button>
                                    <button id="switchCameraBtn" class="btn btn-success">Ganti Kamera</button>
                                    <video id="camera" width="400" height="300" autoplay
                                        style="display:none;"></video>
                                    <canvas id="canvas" width="400" height="300" style="display:none;"></canvas>
                                    <span style="color: red">Ketuk pada gambar untuk mengambil gambar</span><br>
                                    <img id="photo" src="" alt="Photo" width="400" height="300">

                                </div>
                                <form action="{{ $action }}" enctype="multipart/form-data" method="POST">
                                    @csrf

                                    <input type="hidden" id="photoInput" name="photo">
                                    <input type="hidden" id="location" name="location">
                                    <input type="hidden" id="locations" name="locations">
                                    <input type="hidden" id="timestampInput" name="waktu">
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <textarea name="keterangan" class="form-control" id="" cols="30" rows="3"
                                            placeholder="Tidak Wajib Diisi"></textarea>
                                    </div>
                                    <input type="hidden" name="id_karyawan" value="{{ Auth::user()->id_karyawan }}"
                                        id="">
                                    <input type="hidden" name="tipe" value="{{ $status }}" id="">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="{{ route('karyawan-dashboard') }}"
                                            class="btn btn-success btn-border">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        function PreviewImage() {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("upload").files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("uploadPreview").src = oFREvent.target.result;
            };
        };
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdPXISeUbnSiMucaCm1v7DCcXctxCULb0"></script>
    <script>
        const openCameraBtn = document.getElementById('openCameraBtn');
        const switchCameraBtn = document.getElementById('switchCameraBtn');
        const video = document.getElementById('camera');
        const canvas = document.getElementById('canvas');
        const photo = document.getElementById('photo');
        const photoInput = document.getElementById('photoInput');
        const locationInput = document.getElementById('location');

        let stream = null;
        let currentFacingMode = "user"; // Default ke kamera depan

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;

                    // Reverse geocoding to get the address
                    const geocoder = new google.maps.Geocoder();
                    const latLng = new google.maps.LatLng(lat, lon);
                    geocoder.geocode({
                        'latLng': latLng
                    }, (results, status) => {
                        if (status === 'OK') {
                            const address = results[0].formatted_address;
                            locationInput.value = `${lat},${lon},${address}`;
                        } else {
                            locationInput.value = `${lat},${lon}`;
                        }
                    });
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        async function startCamera() {
            if (stream) {
                // Hentikan stream saat ini jika ada sebelum memulai yang baru
                stream.getTracks().forEach(track => track.stop());
            }

            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: currentFacingMode
                    }
                });
                video.srcObject = stream;
                video.style.display = 'block';
                getLocation();
            } catch (error) {
                console.error("Error accessing camera: ", error);
            }
        }

        // Ketika tombol buka kamera diklik
        openCameraBtn.addEventListener('click', () => {
            startCamera();
        });

        // Ketika tombol ganti kamera diklik
        switchCameraBtn.addEventListener('click', () => {
            currentFacingMode = currentFacingMode === "user" ? {
                exact: "environment"
            } : "user";
            startCamera();
        });

        // Fungsi untuk membungkus teks jika melebihi lebar canvas
        function wrapText(context, text, x, y, maxWidth, lineHeight) {
            const words = text.split(' ');
            let line = '';

            for (let n = 0; n < words.length; n++) {
                const testLine = line + words[n] + ' ';
                const metrics = context.measureText(testLine);
                const testWidth = metrics.width;
                if (testWidth > maxWidth && n > 0) {
                    context.fillText(line, x, y);
                    line = words[n] + ' ';
                    y += lineHeight;
                } else {
                    line = testLine;
                }
            }
            context.fillText(line, x, y);
        }

        // Fungsi untuk mengambil gambar
        video.addEventListener('click', async () => {
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth; // Set canvas width to match video
            canvas.height = video.videoHeight; // Set canvas height to match video
            canvas.style.display = 'block';
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Add text to the canvas
            const date = new Date();
            const dateString = `${date.toLocaleDateString()} at ${date.toLocaleTimeString()}`;
            const localFormatted = date.getFullYear() + "-" +
                String(date.getMonth() + 1).padStart(2, '0') + "-" +
                String(date.getDate()).padStart(2, '0') + " " +
                String(date.getHours()).padStart(2, '0') + ":" +
                String(date.getMinutes()).padStart(2, '0') + ":" +
                String(date.getSeconds()).padStart(2, '0');
            document.getElementById('timestampInput').value = localFormatted;
            const locationString = locationInput.value;

            context.font = '12px Arial';
            context.fillStyle = 'rgba(255, 255, 255, 0.8)'; // Set opacity to 80%
            context.textAlign = 'right';
            context.textBaseline = 'bottom';

            // Add location data in the desired order: time, lat/lon, address
            // Draw the time text on the canvas
            context.fillText(dateString, canvas.width - 10, canvas.height - 70); // Draw time text first

            // Draw the lat/lon text on the canvas
            const latLng = locationString.split(',');
            const lat = latLng[0];
            const lon = latLng[1];
            context.fillText(`${lat},${lon}`, canvas.width - 10, canvas.height - 50); // Draw lat/lon text

            // Use a geocoding API to get the address
            const apiUrl =
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&accept-language=id-ID`;
            const response = await fetch(apiUrl);
            const data = await response.json();
            const address = data.display_name;

            // Word-wrapping the address text
            const maxWidth = canvas.width - 20; // 10px padding on both sides
            const lineHeight = 14; // Height between lines
            wrapText(context, address, canvas.width - 10, canvas.height - 30, maxWidth, lineHeight);

            locationInput.value = data.display_name;

            const dataUrl = canvas.toDataURL('image/png');
            photo.src = dataUrl;
            photoInput.value = dataUrl;
            photo.style.display = 'block';

            // Hentikan streaming video setelah mengambil gambar
            stream.getTracks().forEach(track => track.stop());
            video.style.display = 'none';
        });
    </script>
@endsection
