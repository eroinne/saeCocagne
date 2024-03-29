@extends('layouts.app-staffs')

@section('body')

<div x-data="DepotApp()">


    <div class="px-4 sm:px-6 lg:px-8">
        <a href="{{route('staffs.depots')}}">
            <button type="button" class="mb-10 block rounded-md bg-white-600 px-3 py-2 text-center text-sm font-semibold text-black border shadow-sm hover:bg-gray-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"><- Retour</button>
        </a>
        <div class="sm:flex sm:items-center justify-between">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Depots</h1>
                <p class="mt-2 text-sm text-gray-700">Une liste de toutes les Depots pour la structure: <strong>{{$structure->nom}}</strong></p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button @click="openAddModal" type="button" class="block rounded-md bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Ajouter</button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300 mx-auto">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Nom</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Ville</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Adresse</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Code Postal</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Téléphone</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">E-mail</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Jour de livraison</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Heure de livraison</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Commentaire</th>


                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                    <span class="sr-only">Modifier</span>
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                    <span class="sr-only">Supprimer</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @isset($depots)
                                @foreach($depots as $depot)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{$depot->nom}}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$depot->ville}}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$depot->adresse}}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$depot->code_postal}}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$depot->telephone}}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$depot->mail}}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$depot->jour_livraison}}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$depot->heure_livraison}}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$depot->commentaire}}</td>

                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                        <a href="#" @click="openEditModal({{$depot}})" class="text-green-600 hover:text-green-900">Modifier</a>
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                        <a href="#" @click="confirmDeleteDepot({{$depot}})" class="text-red-600 hover:text-red-900">Supprimer</a>
                                    </td>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Depot Modal -->
    <div x-show="showEditModal" class="fixed inset-0 z-50  flex items-center justify-center" x-cloak>
        <div class="fixed inset-0 transition-opacity" @click="closeEditModal" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <form action="{{ route("staffs.depot.update") }}" method="POST" class="bg-white h-[600px] overflow-y-auto rounded-lg text-left shadow-xl transform transition-all sm:max-w-md sm:w-full">
            @csrf
            <div class="bg-white px-4 py-5 sm:p-6">
                <!-- Depot details go here -->
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Modifier le Depot</h3>

                <!-- Display current Depot details -->
                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom<span class="text-red-500">*</span></label>
                        <input type="text" name="nom" id="nom" x-model="selectedDepot.nom" class="mt-1 p-2 border rounded-md w-full" required>
                        @error('nom')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="ville" class="block text-sm font-medium text-gray-700 mb-2">Ville<span class="text-red-500">*</span></label>
                        <input type="text" name="ville" id="ville" x-model="selectedDepot.ville" class="mt-1 p-2 border rounded-md w-full" required>
                        @error('ville')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="adresse" class="block text-sm font-medium text-gray-700 mb-2">Adresse<span class="text-red-500">*</span></label>
                        <input type="text" name="adresse" id="adresse" x-model="selectedDepot.adresse" class="mt-1 p-2 border rounded-md w-full" required>
                        @error('adresse')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="code_postal" class="block text-sm font-medium text-gray-700 mb-2">Code Postal<span class="text-red-500">*</span></label>
                        <input type="text" name="code_postal" id="code_postal" x-model="selectedDepot.code_postal" class="mt-1 p-2 border rounded-md w-full" required>
                        @error('code_postal')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                        <input type="text" name="telephone" id="telephone" x-model="selectedDepot.telephone" class="mt-1 p-2 border rounded-md w-full">
                        @error('telephone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mail" class="block text-sm font-medium text-gray-700 mb-2">E-mail</label>
                        <input type="email" name="mail" id="mail" x-model="selectedDepot.mail" class="mt-1 p-2 border rounded-md w-full">
                        @error('mail')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="siteWeb" class="block text-sm font-medium text-gray-700 mb-2">Site Web</label>
                        <input type="text" name="siteWeb" id="siteWeb" x-model="selectedDepot.siteWeb" class="mt-1 p-2 border rounded-md w-full">
                        @error('siteWeb')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mail_referent" class="block text-sm font-medium text-gray-700 mb-2">Mail referent<span class="text-red-500">*</span></label>
                        <input type="email" name="mail_referent" id="mail_referent" x-model="selectedDepot.mail_referent" class="mt-1 p-2 border rounded-md w-full" required>
                        @error('mail_referent')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telephone_referent" class="block text-sm font-medium text-gray-700 mb-2">Telephone referent<span class="text-red-500">*</span></label>
                        <input type="text" name="telephone_referent" id="telephone_referent" x-model="selectedDepot.telephone_referent" class="mt-1 p-2 border rounded-md w-full" required>
                        @error('telephone_referent')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jour_livraison" class="block text-sm font-medium text-gray-700 mb-2">Jour de livraison<span class="text-red-500">*</span></label>
                        <select name="jour_livraison" id="jour_livraison" x-model="selectedDepot.jour_livraison" class="mt-1 p-2 border rounded-md w-full" required>
                            <option value="lundi">lundi</option>
                            <option value="mardi">mardi</option>
                            <option value="mercredi">mercredi</option>
                            <option value="jeudi">jeudi</option>
                            <option value="vendredi">vendredi</option>
                        </select>
                        @error('jour_livraison')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="heure_livraison" class="block text-sm font-medium text-gray-700 mb-2">Heure de livraison<span class="text-red-500">*</span></label>
                        <input type="text" name="heure_livraison" id="heure_livraison" x-model="selectedDepot.heure_livraison" class="mt-1 p-2 border rounded-md w-full" required>
                        <p class="text-gray-500 text-xs italic">Format: hh:mm:ss</p>
                        @error('heure_livraison')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="heure_paniers" class="block text-sm font-medium text-gray-700 mb-2">Heure récupération panier<span class="text-red-500">*</span></label>
                        <input type="text" name="heure_paniers" id="heure_paniers" x-model="selectedDepot.heure_paniers" class="mt-1 p-2 border rounded-md w-full" required>
                        <p class="text-gray-500 text-xs italic">Format: hh:mm:ss</p>
                        @error('heure_paniers')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="text_presentation" class="block text-sm font-medium text-gray-700 mb-2">Text de presentation</label>
                        <input type="text" name="text_presentation" id="text_presentation" x-model="selectedDepot.text_presentation" class="mt-1 p-2 border rounded-md w-full">
                        @error('text_presentation')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-span-2">
                        <label for="commentaire" class="block text-sm font-medium text-gray-700 mb-2">Commentaire</label>
                        <textarea rows="5" type="text" name="commentaire" id="commentaire" x-model="selectedDepot.commentaire" class="mt-1 p-2 border rounded-md w-full"></textarea>
                        @error('commentaire')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Depot details form -->
                <div>
                    <input type="hidden" name="depot_id" x-model="selectedDepot.id">
                    <input type="hidden" name="structures_id" value="{{$structure->id}}">
                </div>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring focus:border-green-700 sm:ml-3 sm:w-auto sm:text-sm mr-4">
                    Sauvegarder
                </button>
                <button @click="closeEditModal" type="reset" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Annuler
                </button>
            </div>
        </form>
    </div>



    <!-- Add Depot Modal -->
    <div x-show="showAddModal" class="fixed inset-0 z-50  flex items-center justify-center" x-cloak>
        <!-- Modal overlay -->
        <div class="fixed inset-0 transition-opacity" @click="closeAddModal" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- Add Depot form -->
        <form action="{{ route("staffs.depot.store") }}" method="POST" class="bg-white h-[600px] overflow-y-auto rounded-lg text-left shadow-xl transform transition-all sm:max-w-md sm:w-full">
            @csrf
            <div class="bg-white px-4 py-5 sm:p-6">
                <!-- Depot details go here -->
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Ajouter un nouveau Depot</h3>

                <!-- Display current Depot details -->
                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom<span class="text-red-500">*</span></label>
                        <input type="text" name="nom" id="nom" class="mt-1 p-2 border rounded-md w-full" required>
                        @error('nom')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="ville" class="block text-sm font-medium text-gray-700 mb-2">Ville<span class="text-red-500">*</span></label>
                        <input type="text" name="ville" id="ville" class="mt-1 p-2 border rounded-md w-full" required>
                        @error('ville')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="adresse" class="block text-sm font-medium text-gray-700 mb-2">Adresse<span class="text-red-500">*</span></label>
                        <input type="text" name="adresse" id="adresse" class="mt-1 p-2 border rounded-md w-full" required>
                        @error('adresse')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="code_postal" class="block text-sm font-medium text-gray-700 mb-2">Code Postal<span class="text-red-500">*</span></label>
                        <input type="text" name="code_postal" id="code_postal" class="mt-1 p-2 border rounded-md w-full" required>
                        @error('code_postal')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                        <input type="text" name="telephone" id="telephone" class="mt-1 p-2 border rounded-md w-full">
                        @error('telephone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mail" class="block text-sm font-medium text-gray-700 mb-2">E-mail</label>
                        <input type="email" name="mail" id="mail" class="mt-1 p-2 border rounded-md w-full">
                        @error('mail')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="siteWeb" class="block text-sm font-medium text-gray-700 mb-2">Site Web</label>
                        <input type="text" name="siteWeb" id="siteWeb" class="mt-1 p-2 border rounded-md w-full">
                        @error('siteWeb')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mail_referent" class="block text-sm font-medium text-gray-700 mb-2">Mail referent<span class="text-red-500">*</span></label>
                        <input type="email" name="mail_referent" id="mail_referent" class="mt-1 p-2 border rounded-md w-full" required>
                        @error('mail_referent')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telephone_referent" class="block text-sm font-medium text-gray-700 mb-2">Telephone referent<span class="text-red-500">*</span></label>
                        <input type="text" name="telephone_referent" id="telephone_referent" class="mt-1 p-2 border rounded-md w-full" required>
                        @error('telephone_referent')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jour_livraison" class="block text-sm font-medium text-gray-700 mb-2">Jour de livraison<span class="text-red-500">*</span></label>
                        <select name="jour_livraison" id="jour_livraison" class="mt-1 p-2 border rounded-md w-full" required>
                            <option value="lundi">lundi</option>
                            <option value="mardi">mardi</option>
                            <option value="mercredi">mercredi</option>
                            <option value="jeudi">jeudi</option>
                            <option value="vendredi">vendredi</option>
                        </select>
                        @error('jour_livraison')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="heure_livraison" class="block text-sm font-medium text-gray-700 mb-2">Heure de livraison<span class="text-red-500">*</span></label>
                        <input type="text" name="heure_livraison" id="heure_livraison" class="mt-1 p-2 border rounded-md w-full" required>
                            <p class="text-gray-500 text-xs italic">Format: hh:mm:ss</p>
                        @error('heure_livraison')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="heure_paniers" class="block text-sm font-medium text-gray-700 mb-2">Heure récupération panier<span class="text-red-500">*</span></label>
                        <input type="text" name="heure_paniers" id="heure_paniers" class="mt-1 p-2 border rounded-md w-full" required>
                            <p class="text-gray-500 text-xs italic">Format: hh:mm:ss</p>
                        @error('heure_paniers')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="text_presentation" class="block text-sm font-medium text-gray-700 mb-2">Text de presentation</label>
                        <input type="text" name="text_presentation" id="text_presentation" class="mt-1 p-2 border rounded-md w-full">
                        @error('text_presentation')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-span-2">
                        <label for="commentaire" class="block text-sm font-medium text-gray-700 mb-2">Commentaire</label>
                        <textarea rows="5" type="text" name="commentaire" id="commentaire" class="mt-1 p-2 border rounded-md w-full"></textarea>
                        @error('commentaire')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div>
                    <input type="hidden" name="structures_id" value="{{ $structure->id }}">
                </div>
            </div>

            <!-- Save and Annuler buttons -->
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring focus:border-green-700 sm:ml-3 sm:w-auto sm:text-sm mr-4">
                    Save
                </button>
                <button @click="closeAddModal" type="reset" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Annuler
                </button>
            </div>
        </form>
    </div>


    <!-- Delete Depot Modal -->
    <div x-show="showDeleteModal" class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center" x-cloak>
        <div class="fixed inset-0 transition-opacity" @click="closeDeleteModal" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <form action="{{route('staffs.depot.delete')}}" method="POST" class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-md sm:w-full">
            @csrf
            <div class="bg-white px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Confirmation de suppression</h3>
                <p class="text-sm text-gray-600">Voulez-vous vraiment supprimer cette Depot?</p>
            </div>

            <input type="hidden" name="depot_id" x-model="selectedDepot.id">
            <input type="hidden" name="structures_id" value="{{$structure->id}}">

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring focus:border-red-700 sm:ml-3 sm:w-auto sm:text-sm mr-4">
                    Supprimer
                </button>
                <button  type="reset" @click="closeDeleteModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Annuler
                </button>
            </div>
        </form>
    </div>


</div>

<script>
    function DepotApp() {
        return {
            showEditModal: false,
            showAddModal: false,
            showDeleteModal: false,
            selectedDepot: null,
            openEditModal(Depot) {
                if (Depot) {
                    this.selectedDepot = { ...Depot }; // Copy Depot object to avoid modifying the original data
                    this.showEditModal = true;
                }
            },
            closeEditModal() {
                this.showEditModal = false;
            },
            closeAddModal() {
                this.showAddModal = false;
            },
            openAddModal() {
                this.showAddModal = true;
            },
            confirmDeleteDepot(Depot) {
                if (Depot) {
                    this.selectedDepot = { ...Depot }; // Copy Depot object to avoid modifying the original data
                    this.showDeleteModal = true;
                }
            },
            closeDeleteModal() {
                this.showDeleteModal = false;
            }


        };
    }
</script>



@endsection
