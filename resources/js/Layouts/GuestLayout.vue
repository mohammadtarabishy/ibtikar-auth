<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex flex-col">
<!--        <div>-->
<!--            <Link href="/">-->
<!--                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />-->
<!--            </Link>-->
<!--        </div>-->

<!--        <div-->
<!--            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"-->
<!--        >-->
<!--        </div>-->
        <slot />

    </div>

</template>
