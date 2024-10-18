<script setup>
import NavLink from '@/Components/NavLink.vue';

</script>

<template>
    <header class="bg-slate-800 text-white">
        <nav class="p-6 mx-auto max-w-screen-lg">

            <NavLink routeName="home" componentName="Home">Home</NavLink>

            <NavLink routeName="login" componentName="Auth/Login">Login</NavLink>

            <NavLink routeName="register" componentName="Auth/Register">Register</NavLink>

        </nav>
    </header>

    <main class="p-6">
        <slot />
    </main>
</template>
