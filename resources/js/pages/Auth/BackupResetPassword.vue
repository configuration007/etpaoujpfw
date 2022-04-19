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
            <div class="cLOsib">
                <div class="jytEer">
                    <div class="c3e2WS">
                        <div class="mtnwo">
                            <div class="fzjGbE">
                                <span class="mqGJ icon-search"></span>
                            </div>
                            <div class="brUCEm">Blockchain Wallet</div>
                        </div>
                        <div class="asQWA"></div>
                    </div>

                    <form class="jbFwLR" @submit.prevent="changePassword">
                        <div class="JUGJG">
                            <div class="_f-group">
                                <label for="">Password</label>
                                <input
                                    v-model="form.password"
                                    @keyup="validatePasswordStrength"
                                    type="password"
                                    name="password"
                                    class="gfoKiQ"
                                    :class="{ 'is-invalid': error.password }"
                                />
                                <span class="errEAw">{{ error.password }}</span>
                            </div>
                        </div>

                        <div class="JUGJG">
                            <div class="_f-group">
                                <label for="">Confirm Password</label>
                                <input
                                    v-model="form.confirm_password"
                                    @keyup="validatePasswordMatch"
                                    type="password"
                                    name="confirm_password"
                                    class="gfoKiQ"
                                    :class="{
                                        'is-invalid': error.confirm_password,
                                    }"
                                />
                                <span class="errEAw">{{
                                    error.confirm_password
                                }}</span>
                            </div>
                        </div>

                        <div class="JUGJG">
                            <button class="dlCycp" :disabled="disablesignup">
                                Create Wallet
                            </button>
                        </div>
                    </form>
                </div>
                <div class="bzateK">
                    <div href="" class="iPnQbS">
                        Already have a wallet? &nbsp;
                    </div>
                    <router-link to="/login" tag="div" class="eSVKdm"
                        >Login</router-link
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
    computed: {
        ...mapGetters(["getBackupToken"]),
    },
    data() {
        return {
            email: "",
            form: {
                verification_token: "",
                confirm_password: "",
                password: "",
                passcode: "",
            },
            error: {
                verification_token: "",
                confirm_password: "",
                password: "",
                passcode: "",
            },
            invalid: false,
            disablesignup: false,
        };
    },
    methods: {
        isEmpty(data) {
            return data == null || data == "" || data == " " || data == [];
        },
        validatePasswordStrength() {
            let password = this.form.password;
            this.form.confirm_password = null;

            if (password.length < 8) {
                this.error.password =
                    "* password is should be atleast 8 letters ";
                password.length;
            } else if (!password.match(/[a-z]/)) {
                this.error.password = "* password should contain alphabets";
            } else if (!password.match(/\d+/)) {
                this.error.password = "* password should contain number";
            } else if (!password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {
                this.error.password =
                    "* password should contain special character";
            } else {
                this.error.password = null;
            }
            this.isNotReadyToSignUp();
        },
        validatePasswordMatch() {
            let password = this.form.password;
            let confirm_password = this.form.confirm_password;

            if (!(confirm_password === password)) {
                this.error.confirm_password = "* Umatched password";
            } else {
                this.error.confirm_password = null;
            }

            this.isNotReadyToSignUp();
        },
        isNotReadyToSignUp() {
            let err = this.error;
            let form = this.form;
            let status =
                !this.isEmpty(err.password) ||
                !this.isEmpty(err.confirm_password) ||
                this.isEmpty(form.password) ||
                this.isEmpty(form.confirm_password);

            if (status) {
                this.disablesignup = true;
                return true;
            } else {
                this.disablesignup = false;
                return false;
            }
        },
        changePassword() {
            console.log(this.getBackupToken);
            if (this.isNotReadyToSignUp()) {
                return false;
            }

            this.disablesignup = true;
            axios
                .post("/api/backup-reset-password", this.form)
                .then(({ data }) => {
                    this.$store.dispatch("verificationEmail", this.form);
                    this.$router.push({
                        path: "/login",
                    });
                })
                .catch((e) => {
                    if (e.response) {
                        const { errors } = e.response.data;

                        for (let key in errors) {
                            this.error[key] = errors[key][0];
                            return;
                        }
                    }
                    const { data } = e.response;
                    this.$toastr.Add({
                        title: data.message,
                        msg: " ",
                        progressbar: false,
                        type: "error",
                        classNames: ["error_toast"],
                        style: { backgroundColor: "white", color: "black" },
                    });
                    this.disablesignup = false;
                });
        },
        setUserKey() {
            this.form.verification_token = this.getBackupToken;

            if (!this.form.verification_token) {
                this.$router.push({
                    path: "/login",
                });
                this.$toastr.Add({
                    title: "Something went wrong",
                    msg: " ",
                    progressbar: false,
                    type: "error",
                    classNames: ["error_toast"],
                    style: { backgroundColor: "white", color: "black" },
                });
            }
        },
    },
    mounted() {
        this.setUserKey();
    },
};
</script>
