@extends('layouts.app-staffs')

@section('body')

<div x-data="livraisonApp()">


    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center justify-between">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Livraisons</h1>
                <p class="mt-2 text-sm text-gray-700">Une liste de toutes les livraisons pour la structure: <strong>{{$structure->nom}}</strong></p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" class="block rounded-md bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Add user</button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300 mx-auto">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Jour</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Numéro de semaine</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($livraisons as $livraison)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{$livraison->jour}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$livraison->numero_semaine}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$livraison->date}}</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                    <a href="#" @click="openModal({{$livraison}})" class="text-green-600 hover:text-green-900">Edit</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Livraison Modal -->
<div x-show="showModal" class="fixed inset-0 z-10 overflow-y-auto" x-cloak>
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" @click="closeModal" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <form action="{{ route("staffs.livraison.update") }}" method="POST" class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-md sm:w-full">
            @csrf
            <div class="bg-white px-4 py-5 sm:p-6">
                <!-- Livraison details go here -->
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Modifier la Livraison</h3>

                <div class="mb-4">
                    <!-- Display current Livraison details -->
                    <p class="text-sm font-medium text-gray-600">Jour actuel: <span class="text-gray-900" x-text="selectedLivraison.jour"></span></p>
                    <p class="text-sm font-medium text-gray-600">Date actuel: <span class="text-gray-900" x-text="selectedLivraison.date"></span></p>

                </div>

                <!-- Barre de séparation -->
                <div class="border-t border-gray-200 mb-4"></div>

                <!-- Livraison details form -->
                <div>
                    <label for="datePicker" class="block text-sm font-medium text-gray-700 mb-2">Nouvelle Date</label>
                    <input type="date" name="newDate" class="mt-1 p-2 border rounded-md w-full">
                    <input type="hidden" name="livraison_id" x-model="selectedLivraison.id">
                </div>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring focus:border-green-700 sm:ml-3 sm:w-auto sm:text-sm mr-4">
                    Sauvegarder
                </button>
                <button @click="closeModal" type="reset" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

</div>

<script>
    function livraisonApp() {
        return {
            showModal: false,
            selectedLivraison: null,
            openModal(livraison) {
                if (livraison) {
                    this.selectedLivraison = { ...livraison }; // Copy livraison object to avoid modifying the original data
                    this.showModal = true;
                }
            },
            closeModal() {
                this.showModal = false;
            },
            confirmDeleteLivraison() {
                this.closeModal();
            }
        };
    }
</script>

@endsection
