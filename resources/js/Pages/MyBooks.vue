<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

// Get borrowed books data passed from the controller
const page = usePage();
const borrowedBooks = computed(() => page.props.borrowedBooks);

// Method to remove a borrowed book
const removeBook = (id) => {
    if (confirm("Are you sure you want to remove this book from your borrowed list?")) {
        // Send a DELETE request to remove the book
        router.delete(route('borrowedBooks.remove', id), {
            onSuccess: () => {
                // Optionally refresh the page or handle book removal in the frontend
            }
        });
    }
};
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold">My Borrowed Books</h1>
        <ul>
            <li v-for="book in borrowedBooks" :key="book.id" class="p-4 border">
                <h3 class="text-xl font-semibold">{{ book.book_listing.title }}</h3>
                <p>{{ book.book_listing.description }}</p>
                <p>Borrowed on: {{ new Date(book.created_at).toLocaleDateString() }}</p>
                
                <!-- Remove button -->
                <button
                    class="mt-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-300"
                    @click="removeBook(book.id)"
                >
                    Remove
                </button>
            </li>
        </ul>
    </div>
</template>
