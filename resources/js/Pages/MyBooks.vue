<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

// Get borrowed books data passed from the controller
const page = usePage();
const borrowedBooks = ref([...page.props.borrowedBooks]); // Mutable version of borrowedBooks to update in-place

// Toast state
const showToast = ref(false);
const toastMessage = ref('');

// Method to remove a borrowed book
const removeBook = (id) => {
    if (confirm("Are you sure you want to remove this book from your borrowed list?")) {
        // Send a DELETE request to remove the book
        router.delete(route('borrowedBooks.remove', id), {
            onSuccess: () => {
                // Find the index of the removed book and remove it from the list
                const index = borrowedBooks.value.findIndex(book => book.id === id);
                if (index !== -1) {
                    borrowedBooks.value.splice(index, 1); // Remove book from the list
                }

                // Show success toast message
                toastMessage.value = 'Book successfully removed from your borrowed list.';
                showToast.value = true;

                // Hide the toast after 3 seconds
                setTimeout(() => {
                    showToast.value = false;
                }, 3000);
            },
            onError: () => {
                // Show error toast message
                toastMessage.value = 'Failed to remove the book. Please try again.';
                showToast.value = true;
                setTimeout(() => {
                    showToast.value = false;
                }, 3000);
            }
        });
    }
};

// Computed property to count the number of borrowed books
const borrowedBooksCount = computed(() => borrowedBooks.value.length);

</script>

<template>
    <div>
        <h1 class="text-2xl font-bold py-10 px-4">My Borrowed Books ({{ borrowedBooksCount }})</h1>
        
        <!-- Toast Notification -->
        <div
            v-if="showToast"
            class="fixed bottom-4 right-4 p-4 bg-green-500 text-white rounded shadow-lg transition-transform transform"
        >
            {{ toastMessage }}
        </div>

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

        <!-- Message when no books are borrowed -->
        <p v-if="borrowedBooksCount === 0" class="text-gray-500 mt-4">You have no borrowed books at the moment.</p>
    </div>
</template>
