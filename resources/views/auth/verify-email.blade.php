<x-app-layout>
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-2">Email Verification</h4>
          <p class="text-muted">We have sent a verification link to your email. If you didn’t receive it, request another below.</p>

          @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">A new verification link has been sent to your email address.</div>
          @endif

          <div class="d-flex gap-2">
            <form method="POST" action="{{ route('verification.send') }}">@csrf
              <button class="btn btn-primary">Resend Verification Email</button>
            </form>
            <form method="POST" action="{{ route('logout') }}">@csrf
              <button class="btn btn-outline-secondary">Log Out</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>