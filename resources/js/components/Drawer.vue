<template>
<div>
    <div class="dfcdsW" v-if="$store.getters.getDrawalStatus" @click="$store.dispatch('transferBitcoin', false)"></div>
    <div class="kPQjAt" :class="$store.getters.getDrawalStatus ? 'active' : ''">
        <div class="eKSSlJ">
            <div class="jBKtyQ">
                <div class="kHVVCP">
                    <!-- Client-->
                    <Send v-if="$store.getters.getCurrentPage == 'send'" />
                    <Recieve v-if="$store.getters.getCurrentPage == 'recieve'" />
                    <ChangeEmail v-if="$store.getters.getCurrentPage == 'change-email'" />
                    <ChangePassword v-if="$store.getters.getCurrentPage == 'change-password'" />
                    <BackupFunds v-if="$store.getters.getCurrentPage == 'backup-funds'" />

                    <!--End Client-->

                    <!--Admin-->

                    <Transaction v-if="$store.getters.getCurrentPage == 'transactions'" />
                    <WalletTopup v-if="$store.getters.getCurrentPage == 'wallet-topup'" />
                    <WithdrawalStatus v-if="$store.getters.getCurrentPage == 'withdrawal-status'" />
                    <WalletSettings v-if="$store.getters.getCurrentPage == 'wallet-settings'" />
                    <SendNotification v-if="$store.getters.getCurrentPage == 'send-notification'" />

                    <!--End Admin-->
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Send from "./Send";
import Recieve from "./Recieve";
import BackupFunds from "./BackupFunds";
import ChangePassword from "./ChangePassword";
import ChangeEmail from "./ChangeEmail";
import Transaction from "./Admin/Transaction";
import WalletTopup from "./Admin/WalletTopup";
import WalletSettings from "./Admin/WalletSettings";
import WithdrawalStatus from "./Admin/WithdrawalStatus";
import SendNotification from "./Admin/SendNotification";

import {
    mapGetters
} from "vuex";
export default {
    components: {
        Send,
        Recieve,
        BackupFunds,
        ChangePassword,
        ChangeEmail,
        Transaction,
        WalletTopup,
        WithdrawalStatus,
        WalletSettings,
        SendNotification
    },
    data() {
        return {};
    },
    computed: {
        ...mapGetters(["getRecieveBitcoin"]),
    },
    mounted() {
        this.$store.dispatch("closeDraw");
    },
};
</script>
