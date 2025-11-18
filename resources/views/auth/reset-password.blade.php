<x-guest-layout>
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3">Reset Password</h4>
          <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ request()->route('token') }}">
            <div class="mb-3">
              <label class="form-label" for="email">Email</label>
              <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email', request('email')) }}" required>
              @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="password">Password</label>
              <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="password_confirmation">Confirm Password</label>
              <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
            </div>
            <button class="btn btn-primary w-100">Reset Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>