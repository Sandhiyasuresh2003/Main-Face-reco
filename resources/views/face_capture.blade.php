<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <!-- Custom Css -->
    <link rel="stylesheet" href="style.css">
    <link href="{{ asset('css/attendance.css') }}" rel="stylesheet">
    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <!-- face-api.js -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Navbar top -->
    <div class="navbar-top">
        <div class="title">
            <h1>Attendance</h1>
        </div>

        <!-- Navbar -->
        <ul>
            <li>
                <a href="#sign-out">
                    <i class="fa fa-sign-out-alt fa-2x"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- Sidenav -->
    <div class="sidenav">
        <div class="profile">
            <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" width="100" height="100">
            <div class="name">
                {{$user->username}}
            </div>
            <div class="job">
                {{$user->class}}
            </div>
        </div>
    </div>
    
    <!-- HTML Structure -->
<div class="camera">
    <video id="video" autoplay></video>
    <button id="capture-btn">Capture Image</button>
</div>

<!-- Form to Submit Captured Image -->
<form id="imageForm" method="POST" action="{{ route('stud.mark.attendance') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="captured_image" id="captured_image_input" style="display:none;">
    <button type="submit">Submit Image</button>
</form>

<!-- Display Validation Errors -->
@if ($errors->has('captured_image'))
    <div class="alert alert-danger">
        {{ $errors->first('captured_image') }}
    </div>
@endif

<script>
    // Access the user's webcam
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            const video = document.getElementById('video');
            video.srcObject = stream;
            video.play();
        })
        .catch(error => {
            console.error('Error accessing the webcam:', error);
        });

    // Capture the image when the capture button is clicked
    document.getElementById('capture-btn').addEventListener('click', function(event) {
        event.preventDefault();

        const video = document.getElementById('video');
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Convert the captured image to a Blob
        canvas.toBlob(function(blob) {
            // Create a file from the Blob
            const file = new File([blob], 'captured_image.png', { type: 'image/png' });

            // Append the file to the hidden file input
            const input = document.getElementById('captured_image_input');
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            input.files = dataTransfer.files;

            // Submit the form
            document.getElementById('imageForm').submit();
        }, 'image/png');
    });
</script>

</body>
</html>
