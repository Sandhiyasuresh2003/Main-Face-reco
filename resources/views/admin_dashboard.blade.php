<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <!-- Custom Css -->
    <link rel="stylesheet" href="style.css">
    <link href="{{ asset('css/studentform.css') }}" rel="stylesheet">
    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <!-- face-api.js -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Navbar top -->
    <div class="navbar-top">
        <div class="title">
            <h1>Profile</h1>
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
    
    <!-- Profile Information Form -->
    <div class="profile-info">
        <form id="profileForm" method="POST" action="{{ route('store.admin.profile') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="student_name">Name:</label>
                <input type="text" name="student_name" id="student_name" value="{{ old('student_name', $user->username) }}" required>
            </div>
            <div class="form-group">
                <label for="student_email">Email:</label>
                <input type="email" name="student_email" id="student_email" value="{{ old('student_email', $user->email) }}" required>
            </div>
            <div class="form-group">
                <label for="reg_no">Registration Number:</label>
                <input type="text" name="reg_no" id="reg_no" value="{{ old('reg_no', $user->reg_no) }}" required>
            </div>
            <div class="form-group">
                <label for="image">Upload Photo:</label>
                <input type="file" name="image" id="image" required>
            </div>
            <button type="submit">Update Profile</button>
        </form>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
            @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Error Message -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    </div>
</body>
</html>
