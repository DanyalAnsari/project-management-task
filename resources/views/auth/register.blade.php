<x-guest-layout>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3">Register</h4>
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="name">Name</label>
                <input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label" for="email">Email</label>
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label" for="password">Password</label>
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
              </div>
            </div>
            <button class="btn btn-primary w-100 mt-3">Register</button>
          </form>
          <div class="text-center mt-3">
            <a href="{{ route('login') }}">Already registered?</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>