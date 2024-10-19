<script setup>
import Card from '../Components/Card.vue'

defineProps({
    bookListings: Object,
})
</script>

<template>
    
    <Head title="- Latest Books Listings" />
  
    <div v-if="Object.keys(bookListings.data).length">
      <div class="grid grid-cols-3 gap-4">
        <div v-for="bookListing in bookListings.data" :key="bookListing.id">
            <Card :bookListing="bookListing" />
        </div>
      </div>
    </div>
  </template>
  