<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Check your email  and inser  the  2fa code.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route("2fa.valide") }}">
        @csrf
        @method('PUT')
        <!-- Email Address -->
        <div>
            <x-input-label for="code" :value="__('2FA Code')" />
            <x-text-input id="code" class="block mt-1 w-full" type="number" name="code" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Validate') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
