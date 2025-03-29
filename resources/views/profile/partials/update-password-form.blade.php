<section>
    <div class="row">
        <div class="col-12">
            <h3 class="mb-3">Update Password</h3>
            <p class="">Ensure your account is using a long, random password to stay secure.</p>
        </div>

        <div class="mt-2 col-12">
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="d-flex align-items-center row">
                    <label for="update_password_current_password" class="col-4 fw-bold">Current Password</label>
                    <div>
                        <x-text-input id="update_password_current_password" name="current_password" type="password"
                            class="mt-1 form-control col-8" autocomplete="current-password" />
                    </div>
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger" />
                </div>

                <div class="d-flex align-items-center row">
                    <label for="update_password_password" class="col-4 fw-bold mt-3">New Password</label>
                    <div>
                        <x-text-input id="update_password_password" name="password" type="password"
                            class="mt-1 form-control form-control-profile col-8" autocomplete="new-password" />
                    </div>
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
                </div>

                <div class="d-flex align-items-center row">
                    <label for="update_password_password_confirmation" class="col-4 fw-bold mt-3">Confirm
                        Password</label>
                    <div>
                        <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                            type="password" class="mt-1 form-control form-control-profile col-8"
                            autocomplete="new-password" />
                    </div>
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />
                </div>

                <div class="d-flex gap-4 align-items-center mt-3">
                    <button class="btn btn-primary">Save</button>
                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-success mt-3">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
