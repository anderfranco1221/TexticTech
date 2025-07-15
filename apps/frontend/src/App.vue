<script setup lang="ts">
  import NavigationBar  from "./components/NavigationBar/NavigationBar.vue";
  //import WelcomeItem from './WelcomeItem.vue'
  import { routeLocationKey, RouterLink, RouterView } from 'vue-router'
  import { ref, onMounted } from 'vue'

/* const isDark = ref(false)

// Función para alternar el tema
const toggleTheme = () => {
  isDark.value = !isDark.value
  updateTheme()
}

// Función para actualizar el tema
const updateTheme = () => {
  if (isDark.value) {
    document.documentElement.classList.add('dark')
    localStorage.setItem('theme', 'dark')
  } else {
    document.documentElement.classList.remove('dark')
    localStorage.setItem('theme', 'light')
  }
}

// Cargar tema guardado al montar el componente
onMounted(() => {
  const savedTheme = localStorage.getItem('theme')
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches
  
  isDark.value = savedTheme === 'dark' || (!savedTheme && prefersDark)
  updateTheme()
}) */
</script>

<template>
  <!-- <div class="min-h-screen bg-background text-foreground transition-colors">
    
    <button 
      @click="toggleTheme"
      class="fixed top-4 right-4 p-2 rounded-lg bg-primary text-white hover:opacity-80 transition-opacity"
    >
      {{ isDark ? '☀️' : '🌙' }}
    </button>
    
    
    <div class="container mx-auto p-8">
      <h1 class="text-4xl font-bold text-foreground mb-8">
        Mi App con Tema Claro/Oscuro
      </h1>
      
      <div class="bg-muted border border-border rounded-lg p-6">
        <p class="text-foreground">
          Este contenido se adapta automáticamente al tema.
        </p>
      </div>
    </div>
  </div> -->
  


  <div v-if="$route.meta.requirestAuth">
    <NavigationBar />
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
  

  
  <RouterView />
</template>
