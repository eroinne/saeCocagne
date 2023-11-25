@props([
'nom',
'valeur_unite',
'unite',
'prix'
])

<div class="relative z-10" role="dialog" aria-modal="true">
    <!--
        Background backdrop, show/hide based on modal state.

        Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
        Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed inset-0 hidden bg-gray-500 bg-opacity-75 transition-opacity md:block"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-stretch justify-center text-center md:items-center md:px-2 lg:px-4">
            <!--
                Modal panel, show/hide based on modal state.

                Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
                To: "opacity-100 translate-y-0 md:scale-100"
                Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 md:scale-100"
                To: "opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
            -->
            <div class="flex w-full transform text-left text-base transition md:my-8 md:max-w-2xl md:px-4 lg:max-w-4xl">
                <div class="relative flex w-full items-center overflow-hidden bg-white px-4 pb-8 pt-14 shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8">
                    <button @click="open = false" type="button" class="absolute right-4 top-4 text-gray-400 hover:text-gray-500 sm:right-6 sm:top-8 md:right-6 md:top-6 lg:right-8 lg:top-8">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="grid w-full grid-cols-1 items-start gap-x-6 gap-y-8 sm:grid-cols-12 lg:gap-x-8">
                        <div class="sm:col-span-4 lg:col-span-5">
                            <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100">
                                <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-product-04.jpg" alt="Back angled view with bag open and handles to the side." class="object-cover object-center">
                            </div>
                        </div>
                        <div class="sm:col-span-8 lg:col-span-7">
                            <h2 class="text-2xl font-bold text-gray-900 sm:pr-12">{{$nom}}</h2>

                            <section aria-labelledby="information-heading" class="mt-3">
                                <h3 id="information-heading" class="sr-only">Product information</h3>

                                <p class="text-2xl text-gray-900">{{$prix}}  €</p>

                                <div>
                                    <p class="text-sm italic text-gray-500"> {{$valeur_unite}} {{$unite}} </p>

                                </div>

                            </section>

                            <section aria-labelledby="options-heading" class="mt-6">
                                <h3 id="options-heading" class="sr-only">Product options</h3>


                                <div>
                                    En stock
                                </div>

                                <form x-data="{quantity: 1, prix: {{$prix}} }">

                                    <div class="flex items-center justify-between mt-3">
                                        <label for="quantity" class="text-sm text-gray-700">Quantité:</label>
                                        <div class="flex items-center space-x-2">
                                            <button type="button" class="text-gray-500 focus:outline-none focus:text-green-600" @click="quantity--" >-</button>
                                            <input type="text" id="quantity" name="quantity" x-model="quantity" class="text-center w-12 border rounded-md focus:outline-none focus:border-green-500">
                                            <button type="button" class="text-gray-500 focus:outline-none focus:text-green-600" @click="quantity++">+</button>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between mt-3">
                                        <p class="text-sm text-gray-700">Total:</p>
                                        <p x-text="quantity * prix + ' €'"></p>
                                    </div>

                                    <div class="mt-6">
                                        <button type="submit" class="flex w-full items-center justify-center rounded-md border border-transparent bg-green-600 px-8 py-3 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                                            Ajouter au panier
                                        </button>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
