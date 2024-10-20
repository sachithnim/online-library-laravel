<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

// Get borrowed books data passed from the controller
const page = usePage();
const borrowedBooks = computed(() => page.props.borrowedBooks);
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold">My Borrowed Books</h1>
        <ul>
            <li v-for="book in borrowedBooks" :key="book.id" class="p-4 border">
                <h3 class="text-xl font-semibold">{{ book.book_listing.title }}</h3>
                <p>{{ book.book_listing.description }}</p>
                <p>Borrowed on: {{ new Date(book.created_at).toLocaleDateString() }}</p>
            </li>
        </ul>
    </div>
</template>
