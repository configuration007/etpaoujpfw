<template>
    <div class="container mx-auto my-2 px-2 activities">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th
                            v-for="col in columns"
                            :key="col.label"
                            :style="{ width: col.width + 'px' }"
                        >
                            {{ col.label }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="isPending">
                        <td :colspan="columns.length">
                            <placeholder-rows :rows="10"></placeholder-rows>
                        </td>
                    </tr>
                    <template v-else>
                        <tr v-for="log in logs" :key="log.id">
                            <td>{{ log.ip  ? log.ip : '-'}}</td>
                            <td>{{ log.description  ? log.description : '-' }}</td>
                            <td>{{ log.created_at   ? log.created_at  : '-'}}</td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
const REQUEST_DELAY = 1000;
const REQUEST_INTERVAL = 8000;

const PlaceholderRows = {
    name: "PlaceholderRows",
    // functional: true,
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
    template: `
        <div class="placeholder-rows">
            <div            
                v-for="row in rows" 
                :key="'p-row-' + row"  
                :class="['placeholder-row', { placeholder: !cells }]"
                :style="{ height: height + 'px', margin: spacing + 'px 0' }"
            >
                <div 
                     v-for="cell in cells" 
                     :key="'p-cell-' + cell" 
                     class="placeholder placeholder-cell"
                ></div>
            </div>
        </div>
    `,
};

export default {
    components: {
        PlaceholderRows,
    },
    data() {
        return {
            logs: [],
            isPending: false,
            columns: [
                { label: "Ip", width: 160 },
                { label: "Description", width: 240 },
                { label: "Date", width: 160 },
            ],
        };
    },
    computed: {
        computedLogs() {
            return this.logs.map((log) => ({
                ...log,
            }));
        },
    },
    created() {
        this.fetchLogs();
        // window.setInterval(this.fetchLogs, REQUEST_INTERVAL);
    },
    methods: {
        fetchLogs() {
            this.isPending = true;

            window.setTimeout(() => {
                axios.get("/api/client/logs")
                    .then(({data}) => {
console.log(data.data);
                        this.logs = data.data;
                        this.isPending = false;
                    });
            }, REQUEST_DELAY);
        },
    },
};
</script>
