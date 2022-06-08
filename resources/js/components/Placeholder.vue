<template>
<div class="placeholder-rows">
    <div v-for="row in rows" :key="'p-row-' + row" :class="['placeholder-row', { placeholder: !cells }]" :style="{ height: height + 'px', margin: spacing + 'px 0' }">
        <div v-for="cell in cells" :key="'p-cell-' + cell" class="placeholder placeholder-cell"></div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        rows: {
            type: Number,
            default: 3,
        },
        cells: {
            type: Number,
            default: 0,
        },
        height: {
            type: Number,
            default: 28,
        },
        spacing: {
            type: Number,
            default: 5,
        },
    },
};
</script>
