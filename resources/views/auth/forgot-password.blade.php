<x-guest-layout>
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-2">Forgot Password</h4>
          <p class="text-muted">Enter your email and we’ll send you a reset link.</p>
          <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="email">Email</label>
              <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required>
              @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button class="btn btn-primary w-100">Email Password Reset Link</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>