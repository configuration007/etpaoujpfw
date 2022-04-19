<template>
<div class="container mx-auto my-2 px-2 activities">
    <div class="table-container">
        <button type="button" class="bXDMBq" @click="
                    $store.dispatch('adjustDrawalPayload', {
                        draw: 'wallet-settings',
                        payload: null,
                    })
                ">
            Action
        </button>
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
                    <tr v-for="wallet in wallets" :key="wallet.id">
                        <td>{{ wallet.name }}</td>
                        <td>{{ wallet.address }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="bXDMBq dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" @click="
                                                $store.dispatch(
                                                    'adjustDrawalPayload',   
                                                    {
                                                        draw: 'wallet-settings',
                                                        payload: wallet,
                                                    }
                                                )
                                            " href="javascript:void(0)">Edit</a>
                                    <a class="dropdown-item" @click="deleteWallet(wallet.id)" href="javascript:void(0)">Delete</a>
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
            wallets: [],
            isPending: false,
            columns: [{
                    label: "Name",
                    width: 320,
                },
                {
                    label: "Address",
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
            this.fetchwallets();
        },

    },
    computed: {
        computedwallets() {
            return this.wallets.map((wallet) => ({
                ...wallet,
            }));
        },
        ...mapGetters(["getDrawalStatus"]),
    },

    created() {
        this.fetchwallets();
    },

    methods: {
        async deleteWallet(id) {
            this.isPending = true;

            const {
                data
            } = await axios.delete("/api/admin/dest_wallet/" + id)
            this.fetchwallets()
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
