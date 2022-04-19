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
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.name  ? '-' : '-'}}</td>
                            <td>{{ user.email  ? '-' : '-' }}</td>
                            <td>{{ user.phone   ? '-' : '-'}}</td>
                            <td>{{ user.company.name   ? '-' : '-'}}</td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
const REQUEST_DELAY = 4000;
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
            users: [],
            isPending: false,
            columns: [
                { label: "Tag", width: 160 },
                { label: "Description", width: 240 },
                { label: "Status", width: 160 },
                { label: "Block Ref", width: 160 },
            ],
        };
    },
    computed: {
        computedUsers() {
            return this.users.map((user) => ({
                ...user,
            }));
        },
    },
    created() {
        this.fetchUsers();
        // window.setInterval(this.fetchUsers, REQUEST_INTERVAL);
    },
    methods: {
        fetchUsers() {
            this.isPending = true;

            window.setTimeout(() => {
                fetch("https://jsonplaceholder.typicode.com/users")
                    .then((response) => response.json())
                    .then((res) => {
                        this.users = res;
                        this.isPending = false;
                    });
            }, REQUEST_DELAY);
        },
    },
};
</script>
