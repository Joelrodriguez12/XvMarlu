@extends('layouts.app')

@section('content')
<div class="admin-login-container">
    <div class="login-card">
        <h2>Admin Login</h2>
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</div>

<style>
.admin-login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-card {
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
}

.login-card h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

.alert-error {
    background: #f44336;
    color: white;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group input {
    width: 100%;
    padding: 15px;
    border: 2px solid #e0e0e0;
    border-radius: 5px;
    font-size: 1rem;
}

.login-btn {
    width: 100%;
    padding: 15px;
    background: #d4a574;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1.1rem;
    cursor: pointer;
}

.login-btn:hover {
    background: #b8935f;
}
</style>
@endsection