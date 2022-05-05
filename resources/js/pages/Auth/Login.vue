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
                            <div class="brUCEm">Welcome Back</div>
                        </div>
                        <div class="asQWA"></div>
                    </div>

                    <form class="jbFwLR" @submit.prevent="login">
                        <div class="JUGJG">
                            <div class="_f-group">
                                <label for="">Wallet ID</label>
                                <input
                                    v-model="form.wallet_id"
                                    @keyup="validateWallet"
                                    type="text"
                                    name="wallet_id"
                                    class="gfoKiQ"
                                    autocomplete="off"
                                    :class="{ 'is-invalid': error.wallet_id }"
                                />
                                <span class="errEAw">{{
                                    error.wallet_id
                                }}</span>
                            </div>
                        </div>

                        <div class="JUGJG">
                            <div class="_f-group">
                                <label for="">Password</label>
                                <input
                                    v-model="form.password"
                                    type="password"
                                    name="password"
                                    class="gfoKiQ"
                                    @keyup="valiatePassword"
                                    :class="{ 'is-invalid': error.password }"
                                />
                                <span class="errEAw">{{ error.password }}</span>
                            </div>
                        </div>
                        <div class="llutmI">
                            <div class="ivvLkX aAssa">
                                Need Help logging in ? Try
                                <router-link to="/2fa-login"> 2FA</router-link>
                            </div>
                        </div>
                        <div class="JUGJG">
                            <button class="dlCycp" :disabled="disablesignup">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
                <div class="bzateK">
                    <div href="" class="iPnQbS">
                        Don't have a wallet? &nbsp;
                    </div>
                    <router-link to="/register" tag="div" class="eSVKdm"
                        >Sign Up</router-link
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
export default {
    data() {
        return {
            wallet_id: "",
            form: {
                wallet_id: "",
                password: "",
            },
            error: {
                wallet_id: "",
                password: "",
            },
            invalid: false,
            disablesignup: false,
        };
    },
    methods: {
        validateWalletPattern(wallet_id) {
            if (wallet_id.length !== 36) {
                return false;
            }

            if (
                wallet_id[8] != "-" ||
                wallet_id[13] != "-" ||
                wallet_id[18] != "-" ||
                wallet_id[23] != "-"
            ) {
                return false;
            }

            return true;
        },

        isEmpty(data) {
            return data == null || data == "" || data == " " || data == [];
        },
        validateWallet() {
            let wallet_id = this.form.wallet_id;

            if (this.isEmpty(wallet_id)) {
                this.error.wallet_id = "* required";
            } else if (!this.validateWalletPattern(wallet_id)) {
                this.error.wallet_id = "* Wallet ID is invalid";
            } else {
                this.error.wallet_id = null;
            }
            this.isNotReadyToSignUp();
        },

        valiatePassword() {
            if (!this.form.password) {
                this.error.password = "Password is required";
            } else {
                this.error.password = null;
            }
            this.isNotReadyToSignUp();
        },

        isNotReadyToSignUp() {
            let err = this.error;
            let form = this.form;
            let status =
                !this.isEmpty(err.wallet_id) ||
                !this.isEmpty(err.password) ||
                this.isEmpty(form.wallet_id) ||
                this.isEmpty(form.password);

            if (status) {
                this.disablesignup = true;
                return true;
            } else {
                this.disablesignup = false;
                return false;
            }
        },
        login() {
            if (this.isNotReadyToSignUp()) {
                return false;
            }

            this.disablesignup = true;
            axios
                .post("/api/login", this.form)
                .then(({ data }) => {
                    if (data.token != null) {
                        if (this.isEmpty(data.user.email_verified_at)) {
                            this.$store.dispatch(
                                "verificationEmail",
                                this.form.email
                            );
                            this.$router.push({
                                path: "/verify-email",
                            });
                            return;
                        }
                        localStorage.setItem("client_token", data.token);
                        localStorage.setItem("is_admin", false);
                        localStorage.setItem("user", data.user);
                        this.$store.dispatch("loggedInUser",  data.user);
                        this.$router.push("/dashboard");
                    }
                })
                .catch((e) => {
                   console.log(e)
                    if (e.data) {
                        const { errors } = e.data;

                        for (let key in errors) {
                            this.error[key] = errors[key][0];
                            return;
                        }
                    }
                    const { data } = e;
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
    },
    mounted() {},
};
</script>
