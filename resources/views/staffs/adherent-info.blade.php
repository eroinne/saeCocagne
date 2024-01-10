@extends('layouts.app-staffs')

@section('body')

<form action="{{ route('staffs.adherent.update', ['id' => $adherent->id]) }}" method="POST" enctype="multipart/form-data">
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
                        <input type="text" value="{{ $adherent->raison_sociale }}" name="raison_sociale" id="raison_sociale" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
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
                        @if(isset($adherent->photo))
                            <img class="h-8 w-8 rounded-full" id="image-preview" src="data:image/png;base64,{{ $adherent->photo }}" alt="Photo de profil">
                            <span id="default-svg" class="inline-block h-8 w-8 overflow-hidden rounded-full bg-gray-100 hidden">
                                <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                        @else
                            <span id="default-svg" class="inline-block h-8 w-8 overflow-hidden rounded-full bg-gray-100">
                                <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                            <img class="h-8 w-8 rounded-full hidden" id="image-preview" src="" alt="">
                        @endif

                        <svg
                            class="h-5 w-5 cursor-pointer text-red-500"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                            onclick="removeImage()"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            ></path>
                        </svg>

                    </div>

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
                        <input type="text" value="{{ $adherent->name }}" name="name" id="name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="prenom" class="block text-sm font-medium leading-6 text-gray-900">Prenom</label>
                    <div class="mt-2">
                        <input type="text" value="{{ $adherent->prenom }}" name="prenom" id="prenom" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Adresse email</label>
                    <div class="mt-2">
                        <input id="email" value="{{ $adherent->email }}" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>


                <div class="col-span-full">
                    <label for="adresse" class="block text-sm font-medium leading-6 text-gray-900">Adresse</label>
                    <div class="mt-2">
                        <input type="text" value="{{ $adherent->adresse }}" name="adresse" id="adresse" autocomplete="adresse" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="ville" class="block text-sm font-medium leading-6 text-gray-900">City</label>
                    <div class="mt-2">
                        <input id="ville" value="{{ $adherent->ville }}" name="ville" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                    </div>
                </div>


                <div class="sm:col-span-2">
                    <label for="code_postal" class="block text-sm font-medium leading-6 text-gray-900">Code postal</label>
                    <div class="mt-2">
                        <input type="text" value="{{ $adherent->code_postal }}" name="code_postal" id="code_postal" autocomplete="code_postal" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('code_postal')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="numero_telephone" class="block text-sm font-medium leading-6 text-gray-900">Telephone 1</label>
                    <div class="mt-2">
                        <input id="numero_telephone" value="{{ $adherent->numero_telephone }}" name="numero_telephone" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('numero_telephone')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="numero_telephone2" class="block text-sm font-medium leading-6 text-gray-900">Telephone 2</label>
                    <div class="mt-2">
                        <input id="numero_telephone2" value="{{ $adherent->numero_telephone2 }}" name="numero_telephone2" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('numero_telephone2')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="numero_telephone3" class="block text-sm font-medium leading-6 text-gray-900">Telephone 3</label>
                    <div class="mt-2">
                        <input id="numero_telephone3" value="{{ $adherent->numero_telephone3 }}" name="numero_telephone3" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('numero_telephone3')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="profession" class="block text-sm font-medium leading-6 text-gray-900">Profession</label>
                    <div class="mt-2">
                        <input type="text" value="{{ $adherent->profession }}" name="profession" id="profession" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->get('profession')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="date_naissance" class="block text-sm font-medium leading-6 text-gray-900">Date de naissance</label>
                    <div class="mt-2">
                        <input type="date" value="{{ $adherent->date_naissance }}" name="date_naissance" id="date_naissance" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
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

<script>

    function removeImage() {
        // Hide actual image
        const imagePreview = document.getElementById('image-preview');
        imagePreview.classList.add('hidden');


        // Display default svg
        const defaultSvg = document.getElementById('default-svg');
        if (defaultSvg.classList.contains('hidden')) {
            defaultSvg.classList.remove('hidden');
        }

        fetch("{{ route('staffs.adherent.delete.photo', ['id' => $adherent->id]) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            },
        })
        .then()
        .then(data => {
            // Refresh the page
            window.location.reload();
        })
        .catch(error => {
            console.error('Erreur lors de la requête AJAX :', error);
        });
    }
</script>

@endsection
