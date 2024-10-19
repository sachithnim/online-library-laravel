<script setup>
import { router } from '@inertiajs/vue3'

const params = route().params;

defineProps({
    bookListing: Object,
})

const selectUser = (id) => {
    // Make sure the router is sending the correct request with user_id
    router.get(route("home"), {
        user_id: id,
        search: params.search,
    });
};
</script>

<template>
    <div class="bg-white rounded-lg shadow-lg overflow-hidden dark:bg-slate-800 h-full flex flex-col justify-between">
        <div>
            <!-- Image -->
            <Link href="">
                <img 
                    :src="bookListing.image
                    ? `/storage/${bookListing.image}`
                    : '/storage/images/bookListing/default.jpg'" 
                    class="w-full h-48 object-cover object-center bg-slate-300" 
                    alt="" 
                />
            </Link>

            <!-- Title & user -->
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">
                    {{ bookListing.title.substring(0, 40) }}...
                </h3>

                <p>Listed on {{ new Date(bookListing.created_at).toLocaleDateString() }} by
                    <button class="text-link" @click="selectUser(bookListing.user.id)">
                        {{ bookListing.user.name }}
                    </button>
                </p>

                <p>Genre / type : {{ bookListing.type }}</p>
            </div>
        </div>
    </div>
</template>
