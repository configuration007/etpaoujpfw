<template>
<section class="h_me">
    <div class="home-col">

        <div class="box" style="min-height: 500px !important">
            <div class="hialXu">
                <div class="hOOOSa">
                    <span>total Balance</span>
                </div>
                <placeholder-div v-if="i_balance"></placeholder-div>
                <div class="bIZTTX" v-else>
                    <div class="dsdsds_1">{{ total }}</div>
                    <div class="dsdsds_2">
                        {{ this.crypto_balance
                            }}<span class="xsdsd"> {{ this.crypto }}</span>
                    </div>
                </div>
            </div>
            <div class="_min_nav">
                <span class="active" @click="getWalletBalance">
                    Total
                </span>
                <span> Wallet </span>
                <span> Hardware </span>
            </div>
            <div class="_boodyy">
                <div class="ePAgsD">
                    <div class="_mIRg">
                        <div class="dfUVbO">
                            <span class="_IcN">
                                <div class="coin-icon">&#36;</div>
                            </span>
                            <span class="_TnxT"> U.S Dollars </span>
                        </div>

                        <placeholder-div v-if="i_balance"></placeholder-div>
                        <div class="dqvKQV" v-else>
                            <div class="dmeMyq">
                                {{ balances.usd | addComma }}
                            </div>
                            <div class="kTdwvR">{{ balances.btc }} BTC</div>
                        </div>
                    </div>
                </div>
                <div class="ePAgsD">
                    <div class="_mIRg">
                        <div class="dfUVbO">
                            <span class="_IcN">
                                <div class="coin-icon">&pound;</div>
                            </span>
                            <span class="_TnxT">British Pounds </span>
                        </div>

                        <placeholder-div v-if="i_balance"></placeholder-div>
                        <div class="dqvKQV" v-else>
                            <div class="dmeMyq">
                                {{ balances.gbp | addComma }}
                            </div>

                            <div class="kTdwvR">{{ balances.btc }} BTC</div>
                        </div>
                    </div>
                </div>
                <div class="ePAgsD">
                    <div class="_mIRg">
                        <div class="dfUVbO">
                            <span class="_IcN">
                                <div class="coin-icon">&euro;</div>
                            </span>
                            <span class="_TnxT"> Euros </span>
                        </div>

                        <placeholder-div v-if="i_balance"></placeholder-div>
                        <div class="dqvKQV" v-else>
                            <div class="dmeMyq">
                                {{ balances.eur | addComma }}
                            </div>

                            <div class="kTdwvR">{{ balances.btc }} BTC</div>
                        </div>
                    </div>
                </div>
                <div class="ePAgsD" style="padding-bottom: 65px">
                    <div class="_mIRg">
                        <div class="dfUVbO">
                            <span class="_IcN">
                                <div class="coin-icon">&yen;</div>
                            </span>
                            <span class="_TnxT"> Chinese Yen </span>
                        </div>

                        <placeholder-div v-if="i_balance"></placeholder-div>
                        <div class="dqvKQV" v-else>
                            <div class="dmeMyq">
                                {{ balances.jpy | addComma }}
                            </div>

                            <div class="kTdwvR">{{ balances.btc }} BTC</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="home-col maxi">
        <div class="box widget basNas">
            <div class="controlBtns">
                <button class="gzzwuM" @click="$store.dispatch('sendBitcoin', true)">
                    Send
                </button>
                <button class="gzzwuM" @click="$store.dispatch('recieveBitcoin', true)">
                    Recieve
                </button>
            </div>

            <placeholder-div v-if="i_frame"></placeholder-div>
            <iframe @load="i_frame = false" :src="'/widget/' + crypto" id="content" class="iframe_a" />
        </div>
    </div>
</section>
</template>

<script>
import PlaceholderDiv from "../../components/PlaceholderDiv";
import {
    mapGetters
} from "vuex";
export default {
    components: {
        PlaceholderDiv,
    },
    data() {
        return {
            i_frame: true,
            i_balance: true,
            total: 0.0,
            loading: true,
            crypto: "BTC",
            crypto_balance: "",
            balances: {
                usd: 0.0,
                gbp: 0.0,
                eur: 0.0,
                jpy: 0.0,
                btc: 0.0,
            },
        };
    },
    computed: {
        ...mapGetters(["getClientDetail"]),
    },
    watch: {
        getClientDetail() {
            this.setBalance();
            this.i_balance = false;
        },
    },
    methods: {
        iframeIsLoaded() {},
        setBalance() {
            const data = this.$store.getters.getClientDetail;
            this.balances = data.fiat_balances;
            this.total = data.fiat_balances["usd"];
            this.crypto_balance = data.crypto_balance;
        },
        haveBal() {},
        async getWalletBalance() {
            this.i_balance = true;

            await this.$store.dispatch("loggedInClientDetail");

            this.i_balance = false;
        },
    },
    created() {
        this.getWalletBalance();
    },
};
</script>
