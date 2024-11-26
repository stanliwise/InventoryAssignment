<script setup>
import { computed } from  'vue';

const props = defineProps({
    currentPage: { type: Number, default: 1},
    total: { type: Number, default: 1 },
    perPage: { type: Number, default: 10 }
});

let pages = computed(() => Math.ceil(total/perPage));
</script>
<template>

    <div>
        <p>Page {{ currentPage }} of {{ pages }}</p>
        <div>
            <button @click="currentPage = Math.max(1, currentPage - 1)">Previous</button>
            <button @click="currentPage = Math.min(total, currentPage + 1)">Next</button>
        </div>
        <div>
            <template v-for="page in Array(total).fill().map((v, i) => i + 1)" :key="page">
                <button :class="{ active: page === currentPage }" @click="currentPage = page">{{ page }}</button>
            </template>
        </div>
    </div>
</template>
