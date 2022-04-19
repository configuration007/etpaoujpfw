<template>
    <div class="placeholder-rows"  :style="{ height: height, width: width }">
        <div
            :class="['placeholder-row']"
            :style="{ height: '100%', width: '100%' }"
        >
            <div class="placeholder placeholder-cell"></div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        height: {
            type: String,
            default: "100%",
        },
        width: {
            type: String,
            default: "100%",
        },
    },
};
</script>
