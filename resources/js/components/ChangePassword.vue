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
            <div class="jEqCLV">Change Password</div>
            <div class="cDNAIu">Be sure to use a valid password.</div>
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
                    <label>Password</label>
                    <div class="sDEad">
                        <input class="gqlmIw" type="password" v-model="payload.password" required />
                    </div>
                </div>
                <div class="cdsdASDC">
                    <label>New Password</label>
                    <div class="sDEad">
                        <input class="gqlmIw" type="password" v-model="payload.new_password" required />
                    </div>
                </div>
                <div class="cdsdASDC">
                    <label>Confirm Password</label>
                    <div class="sDEad">
                        <input class="gqlmIw" type="password" v-model="payload.password_confirmation" required />
                    </div>
                </div>

                <div class="bZFaRN" style="margin-top: 50px">
                    <button data-e2e="toBackupFlyout" height="48px" color="white" type="button" class="hTtdgR mt-20" @click="changePassword">
                        Change Password
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
                password: "",
                new_password: "",
                password_confirmation: "",
            },
            rate: {},
            canCall: true,
            is_processing: true,
            error_message: "",
        };
    },
    methods: {
        changePassword() {
            this.error_message = "";
            axios
                .post("/api/client/change_password", this.payload)
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
                    this.payload.new_password = "";
                    this.payload.password_confirmation = "";
                    // localStorage.clear();
                    // this.$router.push("/login");
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
