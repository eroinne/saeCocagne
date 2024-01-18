@extends('layouts.app-staffs')

@section('body')

<form action="{{ route('staffs.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ Auth::guard('staffs')->user()->id }}">
    <div class="space-y-12">

        <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">Information personnelle</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Veuillez a utilisez une adresse email valide.</p>
            </div>

            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                <div class="sm:col-span-3">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>
                    <div class="mt-2">
                        <input type="text" value="{{ Auth::guard('staffs')->user()->nom }}" name="nom" id="nom" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="prenom" class="block text-sm font-medium leading-6 text-gray-900">Prenom</label>
                    <div class="mt-2">
                        <input type="text" value="{{ Auth::guard('staffs')->user()->prenom }}" name="prenom" id="prenom" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Adresse email</label>
                    <div class="mt-2">
                        <input id="email" value="{{ Auth::guard('staffs')->user()->email }}" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="admin" class="block text-sm font-medium leading-6 text-gray-900">Rang</label>
                    <div class="mt-2">
                        <input id="admin" value="{{ Auth::guard('staffs')->user()->is_admin == 0 ? "Modérateur" : "Administrateur"}}" name="admin" type="text" readonly class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('is_admin')" class="mt-2" />
                    </div>

                </div>

            </div>
        </div>


    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
        <button type="submit" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Save</button>
    </div>
</form>

@endsection
