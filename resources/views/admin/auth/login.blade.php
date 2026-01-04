

@extends('admin.layouts.plain')

@section('content')
<div class="login-header text-center mb-4">
    <div class="mb-4">
        <img src="{{ asset('assets/img/pharmacy_logo.jpg') }}" alt="Logo" class="img-fluid rounded-circle shadow-lg" style="width: 100px; height: 100px; object-fit: contain; background: #000;">
    </div>
    <h1 style="color: var(--dark); font-weight: 700; margin-bottom: 0.5rem;">Pharmacy MS</h1>
    <p class="text-muted">Secure Login Panel</p>
</div>

@if (session('login_error'))
<x-alerts.danger :error="session('login_error')" />
@endif

<!-- Form -->
<form action="{{route('login')}}" method="post">
	@csrf
	<div class="form-group mb-3">
		<input class="form-control" name="email" type="text" placeholder="Email Address" style="padding: 12px 15px; border-radius: 10px;">
	</div>
	<div class="form-group mb-3">
		<input class="form-control" name="password" type="password" placeholder="Password" style="padding: 12px 15px; border-radius: 10px;">
	</div>
	<div class="form-group mb-3">
		<button class="btn btn-primary btn-block text-white" type="submit" style="padding: 12px; border-radius: 10px; font-weight: 600; font-size: 1rem;">Login</button>
	</div>
</form>
<!-- /Form -->

<div class="text-center mt-3">
    <a href="{{route('password.request')}}" class="text-muted hover-primary">Forgot Password?</a>
</div>
<div class="text-center mt-2 text-muted">
    Don’t have an account? <a href="{{route('register')}}" class="text-primary font-weight-bold">Register</a>
</div>
@endsection