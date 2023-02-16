<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
           مدير ملفات chatbot 
        </h2>

        <p class="mt-1 text-sm text-gray-600">
              ارفع ملف الكلية بصيغة (.pdf) لتغذية ال(chatbot)
            <!-- {{ __("Upload College schedule .pdf file to feed the Chatbot") }} -->
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>


 <form method="post" action="{{ route('adminfile.store') }}" class="mt-6 space-y-6" enctype= multipart/form-data>
        @csrf
        <div>
            <label class="custom-file-upload">


                <input type="file" name="adminfile" id="adminfile" >
                <div class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16">
                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/>
                        </svg></div>
                </label>
            @error('adminfile')
                <small class="tect-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>حفظ</x-primary-button>
        </div>
    </form>
</section>
