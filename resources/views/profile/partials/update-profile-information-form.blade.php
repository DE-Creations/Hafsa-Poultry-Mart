<section>
    <div class="row">
        <div class="col-12">
            <h3 class="mb-3">Profile Information</h3>
            <p class="">Update your account's profile information and email address.</p>
        </div>

        <div class="mt-2 col-12">
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="d-flex align-items-center row">
                    <label for="name" class="col-3 fw-bold">Name</label>
                    <div>
                        <x-text-input id="name" name="name" type="text"
                            class="mt-1 form-control form-control-profile col-9" :value="old('name', $user->name)" autofocus
                            autocomplete="name" required />
                    </div>
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('name')" />
                </div>

                <div class="d-flex align-items-center row mt-3">
                    <label for="email" class="col-3 fw-bold">Email</label>
                    <div>
                        <x-text-input id="email" name="email" type="email"
                            class="mt-1 form-control form-control-profile col-9" :value="old('email', $user->email)"
                            autocomplete="username" required />
                    </div>
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800 text-danger">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="d-flex gap-4 align-items-center mt-3">
                    <button class="btn btn-primary">Save</button>
                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-success mt-3">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
