<script setup>
import Card from '../Components/Card.vue'
import PaginationLinks from '../Components/PaginationLinks.vue'
import InputField from '../Components/InputField.vue'
import { router, useForm } from '@inertiajs/vue3'

const params = route().params;
 
const props = defineProps({
    bookListings: Object,
    searchTerm: String,
});

const form = useForm({
    search: props.searchTerm,
});

const search = () => {
    router.get(route("home"), { search: form.search, user_id: params.user_id, type: params.type, });
};

</script>

<template>
    
    <Head title="- Latest Books Listings" />

    <div class="flex items-center justify-between mb-4">
        <div>filters</div>

        <div class="w-1/4">
            <form @submit.prevent="search">
                <InputField
                    type="search"
                    label=""
                    icon="magnifying-glass"
                    placeholder="Search..."
                    v-model="form.search"
                />
            </form>
        </div>
    </div>

  
    <div v-if="Object.keys(bookListings.data).length">
      <div class="grid grid-cols-3 gap-4">
        <div v-for="bookListing in bookListings.data" :key="bookListing.id">
            <Card :bookListing="bookListing" />
        </div>
      </div>
      <div class="mt-8">
        <PaginationLinks :paginator="bookListings" />
      </div>
    </div>
    <div v-else>There are no books</div>
  </template>
  