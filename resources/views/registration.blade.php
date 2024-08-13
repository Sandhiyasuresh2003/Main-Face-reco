<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div id="gradient-bg">
        <div class="gradient-container">
            <div class="gradient1"></div>
            <div class="gradient2"></div>
            <div class="gradient3"></div>
            <div class="gradient4"></div>
            <div class="gradient5"></div>
        </div>
    </div>

    <!-- Form -->
    <div id="form-container">
        <h1 class="title">Sign up</h1>
        <form method="POST" action="{{ route('stud.register') }}" enctype="multipart/form-data">
            @csrf
            <div class="label">Name</div>
            <input type="text" name="name" required />
            @if ($errors->has('name'))
                <div class="error">{{ $errors->first('name') }}</div>
            @endif
            
            <div class="label">Email</div>
            <input type="email" name="email" required />
            @if ($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif
            
            <div class="label">Password</div>
            <input type="password" name="password" required />
            @if ($errors->has('password'))
                <div class="error">{{ $errors->first('password') }}</div>
            @endif

            <div class="label">Phone Number</div>
            <input type="number" name="phone_number" required />
            @if ($errors->has('phone_number'))
                <div class="error">{{ $errors->first('phone_number') }}</div>
            @endif

            <div class="label">Class</div>
            <input type="string" name="class" required />
            @if ($errors->has('class'))
                <div class="error">{{ $errors->first('class') }}</div>
            @endif

            <div class="label">Register Number</div>
            <input type="number" name="reg_no" required />
            @if ($errors->has('reg_no'))
                <div class="error">{{ $errors->first('reg_no') }}</div>
            @endif
            
            <div class="label">Profile Picture</div>
            <input type="file" name="profile_picture" />
            @if ($errors->has('profile_picture'))
                <div class="error">{{ $errors->first('profile_picture') }}</div>
            @endif
            
            <input type="submit" class="submit" value="Sign up" />
        </form>
        <div class="label msg">◆ Already have an account? <a href="{{ route('login.form') }}">Sign in</a></div>
    </div>
</body>
</html>
