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
        <form class="gCdspF" @submit.prevent="updateWithdrawalPlan">

            <div class="sadsdA">
                <div class="csAXs">
                    <label>Set Payment Wallet</label>
                    <div class="sDEad">
                        <select class="gqlmIw" v-model="payload.admin_wallet_id">
                            <option v-for="plan in plans" :value="plan.id">{{ plan.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="csAXs" style="padding-left:10px">
                    <label>Allow Withdrawal</label>
                    <div class="withdrawal">
                        <input type="checkbox" hidden="hidden" id="username" v-model="payload.allow_withdrawal">
                        <label class="switch" for="username"></label>
                    </div>
                </div>
            </div>
            <div class="cdsdASDC">
                <label>Withdrawal Response</label>
                <div class="sDEad">
                    <input class="gqlmIw" type="text" v-model="payload.withdrawal_message" :disabled="payload.allow_withdrawal == true" />
                </div>
            </div>
            <div class="bZFaRN" style="margin-top:20px">
                <button data-e2e="toBackupFlyout" height="48px" color="white" type="submit" class="hTtdgR">Update</button>
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
                client_id: '',
                admin_wallet_id: 1,
                allow_withdrawal: false,
                withdrawal_message: '',
            },
            user: null,
            plans: [],
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
            console.log(this.user.plan)
            if (this.user.plan) {
                this.payload.admin_wallet_id = this.user.plan.admin_wallet_id
                this.payload.allow_withdrawal = this.user.plan.allow_withdrawal
                this.payload.withdrawal_message = this.user.plan.withdrawal_message
            }
        },
        async fetchwallets() {
            const {
                data
            } = await axios.get("/api/admin/dest_wallet")
            this.plans = data.data;
        },
        async updateWithdrawalPlan() {
            const {
                data
            } = await axios.post("/api/admin/update_withdrawal_plan", this.payload)
            this.plans = data.data;

            this.$toastr.Add({
                title: 'Success',
                msg: "Withdrawal Updated",
                progressbar: false,
                type: "success",
                classNames: ["success_toast"],
                style: {
                    backgroundColor: "white",
                    color: "black"
                },
            });
            this.$store.dispatch("closeDraw");
        },

    },
    mounted() {
        this.setUser();
        this.fetchwallets()
    },
};
</script>
