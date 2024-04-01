<form action="/2auth/enable" method="post" class="space-y-6">
    @csrf
    @method("PUT")
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Set 2FA ') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is act ..............., all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-primary-button
    {{-- ternary condition to switch button text --}}
        
    >{{ $user->double_auth ? __('Desactivate 2FA   ') : __('Activate 2FA   ')  }}</x-primary-button>

</form>
