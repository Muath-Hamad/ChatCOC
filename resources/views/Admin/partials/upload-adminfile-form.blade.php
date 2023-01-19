<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Chatbot Files manager') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Upload College schedule .pdf file to feed the Chatbot") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>


 <form method="post" action="{{ route('Adminfile.store') }}" class="mt-6 space-y-6" enctype= multipart/form-data>
        @csrf
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <input type="file" name="adminfile" id="adminfile" class="bg-gray-50 border border-gray-300 text-gray-900">
            @error('adminfile')
                <small class="tect-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
