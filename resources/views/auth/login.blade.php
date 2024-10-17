<!-- Centered Login Form with Enhanced Styling -->
<div style="display: flex; justify-content: center; align-items: center; height: 100vh; background: linear-gradient(135deg, #fbc2eb, #a18cd1);">
    <div style="background-color: #fff; padding: 40px; width: 400px; border-radius: 15px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);">
        <h2 style="text-align: center; margin-bottom: 25px; font-size: 32px; color: #6a1b9a; font-family: 'Segoe UI', sans-serif; letter-spacing: 1px;">Login</h2>

        <!-- Error Message -->
        @if($errors->any())
            <div style="color: #d32f2f; margin-bottom: 15px; text-align: center;">
                <strong>{{ $errors->first() }}</strong>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <!-- Email Field -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #7b1fa2;">Email</label>
                <input type="email" name="email" style="width: 100%; padding: 12px; border: 2px solid #d1c4e9; border-radius: 10px; font-size: 16px;" placeholder="Enter your email" required>
            </div>

            <!-- Password Field -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #7b1fa2;">Password</label>
                <input type="password" name="password" style="width: 100%; padding: 12px; border: 2px solid #d1c4e9; border-radius: 10px; font-size: 16px;" placeholder="Enter your password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" style="width: 100%; padding: 12px; background-color: #8e24aa; color: white; border: none; border-radius: 10px; cursor: pointer; font-size: 18px; transition: background-color 0.3s;">
                Login
            </button>
        </form>
    </div>
</div>
