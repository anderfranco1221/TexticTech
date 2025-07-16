
<script src="./LogginView.ts" lang="ts"></script>

<template>
    <div class="background-loggin">
        <div
            class="card-loggin bg-primary" @keydown.enter="handleSubmit">
            <img src="../../assets/image/logo-white.png" class="h-50 w-auto"/>

            <div class="mt-6 w-80">
                <label for="username" class="text-md">
                    Usuario
                </label>
                <input class="bg-muted" type="text" placeholder="Email" id="username" v-model="email"/>
            </div>
            <div class="mt-6 w-80 pt-3.5">
                <label for="password" class="text-md">
                    Contraseña
                </label>
                <input class="bg-muted" type="password" placeholder="Contraseña" id="password" v-model="password"/>
            </div>
            <div class="mt-6 pt-8">
                <button @click="handleSubmit">
                    Ingresar
                </button>
            </div>
        </div>
    </div>
</template>

