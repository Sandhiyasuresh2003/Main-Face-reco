<!-- fontawesome -->
<html>
  <head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
  </head>
<div class="container">
  <input type="checkbox" id="open-sidebar">
  <label for="open-sidebar" class="bars">
    <i class="fas fa-bars"></i>
  </label>
  <div class="sidebar">
    <div class="logo">
      <a href="#">Sidebar Menu</a>
      <label for="open-sidebar" class="times">
        <i class="fas fa-times"></i>
      </label>
    </div>
    <div class="nav">
      <ul>
        <li class="nav-list">
          <a href="#">
            <i class="fas fa-home nav-link-icon"></i>
            Home
          </a>
        </li>
        <li class="nav-list">
          <a href="{{ route('stud.profile') }}">
            <i class="fas fa-sliders-h nav-link-icon"></i>
            profile
          </a>
        </li>
        <li class="nav-list">
          <a href="{{ route('stud.attendance')}}">
            <i class="fas fa-comments nav-link-icon"></i>
            Mark Attendance
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
</html>