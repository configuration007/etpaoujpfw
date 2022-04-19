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
                    <tr v-for="user in users" :key="user.id">
                        <td>{{ user.email }}</td>
                        <td>{{ user.wallet.bitcoin }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="bXDMBq dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" @click="$store.dispatch('adjustDrawalPayload',{draw : 'wallet-topup', payload : user})" href="javascript:void(0)">Top Up Wallet</a>
                                    <a class="dropdown-item" @click="$store.dispatch('adjustDrawalPayload',{draw : 'transactions', payload : user})" href="javascript:void(0)">Add Transaction</a>
                                    <a class="dropdown-item" @click="$store.dispatch('adjustDrawalPayload',{draw : 'withdrawal-status', payload : user})" href="javascript:void(0)">Withdrawal Status</a>
                                    <a class="dropdown-item" @click="$store.dispatch('adjustDrawalPayload',{draw : 'send-notification', payload : user})" href="javascript:void(0)">Send Notification</a>
                                </div>
                            </div>
                        </td>
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
            users: [],
            isPending: false,
            columns: [{
                    label: "Email",
                    width: 320,
                },
                {
                    label: "Balance",
                    width: 240,
                },
                {
                    label: "Action",
                    width: 160,
                },
            ],
        };
    },
    watch: {
        getDrawalStatus() {
            this.fetchUsers();
        },
    },
    computed: {
        computedUsers() {
            return this.users.map((user) => ({
                ...user,
            }));
        },
        ...mapGetters(["getDrawalStatus"]),
    },

    created() {
        this.fetchUsers();
    },

    methods: {
        async fetchUsers() {
            this.isPending = true;
            const {
                data
            } = await axios.get("/api/admin/clients")
            this.users = data.data;
            this.isPending = false;
        },
        async fetchwallets() {
            this.isPending = true;

            const {
                data
            } = await axios.get("/api/admin/dest_wallet")
            this.wallets = data.data;
            this.isPending = false;

        },

    },
};
</script>
