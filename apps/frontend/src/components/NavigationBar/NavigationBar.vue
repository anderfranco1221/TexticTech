<script src="./NavigationBar.ts" lang="ts">

</script>

<template>
  <nav class="bg-primary ">
    <div class="mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <button type="button"
            class="relative inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:outline-hidden focus:ring-inset"
            aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!-- Icon when menu is closed.
                            Menu open: "hidden", Menu closed: "block"
                        -->
            <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
              aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!--
                            Icon when menu is open.
                            Menu open: "block", Menu closed: "hidden"
                        -->
            <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
              aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex flex-1 items-center justify-center  sm:justify-start">
          <div class="flex pr-5 shrink-0 items-center">
            <img class="h-20 w-20" src="../../assets/image/logo-white.png" alt="TexticTech" loading="lazy" />
          </div>
          <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-4">
              <!-- Current: "bg-secondary text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <router-link to="/dashboard" class="rounded-md  px-3 py-2 text-sm font-medium text-white"
                :class="routeName === 'dashboard' ? 'bg-secondary' : ''" aria-current="page">Dashboard</router-link>

              <div class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-secondary hover:text-white">
                <button class="cursor-pointer" type="button" id="menu-articulos" aria-expanded="true"
                  aria-haspopup="true" @click="toggleDropdown('articles')">
                  Articulos
                </button>
                <div role="menu" aria-orientation="vertical" aria-labelledby="menu-articulos" tabindex="-1"
                  class="absolute z-10 mt-2 w-auto origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden"
                  v-show="dropdown.articles">
                  <div class="py-1" role="none">
                    <router-link to="categories" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                      tabindex="-1" id="menu-item-0">
                      Categoria
                    </router-link>
                    <router-link to="products" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                      tabindex="-1" id="menu-item-0">
                      Productos
                    </router-link>
                    <router-link to="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                      id="menu-item-0">
                      Materiales
                    </router-link>
                  </div>
                </div>
              </div>
              <div class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-secondary hover:text-white">
                <button class="cursor-pointer" type="button" id="menu-articulos" aria-expanded="true"
                  aria-haspopup="true" @click="toggleDropdown('orders')">
                  Órdenes
                </button>
                <div role="menu" aria-orientation="vertical" aria-labelledby="menu-articulos" tabindex="-1"
                  class="absolute z-10 mt-2 w-auto origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden"
                  v-show="dropdown.orders">
                  <div class="py-1" role="none">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                      id="menu-item-0">
                      Órdenes de venta
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                      id="menu-item-1">
                      Órdenes de Compra
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                      id="menu-item-2">
                      Órdenes de Producción
                    </a>
                  </div>
                </div>
              </div>
              <a href="#"
                class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-secondary hover:text-white">Empresas</a>
              <div class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-secondary hover:text-white">
                <button class="cursor-pointer" type="button" id="menu-articulos" aria-expanded="true"
                  aria-haspopup="true" @click="toggleDropdown('admin')">
                  Administración
                </button>

                <div role="menu" aria-orientation="vertical" aria-labelledby="menu-articulos" tabindex="-1"
                  class="absolute z-10 mt-2 w-auto origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden"
                  v-show="dropdown.admin">
                  <div class="py-1" role="none">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                      id="menu-item-0">
                      Configuracion de productos
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                      id="menu-item-1">
                      Órdenes de Compra
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                      id="menu-item-2">
                      Usuarios
                    </a>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">


          <!-- Profile dropdown -->
          <div class="relative ml-3">
            <div>
              <button type="button"
                class="relative flex rounded-full bg-gray-800 text-sm focus:outline-hidden focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-gray-800"
                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Open user menu</span>
                <img class="size-8 rounded-full"
                  src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                  alt="" />
              </button>
            </div>

            <!--
            Dropdown menu, show/hide based on menu state.

            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->
            <div v-if="1 != 1"
              class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-hidden"
              role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
              <!-- Active: "bg-gray-100 outline-hidden", Not Active: "" -->
              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                id="user-menu-item-0">Your Profile</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                id="user-menu-item-1">Settings</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                id="user-menu-item-2">Sign out</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pt-2 pb-3">
        <!-- Current: "bg-secondary text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <div class="block rounded-md px-3 py-2 text-base font-medium text-white"
          :class="routeName === 'dashboard' ? 'bg-secondary' : ''">
          <a href="#" class="block" aria-current="page">Dashboard</a>
        </div>
        <div class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
          <button type="button" id="menu-articulos-mobile" aria-expanded="true" aria-haspopup="true"
            class="w-full text-left" @click="toggleDropdown('articles')">
            Articulos
          </button>
        </div>
        <div class="block rounded-md px-3 py-2 text-base font-medium divide-y divide-gray-500"
          v-show="dropdown.articles">
          <router-link to="categories" class="block px-4 py-2 text-sm text-gray-700 dark:text-white">
            Categoria
          </router-link>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-white">
            Productos
          </a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-white">
            Materiales
          </a>
        </div>
        <div class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
          <button type="button" id="menu-articulos-mobile" aria-expanded="true" aria-haspopup="true"
            class="w-full text-left" @click="toggleDropdown('orders')">
            Órdenes
          </button>
        </div>
        <div class="block rounded-md px-3 py-2 text-base font-medium divide-y divide-gray-500" v-show="dropdown.orders">
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-white">
            Órdenes de venta
          </a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-white">
            Órdenes de Compra
          </a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-white">
            Órdenes de Producción
          </a>
        </div>
        <a href="#"
          class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Empresas</a>
        <div class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
          <button type="button" id="menu-articulos-mobile" aria-expanded="true" aria-haspopup="true"
            class="w-full text-left" @click="toggleDropdown('admin')">
            Administración
          </button>

          <div class="block rounded-md px-3 py-2 text-base font-medium divide-y divide-gray-500"
            v-show="dropdown.admin">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-white">
              Configuracion de productos
            </a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-white">
              Usuarios
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>

</template>
