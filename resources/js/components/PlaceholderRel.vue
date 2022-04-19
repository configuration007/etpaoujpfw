<template>
    <div class="placeholder-rows sdeQSa"  :style="{ height: height, width: width }">
        <div
            :class="['placeholder-row sAdeQa']"
            :style="{ height: '100%', width: '100%' }"
        >
            <div class="placeholder placeholder-cell cAcca"></div>
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
