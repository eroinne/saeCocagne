@extends('layouts.app-staffs')

@section('body')


<div x-data="myApp()">

    <div class="flex justify-center mb-4">
        <button @click="openGenerateModal" class="py-1.5 px-2 bg-green-800 hover:bg-green-600 text-white rounded-lg">
            Générer un calendrier
        </button>
    </div>


    <div class="mb-4">
        <label for="search" class="block font-medium text-gray-700 text-md">Rechercher :</label>
        <input type="text" id="search" name="search" class="mt-1 p-2 border rounded-md w-full focus:ring-green-600 focus:border-green-600">
    </div>


    <ul role="list" class="divide-y divide-gray-100">
        @foreach($structures as $structure)
            <li onclick="window.location='{{ route('staffs.calendar', ['structures_id' => $structure->id]) }}'" class="relative py-5 hover:bg-gray-50 li">
                <div class="mx-auto flex max-w-7xl justify-between gap-x-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex gap-x-4">
                        <span id="default-svg" class="inline-block h-12 w-12 overflow-hidden rounded-full bg-gray-100">
                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm">
                                Structure:
                            </p>
                        <p class="text-sm font-semibold leading-6 text-gray-900">
                            <a href="#">
                                <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                {{$structure->nom}}
                            </a>
                        </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-x-4">
                        <div class="hidden sm:flex sm:flex-col sm:items-end">
                        <p class="mt-1 text-xs leading-5 text-gray-500">
                            Voir les calendriers
                        </p>
                        </div>
                        <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </li>

        @endforeach

    </ul>

    <!-- Generate Calendar Modal -->
    <div x-show="showGenerateModal" class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center" x-cloak>
        <div class="fixed inset-0 transition-opacity" @click="closeDeleteModal" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <form action="{{ route('staffs.livraison.generer') }}" method="POST" class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-md sm:w-full mx-auto">
            @csrf
            <div class="bg-white px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Générer un calendrier</h3>

                <!-- Year input -->
                <div class="mb-4">
                    <label for="year" class="block text-sm font-medium text-gray-700">Année</label>
                    <input type="number" id="year" name="year" x-model="generateYear" class="mt-1 p-2 border rounded-md w-full" required>
                </div>

                <!-- Structure select -->
                <div class="mb-4">
                    <label for="structures_id" class="block text-sm font-medium text-gray-700">Structure</label>
                    <select id="structures_id" name="structures_id" x-model="selectedStructure" class="mt-1 p-2 border rounded-md w-full" required>
                        <!-- Populate your structure options dynamically here -->
                        @foreach($structures as $structure)
                            <option value="{{ $structure->id }}">{{ $structure->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring focus:border-green-700 sm:w-auto sm:text-sm">
                        Générer
                    </button>
                    <button @click="closeGenerateModal" type="reset" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Annuler
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('search').AjouterEventListener('input', function() {
        var searchTerm = this.value.toLowerCase();
        var listItems = document.querySelectorAll('.li');

        listItems.forEach(function(item) {
            var textContent = item.textContent.toLowerCase();
            var isVisible = textContent.includes(searchTerm);
            item.style.display = isVisible ? 'block' : 'none';
        });
    });

    function myApp() {
        return {
            showGenerateModal: false,
            generateYear: null,
            selectedStructure: null,

            openGenerateModal() {
                this.showGenerateModal = true;
            },
            closeGenerateModal() {
                this.showGenerateModal = false;
            }
        };
    }
</script>

@endsection
