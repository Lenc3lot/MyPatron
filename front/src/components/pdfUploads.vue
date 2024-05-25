<template>
    <input type="file" @change="onChange($event)" multiple>
</template>

<script>
export default {
    props: ['modelValue'],
    methods: {
        onChange(event) {
            this.$emit('update:modelValue', event.target.files);
        },
    },
};
</script>