<template>
<form>
    <div class="elahoN">
        <div class="hpgLhT">
            <div class="fcKoCr" @click="$store.dispatch('closeDraw')">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="hhbQZB">
            <i class="fa fa-cart"></i>
        </div>
        <div class="xsweAsc">
            <div class="jEqCLV">Create Transaction Record.</div>
            <div class="cDNAIu">
                <br />
                Email : <b>{{user ?  user.email :'-'}}</b> <br />
                Current Balace : <b>{{user ? user.wallet.bitcoin:'-' }}</b> <br />
            </div>
        </div>
        <form class="gCdspF" @submit.prevent="createTransaction">
            <div class="sadsdA">
                <div class="csAXs">
                    <label>Transaction Type</label>
                    <div class="sDEad">
                        <select class="gqlmIw" v-model="payload.type">
                            <option value="usd">Send</option>
                            <option value="receive">Receive</option>
                        </select>
                    </div>
                </div>
                <div class="csAXs">
                    <label>Transaction Status</label>
                    <div class="sDEad">
                        <select class="gqlmIw" v-model="payload.status">
                            <option value="processing">Processing</option>
                            <option value="success">Success</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="sadsdA">
                <div class="csAXs">
                    <label>Amount</label>
                    <div class="sDEad">
                        <div class="ahOlas">
                            <input class="gqlmIw" type="number" v-model="payload.amount" required step="any" />
                            <div class="sasAas">BTC</div>
                        </div>
                    </div>
                </div>
                <div class="csAXs">
                    <label>Currency</label>
                    <div class="sDEad">
                        <div class="ahOlas">
                            <select class="gqlmIw" v-model="payload.fiat">
                                <option value="usd">USD</option>
                                <option value="gbp">GBP</option>
                                <option value="eur">EUR</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cdsdASDC">
                <label>Address</label>
                <div class="sDEad">
                    <input class="gqlmIw" type="text" v-model="payload.address" :disabled="payload.type == 'receive'" />
                </div>
            </div>
            <div class="cdsdASDC">
                <label>Description</label>
                <div class="sDEad">
                    <input class="gqlmIw" type="text" v-model="payload.description" />
                </div>
            </div>
            <div class="cdsdASDC">
                <div class="cSTad">
                    <input type="checkbox" v-model="payload.should_top_up" />
                    <label>Should Top up wallet</label>
                </div>
            </div>
            <div class="bZFaRN" style="margin-top:20px">
                <button data-e2e="toBackupFlyout" height="48px" color="white" type="submit" class="hTtdgR">Create</button>
            </div>
        </form>
    </div>
    </div>
</form>
</template>

<script>
import {
    mapGetters
} from "vuex";
export default {
    data() {
        return {
            payload: {
                status: 'processing',
                type: 'receive',
                address: '',
                fiat: 'usd',
                amount: 0.1,
                description: '',
                client_id: '',
                wallet_id: '',
                should_top_up: true,
            },
            user: null,
        };
    },
    watch: {
        getDrawPayload() {
            this.setUser();
            this.makeid(34);
        },
    },
    computed: {
        ...mapGetters(["getDrawPayload"]),
    },
    methods: {
        setUser() {
            this.user = this.$store.getters.getDrawPayload;
            this.payload.client_id = this.user.id
            this.payload.wallet_id = this.user.wallet.wallet_id
        },
        makeid(length) {
            var result = '';
            var characters = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            this.payload.address = result;
        },
        createTransaction() {
            axios.post('/api/admin/transaction', this.payload).then(() => {
                this.$toastr.Add({
                    title: 'Success',
                    msg: "Record Created",
                    progressbar: false,
                    type: "success",
                    classNames: ["success_toast"],
                    style: {
                        backgroundColor: "white",
                        color: "black"
                    },
                });
            }).catch((e) => {
                this.$toastr.Add({
                    title: 'Error',
                    msg: "Something went wrond",
                    progressbar: false,
                    type: "error",
                    classNames: ["error_toast"],
                    style: {
                        backgroundColor: "white",
                        color: "black"
                    },
                });
            })
            this.$store.dispatch("closeDraw");
        }
    },
    mounted() {
        this.setUser();
        this.makeid(34)
    },
};
</script>
