@section('title' , 'Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            صفحة Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="  bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="pr-20 max-w-xl">

                        @include('Admin.partials.upload-adminfile-form')
                    </div>
                </div>
            </div>
            <div class=" mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <div class="p-6 text-gray-900">
                    {{ __("You're logged in as an admin!") }}
                </div> --}}
                <div class=" p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="pr-20 max-w-xl">

                        @include('Admin.partials.show-adminfile')
                    </div>
                </div>
            </div>
            <div class="mt-4 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="pr-20 max-w-xl">

                    @include('Admin.partials.year-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
