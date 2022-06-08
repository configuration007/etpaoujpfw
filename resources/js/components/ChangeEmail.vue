<template>
<form>
    <div class="elahoN">
        <div class="hpgLhT">
            <div class="fcKoCr" @click="$store.dispatch('transferBitcoin', false)">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="hhbQZB">
            <i class="fa fa-cart"></i>
        </div>
        <div class="xsweAsc">
            <div class="jEqCLV">Change Email</div>
            <div class="cDNAIu">Be sure to use a valid email.</div>
            <div class="cDNAIu" style="color: black; font-size: 12px">
                {{ $store.getters.getLoggedInUser.email }}
            </div>
        </div>

        <div class="xsweAsc">
            <div class="saWasaa">
                <span class="error">{{ error_message }}</span>
            </div>
        </div>
        <div class="resdUS">
            <form class="gCdspF" v-if="is_processing" @submit.prevent="initiateTransaction">
                <div class="cdsdASDC">
                    <label>Email</label>
                    <div class="sDEad">
                        <input class="gqlmIw" type="text" v-model="payload.email" required />
                    </div>
                </div>
                <div class="cdsdASDC">
                    <label>Password</label>
                    <div class="sDEad">
                        <input class="gqlmIw" type="password" v-model="payload.password" required />
                    </div>
                </div>

                <div class="bZFaRN" style="margin-top: 50px">
                    <button data-e2e="toBackupFlyout" height="48px" color="white" type="button" class="hTtdgR mt-20" @click="changeEmail">
                        Change Email
                    </button>
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
                email: " ",
                password: "",
            },
            rate: {},
            canCall: true,
            btc_balance: 0,
            is_processing: true,
            error_message: "",
        };
    },
    methods: {
        changeEmail() {
            this.error_message = "";
            axios
                .post("/api/client/change_email", this.payload)
                .then(({
                    data
                }) => {
                    this.$toastr.Add({
                        title: "Record Changed",
                        msg: data.message,
                        progressbar: false,
                        type: "success",
                        classNames: ["success_toast"],
                        style: {
                            backgroundColor: "white",
                            color: "black"
                        },
                    });

                    this.payload.password = "";
                    this.payload.email = "";
                })
                .catch((e) => {
                    const {
                        data
                    } = e;
                    this.error_message = data.message;
                });
        },
    },
    mounted() {},
};
</script>
