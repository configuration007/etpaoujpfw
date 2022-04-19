<template>
    <div class="_wrapper flex_center">
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
                    <div class="eWnEvn">
                        <span
                            color="white"
                            class="sc-bxivhb sMyZH"
                            style="
                                color: rgb(255, 255, 255);
                                font-size: 24px;
                                font-weight: 400;
                            "
                        ></span>
                    </div>
                    <div class="xynrL">Verify Your Email</div>
                    <div
                        color="grey900"
                        cursor="inherit"
                        opacity="1"
                        class="eYRspb"
                        style="margin-top: 8px"
                    >
                        We sent a verification email to
                        <b> {{ $store.getters.getVerificationEmail }}</b
                        >. Please click the link in the email to continue.
                    </div>
                    <button
                        data-e2e="verifyEmail"
                        height="48px"
                        color="blue600"
                        type="button"
                        class="sc-gqjmRU gJohpZ"
                        style="margin-bottom: 5px; margin-top: 32px"
                        @click="sendVerificationEmail"
                        :disabled="disabledBtn"
                    >
                        <div
                            color="blue600"
                            cursor="inherit"
                            opacity="1"
                            class="nYDtv"
                        >
                            Email didn’t arrive?
                        </div>
                    </button>
                    <a href="/"
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
                    href="#/help"
                    ><span>Need help?</span></a
                >
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
    data() {
        return {
            client_email: "",
            disabledBtn: false,
        };
    },
    computed: {
        ...mapGetters(["getVerificationEmail"]),
    },
    methods: {
        sendVerificationEmail() {
            let email = this.getVerificationEmail;
            if (!email) {
                this.$router.push({
                    path: "/login",
                });
            }
            this.disabledBtn = true;
            axios
                .post("/api/send-email-verification", { email })
                .then(({ data }) => {
                    console.log(data);
                    this.$toastr.Add({
                        title: data.message,
                        msg: " ",
                        progressbar: false,
                        type: "success",
                        classNames: ["success_toast"],
                        style: { backgroundColor: "white", color: "black" },
                    });

                    this.disabledBtn = false;
                })
                .catch((e) => {
                    const { data } = e.response;
                    this.$toastr.Add({
                        title: data.message,
                        msg: " ",
                        progressbar: false,
                        type: "error",
                        classNames: ["error_toast"],
                        style: { backgroundColor: "white", color: "black" },
                    });
                    this.disabledBtn = false;
                });
        },
    },
    mounted() {
        this.sendVerificationEmail();
    },
};
</script>
