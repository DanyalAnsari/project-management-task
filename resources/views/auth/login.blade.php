<x-guest-layout>
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3">Login</h4>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="email">Email</label>
              <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus>
              @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="password">Password</label>
              <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
              </div>
              <a href="{{ route('password.request') }}">Forgot password?</a>
            </div>
            <button class="btn btn-primary w-100">Log in</button>
          </form>
          <div class="text-center mt-3">
            <a href="{{ route('register') }}">Create an account</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>