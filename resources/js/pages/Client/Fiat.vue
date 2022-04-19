<template>
<div class="cdSoPA">
    <div class="imKcX">
        <div class="iHQQge">
            <div class="dwBkBv">
                <span class="aSDSa">
                    <img :src="`/assets/images/${currency}.png`" alt="$" class="fWVtrR" />
                </span>
                <div class="hnDsPv">
                    <span>{{ currency_note }}</span>
                </div>
            </div>
        </div>
        <div class="diPBzI">
            <div class="TwTQn fIGXEG">
                {{ currency_note }} Balance Equivalent crypto.
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
                                    <span class="saERa">{{
                                            currency
                                        }}</span>
                                    Balance
                                </div>
                                <div class="cCSAKl">
                                    <div class="bhrzyc">
                                        <div class="bvcbYD">
                                            $ {{ amount }}
                                        </div>
                                    </div>
                                </div>
                                <div class="iiXlXC">Pending : 0.0</div>
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
            currency: "",
            currency_note: "",
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
        "$route.params.id": function (id) {
            this.setCrypto();
            this.setBalance();
        },
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
                "/api/client/transaction/" + this.currency
            );
            this.transactions = data.data;
            window.setTimeout(() => {
                this.currency = this.$route.params.id;
                const data = this.$store.getters.getClientDetail;
                this.amount = data.fiat_balances[this.currency];
                this.isPending = false;
            }, REQUEST_DELAY);
        },
        setCrypto() {
            var id = (this.currency = this.$route.params.id);

            if (id == "usd") {
                this.currency_note = "US Dollar";
            } else if (id == "gbp") {
                this.currency_note = "British Pound";
            } else if (id == "eur") {
                this.currency_note = "Euro";
            } else {
                alert("Invalid Currency");
            }
        },
    },
    created() {
        this.setCrypto();
        this.setBalance();
    },
};
</script>
