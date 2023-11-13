<div>
    <div class="bg-gray-50" style="min-height: 480px">

        <div x-data="{ open: false }" @keydown.window.escape="open = false" class="bg-gray-50">
            <!-- Mobile filter dialog -->

            <div x-cloak x-show="open" class="relative z-40 sm:hidden" x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state." x-ref="dialog" aria-modal="true">

                <div x-cloak x-show="open" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Off-canvas menu backdrop, show/hide based on off-canvas menu state." class="fixed inset-0 bg-black bg-opacity-25"></div>


                <div class="fixed inset-0 z-40 flex">

                    <div x-cloak x-show="open" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" x-description="Off-canvas menu, show/hide based on off-canvas menu state." class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-6 shadow-xl" @click.away="open = false">
                        <div class="flex items-center justify-between px-4">
                            <h2 class="text-lg font-medium text-gray-900">Filtres</h2>
                            <button type="button" class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500" @click="open = false">
                                <span class="sr-only">Close menu</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Filters -->
                        <form class="mt-4">
                            <div x-data="{ open: false }" class="border-t border-gray-200 px-4 py-6">
                                <h3 class="-mx-2 -my-3 flow-root">
                                    <button type="button" x-description="Expand/collapse question button" class="flex w-full items-center justify-between bg-white px-2 py-3 text-sm text-gray-400" aria-controls="filter-section-0" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
                                        <span class="font-medium text-gray-900">Type d'achat</span>
                                        <span class="ml-6 flex items-center">
                                            <svg class="rotate-0 h-5 w-5 transform" x-description="Expand/collapse icon, toggle classes based on question open state." x-state:on="Open" x-state:off="Closed" :class="{ '-rotate-180': open, 'rotate-0': !(open) }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </h3>
                                <div class="pt-6" id="filter-section-0" x-cloak x-show="open">
                                    <div class="space-y-6">
                                        <div class="flex items-center">
                                            <input wire:model.live='type_purchase' value="abonnements" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 text-sm text-gray-500">Abonnement</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input wire:model.live='type_purchase' value="produits" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 text-sm text-gray-500">Produits</label>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div x-data="{ open: false }" class="border-t border-gray-200 px-4 py-6">
                                <h3 class="-mx-2 -my-3 flow-root">
                                    <button type="button" x-description="Expand/collapse question button" class="flex w-full items-center justify-between bg-white px-2 py-3 text-sm text-gray-400" aria-controls="filter-section-1" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
                                        <span class="font-medium text-gray-900">Type</span>
                                        <span class="ml-6 flex items-center">
                                            <svg class="rotate-0 h-5 w-5 transform" x-description="Expand/collapse icon, toggle classes based on question open state." x-state:on="Open" x-state:off="Closed" :class="{ '-rotate-180': open, 'rotate-0': !(open) }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </h3>
                                <div class="pt-6" id="filter-section-1" x-cloak x-show="open">
                                    <div class="space-y-6">
                                        <div class="flex items-center">
                                            <input wire:model.live='type' value="legume" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 text-sm text-gray-500">Légumes</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input wire:model.live='type' value="fruit" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 text-sm text-gray-500">Fruits</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div x-data="{ open: false }" class="border-t border-gray-200 px-4 py-6">
                                <h3 class="-mx-2 -my-3 flow-root">
                                    <button type="button" x-description="Expand/collapse question button" class="flex w-full items-center justify-between bg-white px-2 py-3 text-sm text-gray-400" aria-controls="filter-section-2" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
                                        <span class="font-medium text-gray-900">Livraison</span>
                                        <span class="ml-6 flex items-center">
                                            <svg class="rotate-0 h-5 w-5 transform" x-description="Expand/collapse icon, toggle classes based on question open state." x-state:on="Open" x-state:off="Closed" :class="{ '-rotate-180': open, 'rotate-0': !(open) }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </h3>
                                <div class="pt-6" id="filter-section-2" x-cloak x-show="open">
                                    <div class="space-y-6">
                                        <div class="flex items-center">
                                            <input wire:model.live='delivery' value="hebdomadaire" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 text-sm text-gray-500">Hebdomadaire</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input wire:model.live='delivery' value="15jours" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 text-sm text-gray-500">15 Jours</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input wire:model.live='delivery' value="mensuel" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 text-sm text-gray-500">Mensuel</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input wire:model.live='delivery' value="trimestriel" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 text-sm text-gray-500">Trimestriel</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div x-data="{ open: false }" class="border-t border-gray-200 px-4 py-6">
                                <h3 class="-mx-2 -my-3 flow-root">
                                    <button type="button" x-description="Expand/collapse question button" class="flex w-full items-center justify-between bg-white px-2 py-3 text-sm text-gray-400" aria-controls="filter-section-3" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
                                        <span class="font-medium text-gray-900">Sizes</span>
                                        <span class="ml-6 flex items-center">
                                            <svg class="rotate-0 h-5 w-5 transform" x-description="Expand/collapse icon, toggle classes based on question open state." x-state:on="Open" x-state:off="Closed" :class="{ '-rotate-180': open, 'rotate-0': !(open) }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </h3>
                                <div class="pt-6" id="filter-section-3" x-cloak x-show="open">
                                    <div class="space-y-6">
                                        <div class="flex items-center">
                                            <input id="filter-mobile-sizes-0" name="sizes[]" value="s" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-mobile-sizes-0" class="ml-3 text-sm text-gray-500">S</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="filter-mobile-sizes-1" name="sizes[]" value="m" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-mobile-sizes-1" class="ml-3 text-sm text-gray-500">M</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="filter-mobile-sizes-2" name="sizes[]" value="l" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-mobile-sizes-2" class="ml-3 text-sm text-gray-500">L</label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>


            <div class="mx-auto max-w-3xl px-4 text-center sm:px-6 lg:max-w-7xl lg:px-8">
                <div class="py-10">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900">New Arrivals</h1>
                    <p class="mx-auto mt-4 max-w-3xl text-base text-gray-500">Thoughtfully designed objects for the workspace, home, and travel.</p>
                </div>

                <section aria-labelledby="filter-heading" class="border-t border-gray-200 py-6">
                    <h2 id="filter-heading" class="sr-only">Filtres des produits</h2>

                    <div class="flex items-center justify-between">
                        <div x-data="{open: false}" @keydown.escape.stop="open = false; focusButton()" class="relative inline-block text-left">
                            <div>
                                <button type="button" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" id="mobile-menu-button" x-ref="button" @click="open = !open" @keyup.space.prevent="onButtonEnter()" @keydown.enter.prevent="onButtonEnter()" aria-expanded="false" aria-haspopup="true" x-bind:aria-expanded="open.toString()" @keydown.arrow-up.prevent="onArrowUp()" @keydown.arrow-down.prevent="onArrowDown()">
                                    Sort
                                    <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" :class="{ '-rotate-180': open, 'rotate-0': !(open) }">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>


                            <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 z-10 mt-2 w-40 origin-top-left rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" x-ref="menu-items" x-description="Dropdown menu, show/hide based on menu state." role="menu" aria-orientation="vertical" aria-labelledby="mobile-menu-button" tabindex="-1" @keydown.arrow-up.prevent="onArrowUp()" @keydown.arrow-down.prevent="onArrowDown()" @keydown.tab="open = false" @keydown.enter.prevent="open = false; focusButton()" @keyup.space.prevent="open = false; focusButton()">
                                <div class="py-1" role="none">
                                    <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-900" x-state:on="Active" x-state:off="Not Active"  role="menuitem" tabindex="-1" id="mobile-menu-item-0" @mouseenter="onMouseEnter($event)" @mousemove="onMouseMove($event, 0)" @mouseleave="onMouseLeave($event)" @click="open = false; focusButton()">Most Popular</a>
                                    <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-900"  role="menuitem" tabindex="-1" id="mobile-menu-item-1" @mouseenter="onMouseEnter($event)" @mousemove="onMouseMove($event, 1)" @mouseleave="onMouseLeave($event)" @click="open = false; focusButton()">Best Rating</a>
                                    <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-900"  role="menuitem" tabindex="-1" id="mobile-menu-item-2" @mouseenter="onMouseEnter($event)" @mousemove="onMouseMove($event, 2)" @mouseleave="onMouseLeave($event)" @click="open = false; focusButton()">Newest</a>

                                </div>
                            </div>

                        </div>

                        <button type="button" x-description="Mobile filter dialog toggle, controls the 'mobileFilterDialogOpen' state." class="inline-block text-sm font-medium text-gray-700 hover:text-gray-900 sm:hidden" @click="open = !open">Filtres</button>

                        <div class="hidden sm:flex sm:items-baseline sm:space-x-8"  >
                            <div id="desktop-menu-0" class="relative inline-block text-left" x-data="{ open: false, focus: false }"  @keydown.escape="onEscape" @close-popover-group.window="onClosePopoverGroup" @click.away="open = false">
                                <div>
                                    <button type="button" class="group inline-flex items-center justify-center text-sm font-medium text-gray-700 hover:text-gray-900" @click="open = !open" aria-expanded="false" :aria-expanded="open.toString()">
                                        <span>Type d'achat</span>
                                        <span class="ml-1.5 rounded bg-gray-200 px-1.5 py-0.5 text-xs font-semibold tabular-nums text-gray-700 {{ count($type_purchase) == 0 ? 'hidden' : '' }}">{{ count($type_purchase) }}</span>
                                        <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" :class="{ '-rotate-180': open, 'rotate-0': !(open) }">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>


                                <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" x-ref="panel">
                                    <form class="space-y-4">
                                        <div class="flex items-center">
                                            <input wire:model.live='type_purchase' value="abonnements" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">Abonnements</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input wire:model.live='type_purchase' value="produits" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">Produits</label>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div id="desktop-menu-1" class="relative inline-block text-left" x-data="{ open: false, focus: false }"  @keydown.escape="onEscape" @close-popover-group.window="onClosePopoverGroup" @click.away="open = false">
                                <div>
                                    <button type="button" class="group inline-flex items-center justify-center text-sm font-medium text-gray-700 hover:text-gray-900" @click="open = !open" @mousedown="if (open) $event.preventDefault()" aria-expanded="false" :aria-expanded="open.toString()">
                                        <span>Type</span>
                                        <span class="ml-1.5 rounded bg-gray-200 px-1.5 py-0.5 text-xs font-semibold tabular-nums text-gray-700 {{ count($type) == 0 ? 'hidden' : '' }}">{{ count($type) }}</span>
                                        <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" :class="{ '-rotate-180': open, 'rotate-0': !(open) }">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>


                                <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" x-ref="panel" >
                                    <form class="space-y-4">
                                        <div class="flex items-center">
                                            <input wire:model.live='type' value="legume" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">Légumes</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input wire:model.live='type' value="fruit" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">Fruits</label>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div id="desktop-menu-2" class="relative inline-block text-left" x-data="{ open: false, focus: false }"  @keydown.escape="onEscape" @close-popover-group.window="onClosePopoverGroup" @click.away="open = false">
                                <div>
                                    <button type="button" class="group inline-flex items-center justify-center text-sm font-medium text-gray-700 hover:text-gray-900" @click="open = !open" @mousedown="if (open) $event.preventDefault()" aria-expanded="false" :aria-expanded="open.toString()">
                                        <span>Livraison</span>
                                        <span class="ml-1.5 rounded bg-gray-200 px-1.5 py-0.5 text-xs font-semibold tabular-nums text-gray-700 {{ count($delivery) == 0 ? 'hidden' : '' }}">{{ count($delivery) }}</span>
                                        <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" :class="{ '-rotate-180': open, 'rotate-0': !(open) }">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>


                                <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" x-ref="panel">
                                    <form class="space-y-4">
                                        <div class="flex items-center">
                                            <input wire:model.live='delivery' value="hebdmoadaire" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">Hebdomadaire</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input wire:model.live='delivery' value="15jours" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">15 Jours</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input wire:model.live='delivery' value="mensuel" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">Mensuel</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input wire:model.live='delivery' value="trimestriel" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">Trimestriel</label>
                                        </div>

                                    </form>
                                </div>

                            </div>
                            <div id="desktop-menu-3" class="relative inline-block text-left" x-data="{ open: false, focus: false }"  @keydown.escape="onEscape" @close-popover-group.window="onClosePopoverGroup" @click.away="open = false">
                                <div>
                                    <button type="button" class="group inline-flex items-center justify-center text-sm font-medium text-gray-700 hover:text-gray-900" @click="open = !open" @mousedown="if (open) $event.preventDefault()" aria-expanded="false" :aria-expanded="open.toString()">
                                        <span>Sizes</span>
                                        <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" :class="{ '-rotate-180': open, 'rotate-0': !(open) }">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>


                                <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" x-ref="panel">
                                    <form class="space-y-4">
                                        <div class="flex items-center">
                                            <input id="filter-sizes-0" name="sizes[]" value="s" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-sizes-0" class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">S</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="filter-sizes-1" name="sizes[]" value="m" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-sizes-1" class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">M</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="filter-sizes-2" name="sizes[]" value="l" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-sizes-2" class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">L</label>
                                        </div>

                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </section>

                <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:grid-cols-3 lg:gap-x-8 pt-5 pb-10">

                    @foreach ($products as $product)

                        <div class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white">
                            <div class="aspect-h-4 aspect-w-3 bg-gray-200 sm:aspect-none group-hover:opacity-75 sm:h-96">
                                <img src="https://www.longchamp.com/dw/image/v2/BCVX_PRD/on/demandware.static/-/Sites-LC-master-catalog/default/dwe3a4a125/images/DIS/L2605089001_3.png?sw=2000&sh=2000&sm=fit" alt="Eight shirts arranged on table in black, olive, grey, blue, white, red, mustard, and green." class="h-full w-full object-cover object-center sm:h-full sm:w-full">
                            </div>
                            <div class="flex flex-1 flex-col space-y-2 p-4">
                                <h3 class="text-sm font-medium text-gray-900">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $product->nom }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-500">Get the full lineup of our Basic Tees. Have a fresh shirt all week, and an extra for laundry day.</p>
                                <div class="flex flex-1 flex-col justify-end">
                                    <p class="text-sm italic text-gray-500"> {{$product->valeur_unite}} {{$product->unite}} </p>
                                    <p class="text-base font-medium text-gray-900">{{ $product->prix }} €</p>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>

    </div>
</div>
