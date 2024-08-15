<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar with Sign Out</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <input type="checkbox" id="open-sidebar">
        <label for="open-sidebar" class="bars">
            <i class="fas fa-bars"></i>
        </label>
        <div class="sidebar">
            <div class="logo">
                <a href="#">V.V.V College</a>
                <label for="open-sidebar" class="times">
                    <i class="fas fa-times"></i>
                </label>
            </div>
            <div class="nav">
                <ul>
                    <li class="nav-list">
                        <a href="{{ route('profile') }}">
                            <i class="fas fa-user nav-link-icon"></i>
                            Profile
                        </a>
                    </li>
                    @if ($user->hasRole('student'))
                    <li class="nav-list">
                        <a href="{{ route('stud.attendance') }}">
                            <i class="fas fa-camera nav-link-icon"></i>
                            Face Capture
                        </a>
                    </li>
                    <li class="nav-list">
                        <a href="{{ route('attendance.history') }}">
                            <i class="fas fa-calendar-check nav-link-icon"></i>
                            Attendance History
                        </a>
                    </li>
                    @endif
                    <li class="nav-list">
                        <a href="#">
                            <i class="fas fa-cogs nav-link-icon"></i>
                            Settings
                        </a>
                    </li>
                    <li class="nav-list">
                        <a href="#">
                            <i class="fas fa-bell nav-link-icon"></i>
                            Notifications
                        </a>
                    </li>
                    <li class="nav-list">
                        <a href="{{ route('admin.profile')}}">
                            <i class="fas fa-comments nav-link-icon"></i>
                            Admin
                        </a>
                    </li>
                    <li class="nav-list">
                        <a href="#">
                            <i class="fas fa-question-circle nav-link-icon"></i>
                            Reports
                        </a>
                    </li>
                    <li class="nav-list">
                        <a href="#">
                            <i class="fas fa-phone-volume nav-link-icon"></i>
                            Contact Us
                        </a>
                    </li>
                    <!-- Sign Out Button -->
                    <li class="nav-list">
                        <form id="signOutForm" method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" id="signOutButton" style="background: none; border: none; cursor: pointer;">
                                <i class="fas fa-sign-out-alt nav-link-icon"></i>
                                Sign Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="social-media">
                <a href="#">
                    <i class="fab fa-facebook-f social-icon"></i>
                </a>
                <a href="#">
                    <i class="fab fa-twitter social-icon"></i>
                </a>
                <a href="#">
                    <i class="fab fa-instagram social-icon"></i>
                </a>
                <a href="#">
                    <i class="fab fa-youtube social-icon"></i>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
