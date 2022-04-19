<template>
    <div class="_wrapper">
        <notifications />
        <div class="topbar">
            <div class="ktsDXc">
                <div class="buGjPd">
                    <div class="dWqUnF">
                        <a href="/">
                            <img src="/assets/images/bc-logo.svg" alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="_bdy">
            <div class="waLIp">
                <div class="iRrcJu">
                    <div class="status_wrapper">
                        <Verification :status="status" />
                    </div>

                    <router-link
                        to="/login"
                        tag="button"
                        data-e2e="verifyEmail"
                        height="48px"
                        color="blue600"
                        type="button"
                        class="sc-gqjmRU gJohpZ"
                        style="margin-bottom: 5px; margin-top: 16px"
                        @click="sendVerificationEmail"
                        :disabled="disabledBtn"
                    >
                        <span
                            color="blue600"
                            cursor="inherit"
                            opacity="1"
                            class="nYDtv"
                        >
                            {{ status == "failed" ? "Try Again" : "Login" }} ?
                        </span>
                    </router-link>
                    <a
                        href="/"
                        data-e2e="verifyEmailLater"
                        color="blue600"
                        class="dFyCBx"
                        style="margin-top: 16px"
                        >I’ll Do This Later.</a
                    >
                </div>
            </div>
        </div>
        <div class="_bottom">
            <div class="sc-dymIpo hniRZU">
                <div class="sc-ckVGcZ kXOjke">
                    <div color="grey400" class="sc-jKJlTe hcNnNN">
                        <div class="sc-eNQAEJ ahgzx">English</div>
                        <span
                            class="sc-htpNat dCBjHa sc-hMqMXs hRciUV"
                            color="grey700"
                        ></span>
                    </div>
                </div>
                <span class="sc-iuJeZd hIzvXs"
                    ><a
                        color="grey400"
                        href="https://github.com/blockchain/blockchain-wallet-v4-frontend/releases"
                        target="_blank"
                        class="sc-bZQynM fgsder"
                        ><span>Version 4.46.41</span></a
                    ></span
                ><a
                    color="grey400"
                    data-e2e="loginGetHelp"
                    class="sc-bZQynM jSLvMQ"
                    href="/contact"
                    ><span>Need help?</span></a
                >
            </div>
        </div>
    </div>
</template>
<script>
import Verification from "../../components/Verification";

import { mapGetters } from "vuex";
export default {
    components: {
        Verification,
    },
    data() {
        return {
            client_email: "",
            disabledBtn: true,
            status: "processing",
        };
    },
    computed: {
        ...mapGetters(["getVerificationEmail"]),
    },
    methods: {
        sendVerificationEmail() {
            let token = this.$route.query.token;

            if (!token) {
                this.status = "failed";
            }
            this.disabledBtn = true;
            axios
                .post("/api/verify-email", { token })
                .then(({ data }) => {
                    this.$toastr.Add({
                        title: data.message,
                        msg: " ",
                        progressbar: false,
                        type: "success",
                        classNames: ["success_toast"],
                        style: { backgroundColor: "white", color: "black" },
                    });
                    this.disabledBtn = false;
                    this.status = "verified";
                })
                .catch((e) => {
                    const  {data}  = e;
                    console.log(data)
                    this.$toastr.Add({
                        title: data.message,
                        msg: " ",
                        progressbar: false,
                        type: "error",
                        classNames: ["error_toast"],
                        style: { backgroundColor: "white", color: "black" },
                    });
                    this.status = "failed";
                    this.disabledBtn = false;
                });
        },
    },
    mounted() {
        this.sendVerificationEmail();
    },

    // blade blood lip plan exciting clever curtain borrow expansion invent announce zebra
};
</script>
