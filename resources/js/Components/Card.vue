<script setup>
import { ref, nextTick } from 'vue';
import { router } from '@inertiajs/vue3';

const params = route().params;

defineProps({
    bookListing: Object,
});

// Toast state
const showToast = ref(false);
const toastMessage = ref('');

// Handle "Borrow" button click
const borrowBook = async (id) => {
    try {
        await router.post(route('borrow.book'), { book_listing_id: id });
        // On success, show toast
        toastMessage.value = 'Successfully added to your book section!';
        showToast.value = true;
        // Wait for the next DOM update and hide after 3 seconds
        await nextTick();
        setTimeout(() => {
            showToast.value = false;
        }, 3000);
    } catch (error) {
        // If an error occurs, handle it and show an error toast
        toastMessage.value = 'Failed to borrow the book. Please try again.';
        showToast.value = true;
        setTimeout(() => {
            showToast.value = false;
        }, 3000);
    }
};

const selectUser = (id) => {
    router.get(route("home"), {
        user_id: id,
        search: params.search,
        type: params.type,
    });
};

const selectType = (type) => {
    router.get(route("home"), {
        user_id: params.user_id,
        search: params.search,
        type: type,
    });
};
</script>

<template>
    <div class="relative">
        <!-- Toast Notification -->
        <div
            v-if="showToast"
            class="fixed bottom-4 right-4 p-4 bg-green-500 text-white rounded shadow-lg transition-transform transform"
        >
            {{ toastMessage }}
        </div>

        <!-- Card with uniform color -->
        <div class="bg-blue-50 dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden h-full flex flex-col justify-between transition-transform hover:scale-105 hover:shadow-2xl min-h-[400px] flex-grow">
            <div>
                <!-- Image -->
                <!-- <Link href="">
                    <img 
                        :src="bookListing.image
                        ? `/storage/${bookListing.image}` 
                        : '/storage/images/bookListing/default.jpg'" 
                        class="w-full h-48 object-cover object-center bg-slate-300" 
                        alt="" 
                    />
                </Link> -->

                <!-- Title & user -->
                <div class="p-4 text-gray-900 dark:text-white">
                    <!-- Title -->
                    <h3 class="font-bold text-xl mb-2 text-blue-600">
                        {{ bookListing.title.substring(0, 40) }}...
                    </h3>

                    <!-- User Info (commented) -->
                    <!-- <p class="text-gray-600 dark:text-gray-400">Listed on {{ new Date(bookListing.created_at).toLocaleDateString() }} by
                        <button class="text-blue-500 hover:underline" @click="selectUser(bookListing.user.id)">
                            {{ bookListing.user.name }}
                        </button>
                    </p> -->

                    <!-- Description -->
                    <h3 class="text-lg mb-2 text-gray-700 dark:text-gray-300">
                        {{ bookListing.description.substring(0, 300) }}...
                    </h3>

                    <!-- Genre/Type with button -->
                    <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">
                        Genre / type: 
                        <button class="text-blue-500 hover:underline" @click="selectType(bookListing.type)">
                            {{ bookListing.type }}
                        </button>
                    </p>

                    <!-- Price -->
                    <p class="text-lg font-bold text-green-600 mt-2">Rs. {{ bookListing.price }}</p>

                    <!-- Borrow Button -->
                    <button 
                        class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300"
                        @click="borrowBook(bookListing.id)">
                        Borrow
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
