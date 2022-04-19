</script>
<template>
<div class="cdSoPA">
    <div class="imKcX">
        <div class="iHQQge">
            <div class="dwBkBv">
                <span class="aSDSa">
                    <img :src="`/assets/images/prices-btc.svg`" alt="$" class="fWVtrR" />
                </span>
                <div class="hnDsPv">
                    <span>Bitcoin</span>
                </div>
            </div>
        </div>
        <div class="diPBzI">
            <div class="TwTQn fIGXEG">
                Bitcoin Balance Equivalent crypto.
            </div>
        </div>

        <div class="wLHkP">
            <div class="iTjPXI">
                <div class="fOLaCP">
                    <div class="bc__control css-yk16xz-control">
                        <div class="xMDjk">
                            <div class="ktVcJY">
                                <placeholder-rel v-if="isPending"></placeholder-rel>
                                <div class="hLxhAA">
                                    <span class="saERa"> BTC </span>
                                    Balance
                                </div>
                                <div class="cCSAKl">
                                    <div class="bhrzyc">
                                        <div class="bvcbYD">{{ amount }}</div>
                                    </div>
                                </div>
                                <div class="iiXlXC">Pending : 0.0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="iTjPXI hSasg">
                <div class="fOLaCP">
                    <div class="bc__control css-yk16xz-control" style="border-bottom:none">
                        <div class="xMDjk" style="padding:0">
                            <div class="ktVcJY iKSAas">
                                <iframe src="/btc_widget" id="content" class="iframe_c" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ijnvoB">
            <div class="container activities bAqwa" v-if="isPending || transactions.length > 0">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr v-if="!isPending">
                                <th v-for="col in columns" :key="col.label" :style="{ width: col.width + 'px' }">
                                    {{ col.label }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="isPending">
                                <td :colspan="columns.length" class="xSpacxea">
                                    <placeholder-rows :rows="10"></placeholder-rows>
                                </td>
                            </tr>
                            <template v-else>
                                <tr v-for="transaction in transactions" :key="transaction.id">
                                    <td>{{ transaction.address }}</td>
                                    <td>
                                        {{ transaction.amount }}
                                    </td>
                                    <td>{{ transaction.status }}</td>
                                    <td>{{ transaction.description ? transaction.description  :'-'}}</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="ijnvoB" v-if="!isPending && transactions.length < 1">
                <div class="dLQXQz">
                    <div class="eRPPjK">
                        <div class="xAsds">
                            <div class="cyNUmQ">Transactions</div>
                            <div class="iGsJkr">
                                All your {{ currency_note }} transactions
                                will show up here.
                            </div>
                            <div class="eRPPjK">
                                <button class="fSXgAS">
                                    Deposit In {{ currency_note }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
const REQUEST_DELAY = 4000;
const REQUEST_INTERVAL = 8000;
import PlaceholderRows from "../../components/Placeholder";
import PlaceholderRel from "../../components/PlaceholderRel";
import {
    mapGetters
} from "vuex";

export default {
    components: {
        PlaceholderRows,
        PlaceholderRel
    },
    data() {
        return {
            currency: "btc",
            currency_note: "Bitcoin",
            loading: true,
            amount: 0.0,
            crypto: "BTC",
            transactions: [],
            isPending: true,
            columns: [{
                    label: "Address",
                    width: 240,
                },
                {
                    label: "Balance",
                    width: 120,
                },
                {
                    label: "Status",
                    width: 160,
                },
                {
                    label: "Description",
                    width: 200,
                },
            ],
        };
    },
    watch: {
        getClientDetail() {
            this.setBalance();
        },
    },
    methods: {
        async setBalance() {
            this.isPending = true;
            const {
                data
            } = await axios.get(
                "/api/client/transactions"
            );
            this.transactions = data.data;
            window.setTimeout(() => {
                const data = this.$store.getters.getClientDetail;
                this.amount = data.fiat_balances[this.currency];
                this.isPending = false;
            }, REQUEST_DELAY);
        },
    },
    created() {
        this.setBalance();
    },
};
</script>
