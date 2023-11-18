<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom -->
        <div>
            <x-input-label for="name" :value="__('Nom*')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Prenom -->
        <div class="mt-4">
            <x-input-label for="prenom" :value="__('Prenom*')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <!-- Raison sociale -->
        <div class="mt-4">
            <x-input-label for="raison_sociale" :value="__('Raison social*')" />
            <x-text-input id="raison_sociale" class="block mt-1 w-full" type="text" name="raison_sociale" :value="old('raison_sociale')" required autocomplete="raison_sociale" />
            <x-input-error :messages="$errors->get('raison_sociale')" class="mt-2" />
        </div>

        <!-- Civilite -->
        <div class="mt-4">
            <x-input-label for="civilite" :value="__('Civilite*')" />
            <select name="civilite" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm">
                <option value="mr">Mr</option>
                <option value="mme">Mme</option>
            </select>
            <x-input-error :messages="$errors->get('civilite')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email*')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Ville -->
        <div class="mt-4">
            <x-input-label for="ville" :value="__('Ville*')" />
            <x-text-input id="ville" class="block mt-1 w-full" type="text" name="ville" :value="old('ville')" required autocomplete="ville" />
            <x-input-error :messages="$errors->get('ville')" class="mt-2" />
        </div>

        <!-- Adresse -->
        <div class="mt-4">
            <x-input-label for="adresse" :value="__('Adresse*')" />
            <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')" required autocomplete="adresse" />
            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
        </div>

        <!-- Code postal -->
        <div class="mt-4">
            <x-input-label for="code_postal" :value="__('Code postal*')" />
            <x-text-input id="code_postal" class="block mt-1 w-full" type="number" name="code_postal" :value="old('code_postal')" required autocomplete="code_postal" />
            <x-input-error :messages="$errors->get('code_postal')" class="mt-2" />
        </div>

        <!-- Telephone 1 -->
        <div class="mt-4">
            <x-input-label for="numero_telephone" :value="__('Telephone 1*')" />
            <x-text-input id="numero_telephone" class="block mt-1 w-full" type="number" name="numero_telephone" :value="old('numero_telephone')" required autocomplete="numero_telephone" />
            <x-input-error :messages="$errors->get('numero_telephone')" class="mt-2" />
        </div>

        <!-- Telephone 2 -->
        <div class="mt-4">
            <x-input-label for="numero_telephone2" :value="__('Telephone 2')" />
            <x-text-input id="numero_telephone2" class="block mt-1 w-full" type="number" name="numero_telephone2" :value="old('numero_telephone2')" autocomplete="numero_telephone2" />
            <x-input-error :messages="$errors->get('numero_telephone2')" class="mt-2" />
        </div>

        <!-- Telephone 3 -->
        <div class="mt-4">
            <x-input-label for="numero_telephone3" :value="__('Telephone 3')" />
            <x-text-input id="numero_telephone3" class="block mt-1 w-full" type="number" name="numero_telephone3" :value="old('numero_telephone3')" autocomplete="numero_telephone3" />
            <x-input-error :messages="$errors->get('numero_telephone3')" class="mt-2" />
        </div>

        <!-- Profession -->
        <div class="mt-4">
            <x-input-label for="profession" :value="__('Profession')" />
            <x-text-input id="profession" class="block mt-1 w-full" type="text" name="profession" :value="old('profession')" autocomplete="profession" />
            <x-input-error :messages="$errors->get('profession')" class="mt-2" />
        </div>

        <!-- Date de naissance -->
        <div class="mt-4">
            <x-input-label for="date_naissance" :value="__('Date de naissance')" />
            <x-text-input id="date_naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="old('date_naissance')" autocomplete="date_naissance" />
            <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
        </div>

        <!-- Structure -->
        <div class="mt-4">
            <x-input-label for="structure_id" :value="__('Structure*')" />
            <select name="structure_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm">
                @foreach($structures as $structure)
                    <option value="{{ $structure->id }}">{{ $structure->nom }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('structure_id')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password*')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password*')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
