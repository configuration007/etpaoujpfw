<template>
<div class="container mx-auto my-2 px-2 activities">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th v-for="col in columns" :key="col.label" :style="{ width: col.width + 'px' }">
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
                    <tr v-for="transaction in transactions" :key="transaction.id">
                        <td>{{ transaction.amount }}</td>
                        <td>{{ transaction.user ? transaction.user.email : '-' }}</td>
                        <td>{{ transaction.created_at }}</td>
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
import PlaceholderRows from "../../components/Placeholder";
import {
    mapGetters
} from "vuex";

export default {
    components: {
        PlaceholderRows,
    },
    data() {
        return {
            transactions: [],
            isPending: false,
            columns: [{
                    label: "Amount",
                    width: 320,
                },
                {
                    label: "Client Email",
                    width: 240,
                },
                {
                    label: "Date",
                    width: 160,
                },
            ],
        };
    },
    created() {
        this.fetchtransactions();
    },
    methods: {

        async fetchtransactions() {
            this.isPending = true;

            const {
                data
            } = await axios.get("/api/admin/dest_transaction")
            this.transactions = data.data;
            this.isPending = false;

        },
    },
};
</script>
