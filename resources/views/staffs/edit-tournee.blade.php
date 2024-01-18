@extends('layouts.app-staffs')

@section('body')

<div x-data="tourneeApp()">


    <div class="px-4 sm:px-6 lg:px-8">
        <a href="{{route('staffs.tournee', ['structures_id' => $structure->id])}}">
            <button type="button" class="mb-10 block rounded-md bg-white-600 px-3 py-2 text-center text-sm font-semibold text-black border shadow-sm hover:bg-gray-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"><- Retour</button>
        </a>
        <div class="sm:flex sm:items-center justify-between">

            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Tournées</h1>
                <p class="mt-2 text-sm text-gray-700">Une liste de toutes les tournées pour la structure: <strong>{{$structure->nom}}</strong></p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button @click="openAddModal" type="button" class="block rounded-md bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Ajouter</button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <form action="{{ route("staffs.tournee.update") }}" method="POST" class="bg-white rounded-lg text-left transform transition-all">
                        @csrf
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="mb-4 grid grid-cols-2 xl:grid-cols-4 gap-4">
                                <div>
                                    <label for="structure" class="block text-sm font-medium text-gray-700 mb-2">Structure<span class="text-red-500">*</span></label>
                                    <input type="text" name="structure" id="structure" value="{{$structure->nom}}" class="mt-1 p-2 border rounded-md w-full" readonly>
                                </div>
                                <div>
                                    <label for="jour_preparation" class="block text-sm font-medium text-gray-700 mb-2">Jour de preparation<span class="text-red-500">*</span></label>
                                    <select name="jour_preparation" id="jour_preparation" class="mt-1 p-2 border rounded-md w-full" required>
                                        <option value="lundi" {{ $tournee->jour_preparation === 'lundi' ? 'selected' : '' }}>lundi</option>
                                        <option value="mardi" {{ $tournee->jour_preparation === 'mardi' ? 'selected' : '' }}>mardi</option>
                                        <option value="mercredi" {{ $tournee->jour_preparation === 'mercredi' ? 'selected' : '' }}>mercredi</option>
                                        <option value="jeudi" {{ $tournee->jour_preparation === 'jeudi' ? 'selected' : '' }}>jeudi</option>
                                        <option value="vendredi" {{ $tournee->jour_preparation === 'vendredi' ? 'selected' : '' }}>vendredi</option>
                                    </select>
                                    @error('jour_preparation')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="jour_livraison" class="block text-sm font-medium text-gray-700 mb-2">Jour de livraison<span class="text-red-500">*</span></label>
                                    <select name="jour_livraison" id="jour_livraison" class="mt-1 p-2 border rounded-md w-full" required>
                                        <option value="lundi" {{ $tournee->jour_livraison === 'lundi' ? 'selected' : '' }}>lundi</option>
                                        <option value="mardi" {{ $tournee->jour_livraison === 'mardi' ? 'selected' : '' }}>mardi</option>
                                        <option value="mercredi" {{ $tournee->jour_livraison === 'mercredi' ? 'selected' : '' }}>mercredi</option>
                                        <option value="jeudi" {{ $tournee->jour_livraison === 'jeudi' ? 'selected' : '' }}>jeudi</option>
                                        <option value="vendredi" {{ $tournee->jour_livraison === 'vendredi' ? 'selected' : '' }}>vendredi</option>
                                    </select>
                                    @error('jour_livraison')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="couleur" class="block text-sm font-medium text-gray-700 mb-2">Couleur<span class="text-red-500">*</span></label>
                                    <select name="couleur" id="couleur" class="mt-1 p-2 border rounded-md w-full" required>
                                        <option value="red" {{ $tournee->couleur === 'red' ? 'selected' : '' }}>Rouge</option>
                                        <option value="green" {{ $tournee->couleur === 'green' ? 'selected' : '' }}>Bleu</option>
                                        <option value="green" {{ $tournee->couleur === 'green' ? 'selected' : '' }}>Vert</option>
                                        <option value="yellow" {{ $tournee->couleur === 'yellow' ? 'selected' : '' }}>Jaune</option>
                                        <option value="purple" {{ $tournee->couleur === 'purple' ? 'selected' : '' }}>Violet</option>
                                        <option value="orange" {{ $tournee->couleur === 'orange' ? 'selected' : '' }}>Orange</option>
                                        <option value="pink" {{ $tournee->couleur === 'pink' ? 'selected' : '' }}>Rose</option>
                                        <option value="brown" {{ $tournee->couleur === 'brown' ? 'selected' : '' }}>Marron</option>
                                        <option value="gray" {{ $tournee->couleur === 'gray' ? 'selected' : '' }}>Gris</option>
                                        <option value="black" {{ $tournee->couleur === 'black' ? 'selected' : '' }}>Noir</option>
                                    </select>
                                    @error('couleur')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror

                                </div>

                                <!-- Inclure la bibliothèque Sortable -->
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
                                <div class="col-start-1 col-span-2">
                                    @php
                                        $idArray = explode(';', $tournee->point_depots);
                                        $depots = collect();

                                        foreach ($idArray as $depotId) {
                                            $depot = App\Models\Depots::find($depotId);

                                            if ($depot) {
                                                $depots->push($depot);
                                            }
                                        }

                                        $i = 1;
                                    @endphp

                                    <div id="sortable-list" class="mt-4">
                                        @foreach($depots as $depot)
                                            <div data-id="{{ $depot->id }}" class="bg-gray-200 mb-2 flex">
                                                <div class="handle mr-4 bg-gray-400 h-full p-3">☰</div>
                                                <p class="p-3">
                                                    {{ $depot->nom }} - {{ $depot->adresse }}
                                                </p>
                                                <div class="ml-auto flex items-center">
                                                    <button type="button" @click="confirmDeleteDepot({{ $depot->id }})" class="text-red-600 hover:text-red-900 px-5">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('point_depots')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    <script>
                                        var sortable = new Sortable(document.getElementById('sortable-list'), {
                                            handle: '.handle',
                                            onEnd: function (evt) {
                                                updateDepotOrder();
                                            },
                                        });

                                        function updateDepotOrder() {
                                            // Get Depot in new order
                                            var depotsOrder = sortable.toArray();

                                            // Update hidden input
                                            document.getElementById('point_depots').value = depotsOrder.join(';');
                                        }
                                    </script>
                                </div>

                            </div>

                            <div>
                                <input type="hidden" name="structures_id" value="{{$structure->id}}">
                                <input type="hidden" name="tournee_id" value="{{$tournee->id}}">
                                <input type="hidden" name="point_depots" id="point_depots">
                            </div>
                        </div>

                        <div class=" px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring focus:border-green-700 sm:ml-3 sm:w-auto sm:text-sm mr-4">
                                Sauvegarder
                            </button>
                            <button @click="closeEditModal" type="reset" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring focus:border-green-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Annuler
                            </button>
                        </div>
                    </form>
                    <form action="{{route('staffs.tournee.depot.store')}}" method="POST" class="mb-4 grid grid-cols-2 xl:grid-cols-4 gap-4">
                        @csrf
                        <div class="mt-4">
                            <label for="addDepot" class="block text-sm font-medium text-gray-700 mb-2">Ajouter un dépôt</label>
                            <select id="addDepot" name="new_depot" class="mt-1 p-2 border rounded-md w-full" x-model="selectedDepotToAdd">
                                <option value="" disabled selected>Sélectionner un dépôt</option>
                                @foreach($allDepots as $depot)
                                    <option value="{{ $depot->id }}">{{ $depot->nom }} - {{ $depot->adresse }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="structures_id" value="{{$structure->id}}">
                            <input type="hidden" name="tournee_id" value="{{$tournee->id}}">
                            <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring focus:border-green-700">Ajouter</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



    <!-- Add Livraison Modal -->
    <div x-show="showAddModal" class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center" x-cloak>
        <div class="fixed inset-0 transition-opacity" @click="closeAddModal" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <form action="{{ route("staffs.livraison.store") }}" method="POST" class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-md sm:w-full">
            @csrf
            <div class="bg-white px-4 py-5 sm:p-6">
                <!-- Livraison details form -->
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Ajouter une Livraison</h3>

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
                <button @click="closeAddModal" type="reset" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring focus:border-green-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Annuler
                </button>
            </div>
        </form>
    </div>

    <!-- Delete tournee Modal -->
    <div x-show="showDeleteModal" class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center" x-cloak>
        <div class="fixed inset-0 transition-opacity" @click="closeDeleteModal" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <form action="{{route('staffs.tournee.depot.delete')}}" method="POST" class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-md sm:w-full">
            @csrf
            <div class="bg-white px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Confirmation de suppression</h3>
                <p class="text-sm text-gray-600">Voulez-vous vraiment supprimer ce dépot de cette tournée?</p>
            </div>

            <input type="hidden" name="depot_id" x-bind:value="selectedDepot">
            <input type="hidden" name="tournee_id" value="{{$tournee->id}}">
            <input type="hidden" name="structures_id" value="{{$structure->id}}">

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring focus:border-red-700 sm:ml-3 sm:w-auto sm:text-sm mr-4">
                    Supprimer
                </button>
                <button  type="reset" @click="closeDeleteModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring focus:border-green-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Annuler
                </button>
            </div>
        </form>
    </div>


</div>

<script>
    function tourneeApp() {
        return {
            showAddModal: false,
            showDeleteModal: false,
            selectedDepot: null,
            closeAddModal() {
                this.showAddModal = false;
            },
            openAddModal() {
                this.showAddModal = true;
            },
            confirmDeleteDepot(depot) {
                if (depot) {
                    this.selectedDepot = depot; // Copy tournee object to avoid modifying the original data
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
