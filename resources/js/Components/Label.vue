<script setup lang="ts">
defineProps<{
    value?: string;
    classData?: string
}>();
</script>

<template>
    <label :class="classData ?? 'block font-medium text-sm text-gray-700'">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
