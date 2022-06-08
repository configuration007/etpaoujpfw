<template>
    <form>
        <div class="elahoN">
            <div class="hpgLhT">
                <div
                    class="fcKoCr"
                    @click="$store.dispatch('transferBitcoin', false)"
                >
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <div class="hhbQZB">
                <i class="fa fa-cart"></i>
            </div>
            <div class="xsweAsc">
                <div class="jEqCLV">Send Bitcoin from Miner.</div>
                <div class="cDNAIu">
                    Easily buy and sell Crypto straight from your Wallet.
                </div>
            </div>

            <div class="jBpENL">
                <div class="hWPHrf">
                    <div class="abSAas jaPQAA">Send</div>
                    <div
                        class="abSAas jYTJyU"
                        @click="$store.dispatch('recieveBitcoin', true)"
                    >
                        Recieve
                    </div>
                </div>
            </div>
            <div class="xsweAsc">
                <div class="saWasaa">
                    <span class="error">{{ error_message }}</span>
                </div>
            </div>
            <div class="resdUS">
                <form
                    class="gCdspF"
                    v-if="is_processing"
                    @submit.prevent="initiateTransaction"
                >
                    <div class="cdsdASDC">
                        <label>Address</label>
                        <div class="sDEad">
                            <input
                                class="gqlmIw"
                                type="text"
                                v-model="payload.address"
                                required
                            />
                        </div>
                    </div>
                    <div class="sadsdA">
                        <div class="csAXs">
                            <label>Amount</label>
                            <div class="sDEad">
                                <div class="ahOlas">
                                    <input
                                        class="gqlmIw"
                                        type="number"
                                        v-model="payload.amount"
                                        @keyup="convertBTC"
                                        required
                                    />
                                    <div class="sasAas">BTC</div>
                                </div>
                            </div>
                        </div>
                        <div class="csAXs">
                            <label style="margin: 11px 0"></label>
                            <div class="sDEad">
                                <div class="ahOlas">
                                    <input
                                        class="gqlmIw"
                                        type="number"
                                        v-model="payload.fiat_amount"
                                        required
                                    />
                                    <div class="sasAas" @keyup="convertFiat">
                                        <select
                                            class="asE2C"
                                            v-model="payload.fiat"
                                            required
                                        >
                                            <option value="usd">USD</option>
                                            <option value="dbp">GBP</option>
                                            <option value="eur">EUR</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cdsdASDC">
                        <label>Description</label>
                        <div class="sDEad">
                            <input
                                class="gqlmIw"
                                type="text"
                                v-model="payload.description"
                                required
                            />
                        </div>
                    </div>
                    <div class="sadsdA saAsaw">
                        <span class="sAsasq"
                            >There is a {{ btc_balance }} BTC free for this
                            wallet</span
                        >
                        <button class="gzzwuM">Withdraw</button>
                    </div>
                </form>

                <div class="gCdspF" v-else>
                    <div class="adaAd">
                        <div class="aqWE">
                            <span class="dassds">AMOUNT</span>
                            <span class="dassds">{{ payload.amount }} BTC</span>
                        </div>
                        <span class="aQawe">{{ payload.address }}</span>
                    </div>
                    <div class="sadeAd">
                        <span>Description</span>
                        <span>{{ payload.description }}</span>
                    </div>
                    <div class="sadeAd">
                        <span>Status</span>
                        <span class="dassds">Pending (0/3 Confirmation)</span>
                    </div>
                    <div class="sadeaA">
                        <button class="gzzwuM" type="button" @click="$store.dispatch('closeDraw')">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    data() {
        return {
            payload: {
                address: "",
                amount: 0,
                fiat: "usd",
                fiat_amount: 0,
                description: "",
                timer: 0,
            },
            rate: {},
            canCall: true,
            btc_balance: 0,
            is_processing: true,
            error_message: "",
        };
    },
    computed: {
        ...mapGetters(["getClientDetail"]),
    },
    watch: {
        getClientDetail() {
            this.setBalance();
        },
    },
    methods: {
        initiateTransaction() {
            if (this.btc_balance < this.payload.amount) {
                this.error_message = `Your available balace is ${this.btc_balance}`;
                return;
            }

            this.error_message = "";
            axios
                .post("/api/client/initiate_transaction", this.payload)
                .then(({ data }) => {
                    if (data.data == "isSuccessfull") {
                        this.is_processing = false;
                    } else {
                        this.error_message = data.data;
                    }
                });
        },
        setBalance() {
            const data = this.$store.getters.getClientDetail;
            this.btc_balance = data.fiat_balances["btc"];
        },
        getRate() {
            if (this.canCall) {
                this.canCall = false;
                const { data } = axios
                    .get("/api/client/get_rate")
                    .then(({ data }) => {
                        this.rate = data.data;
                        this.canCall = true;
                    });
            }
        },
        convertBTC() {
            if (this.btc_balance < this.payload.amount) {
                this.error_message = `Your available balace is ${this.btc_balance}`;
                
            }else{
                this.error_message = null ;
            }
            this.getRate();
            this.payload.fiat_amount =
                this.rate[this.payload.fiat] * this.payload.amount;
        },
        convertFiat() {
            this.getRate();
            this.payload.amount =
                this.payload.amount / this.rate[this.payload.fiat];
        },
    },
    mounted() {
        this.getRate();
        this.setBalance();
    },
};
</script>
