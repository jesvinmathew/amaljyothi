<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Your File') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="card">
            <div class="card-header">
                Upload your file
            </div>
            <div class="card-body">
                <form action="{{route('uploads.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="file" class="form-label">PDF File</label>
                            <x-text-input type="file" class="block mt-1 w-full" id="file" name="file" aria-describedby="fileHelp"  accept="application/pdf" />
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>
                        <x-primary-button class="ml-4 col-2">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
