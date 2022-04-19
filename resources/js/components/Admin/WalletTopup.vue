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
            <div class="jEqCLV">Top Wallet</div>
            <div class="cDNAIu">
                <br />
                Email : <b>{{user ?  user.email :'-'}}</b> <br />
                Current Balace : <b>{{user ? user.wallet.bitcoin:'-' }}</b> <br />
            </div>
        </div>
        <form class="gCdspF" @submit.prevent="topUpWallet">

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
                amount: 0.1,
                client_id: '',
                wallet_id: '',
            },
            user: null,
        };
    },
    watch: {
        getDrawPayload() {
            this.setUser();
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
        topUpWallet() {
            axios.post('/api/admin/top_up', this.payload).then(() => {
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
    },
};
</script>
