<x-app-layout>
  <div class="row g-3">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="mb-3">Profile Information</h5>
          <form method="post" action="{{ route('profile.update') }}">
            @csrf @method('patch')
            <div class="mb-3">
              <label class="form-label" for="name">Name</label>
              <input id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name', $user->name) }}" required>
              @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="email">Email</label>
              <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email', $user->email) }}" required>
              @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="mb-3">Update Password</h5>
          <form method="post" action="{{ route('password.update') }}">
            @csrf @method('put')
            <div class="mb-3">
              <label class="form-label" for="current_password">Current Password</label>
              <input id="current_password" type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" autocomplete="current-password">
              @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="password">New Password</label>
              <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="password_confirmation">Confirm Password</label>
              <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
            </div>
            <button class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>

      <div class="card shadow-sm mt-3">
        <div class="card-body">
          <h5 class="mb-2 text-danger">Delete Account</h5>
          <p class="text-muted">Once your account is deleted, all its resources and data will be permanently deleted.</p>
          <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Delete account?');">
            @csrf @method('delete')
            <button class="btn btn-outline-danger">Delete Account</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>