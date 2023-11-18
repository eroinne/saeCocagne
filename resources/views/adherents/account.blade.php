@extends('layouts.app-adherent')

@section('body')




<form action="{{ route('adherents.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="space-y-12">
        <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">Profil</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Ce sont les informations montré en public.</p>
            </div>

            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                <div class="sm:col-span-3">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Raison sociale</label>
                    <div class="mt-2">
                        <input type="text" value="{{ Auth::user()->raison_sociale }}" name="raison_sociale" id="raison_sociale" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('raison_sociale')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="civilite" class="block text-sm font-medium leading-6 text-gray-900">Civilité</label>
                    <div class="mt-2">
                        <select name="civilite" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                            <option value="mr">Mr</option>
                            <option value="mme">Mme</option>
                        </select>
                        <x-input-error :messages="$errors->get('civilite')" class="mt-2" />
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                    <div class="mt-2 flex items-center gap-x-3">
                        @if(isset(Auth::user()->photo))
                            <img src="data:image/png;base64,{{ Auth::user()->photo }}" alt="">
                        @else
                            <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Changer la photo</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                            </svg>
                            <div class="mt-4 flex text-sm leading-6 text-gray-600 justify-center">
                                <label for="photo" class="relative cursor-pointer rounded-md bg-white font-semibold text-green-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-green-600 focus-within:ring-offset-2 hover:text-green-500">
                                    <span class="text-center">Upload a file</span>
                                    <input id="photo" name="photo" type="file" class="sr-only">
                                </label>
                            </div>
                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />

                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">Information personnelle</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Veuillez a utilisez une adresse email valide.</p>
            </div>

            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                <div class="sm:col-span-3">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>
                    <div class="mt-2">
                        <input type="text" value="{{ Auth::user()->name }}" name="name" id="name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="prenom" class="block text-sm font-medium leading-6 text-gray-900">Prenom</label>
                    <div class="mt-2">
                        <input type="text" value="{{ Auth::user()->prenom }}" name="prenom" id="prenom" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Adresse email</label>
                    <div class="mt-2">
                        <input id="email" value="{{ Auth::user()->email }}" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>


                <div class="col-span-full">
                    <label for="adresse" class="block text-sm font-medium leading-6 text-gray-900">Adresse</label>
                    <div class="mt-2">
                        <input type="text" value="{{ Auth::user()->adresse }}" name="adresse" id="adresse" autocomplete="adresse" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="ville" class="block text-sm font-medium leading-6 text-gray-900">City</label>
                    <div class="mt-2">
                        <input id="ville" value="{{ Auth::user()->ville }}" name="ville" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                    </div>
                </div>


                <div class="sm:col-span-2">
                    <label for="code_postal" class="block text-sm font-medium leading-6 text-gray-900">Code postal</label>
                    <div class="mt-2">
                        <input type="text" value="{{ Auth::user()->code_postal }}" name="code_postal" id="code_postal" autocomplete="code_postal" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('code_postal')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="numero_telephone" class="block text-sm font-medium leading-6 text-gray-900">Telephone 1</label>
                    <div class="mt-2">
                        <input id="numero_telephone" value="{{ Auth::user()->numero_telephone }}" name="numero_telephone" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('numero_telephone')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="numero_telephone2" class="block text-sm font-medium leading-6 text-gray-900">Telephone 2</label>
                    <div class="mt-2">
                        <input id="numero_telephone2" value="{{ Auth::user()->numero_telephone2 }}" name="numero_telephone2" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('numero_telephone2')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="numero_telephone3" class="block text-sm font-medium leading-6 text-gray-900">Telephone 3</label>
                    <div class="mt-2">
                        <input id="numero_telephone3" value="{{ Auth::user()->numero_telephone3 }}" name="numero_telephone3" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('numero_telephone3')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="profession" class="block text-sm font-medium leading-6 text-gray-900">Profession</label>
                    <div class="mt-2">
                        <input type="text" value="{{ Auth::user()->profession }}" name="profession" id="profession" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('profession')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="date_naissance" class="block text-sm font-medium leading-6 text-gray-900">Date de naissance</label>
                    <div class="mt-2">
                        <input type="date" value="{{ Auth::user()->date_naissance }}" name="date_naissance" id="date_naissance" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
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
