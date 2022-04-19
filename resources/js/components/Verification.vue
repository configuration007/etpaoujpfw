<template>
    <div class="status_icon">
        <div class="image_holder">
            <img :src="`/assets/images/${status}.gif`" />
        </div>
        <div class="text_holder">
            <span v-if="status == 'processing'">Verification in progress</span>
            <span v-if="status == 'failed'">Verification failed</span>
            <span v-if="status == 'verified'">Verification completed</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ["status"],
    mounted() {
        console.log("Component mounted.");
    },
};
</script>
