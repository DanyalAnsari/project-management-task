<x-guest-layout>
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-2">Confirm Password</h4>
          <p class="text-muted">This is a secure area. Please confirm your password.</p>
          <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="password">Password</label>
              <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button class="btn btn-primary w-100">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>