@extends('layouts.app-staffs')

@section('body')

<div x-data="DepotApp()">


    <div class="px-4 sm:px-6 lg:px-8">
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
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                    <span class="sr-only">Edit</span>
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                    <span class="sr-only">Delete</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($depots as $depot)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{$depot->nom}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$depot->ville}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$depot->adresse}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$depot->code_postal}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$depot->telephone}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$depot->mail}}</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                    <a href="#" @click="openEditModal({{$depot}})" class="text-green-600 hover:text-green-900">Edit</a>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                    <a href="#" @click="confirmDeleteDepot({{$depot}})" class="text-red-600 hover:text-red-900">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Depot Modal -->
    <div x-show="showEditModal" class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center" x-cloak>
        <div class="fixed inset-0 transition-opacity" @click="closeEditModal" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <form action="{{ route("staffs.livraison.update") }}" method="POST" class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-md sm:w-full">
            @csrf
            <div class="bg-white px-4 py-5 sm:p-6">
                <!-- Depot details go here -->
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Modifier la Depot</h3>

                <div class="mb-4">
                    <!-- Display current Depot details -->
                    <p class="text-sm font-medium text-gray-600">Jour actuel: <span class="text-gray-900" x-text="selectedDepot.jour"></span></p>
                    <p class="text-sm font-medium text-gray-600">Date actuel: <span class="text-gray-900" x-text="selectedDepot.date"></span></p>
                </div>

                <!-- Barre de séparation -->
                <div class="border-t border-gray-200 mb-4"></div>

                <!-- Depot details form -->
                <div>
                    <label for="datePicker" class="block text-sm font-medium text-gray-700 mb-2">Nouvelle Date</label>
                    <input type="date" name="newDate" class="mt-1 p-2 border rounded-md w-full">
                    <input type="hidden" name="Depot_id" x-model="selectedDepot.id">
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
    <div x-show="showAddModal" class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center" x-cloak>
        <div class="fixed inset-0 transition-opacity" @click="closeAddModal" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <form action="{{ route("staffs.livraison.store") }}" method="POST" class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-md sm:w-full">
            @csrf
            <div class="bg-white px-4 py-5 sm:p-6">
                <!-- Depot details form -->
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Ajouter une Depot</h3>

                <!-- Barre de séparation -->
                <div class="border-t border-gray-200 mb-4"></div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                    <input type="date" name="date" id="date" class="mt-1 p-2 border rounded-md w-full">
                    <input type="hidden" name="structures_id" value="{{$structure->id}}">
                </div>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring focus:border-green-700 sm:ml-3 sm:w-auto sm:text-sm mr-4">
                    Ajouter
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

        <form action="{{route('staffs.livraison.delete')}}" method="POST" class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-md sm:w-full">
            @csrf
            <div class="bg-white px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Confirmation de suppression</h3>
                <p class="text-sm text-gray-600">Voulez-vous vraiment supprimer cette Depot?</p>
            </div>

            <input type="hidden" name="Depot_id" x-model="selectedDepot.id">
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
