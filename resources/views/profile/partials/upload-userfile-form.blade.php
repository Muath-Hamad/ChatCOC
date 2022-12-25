<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Personal User File') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Upload your academic record .pdf file to feed the Chatbot") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('Userfile.store') }}" class="mt-6 space-y-6">
        @csrf
        {{-- @method('patch') --}}


        <div>
            <x-input-label for="name" :value="__('Name')" />
            <input type="file" name="userfile" id="userfile" class="bg-gray-50 border border-gray-300 text-gray-900">
            @error('userfile')
                <small class="tect-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
