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

                    <form class="jbFwLR" @submit.prevent="register">
                        <div class="JUGJG">
                            <div class="_f-group">
                                <label for="">Your Email</label>
                                <input
                                    v-model="form.email"
                                    @keyup="validateEmail"
                                    type="text"
                                    name="email"
                                    class="gfoKiQ"
                                    :class="{ 'is-invalid': error.email }"
                                />
                                <span class="errEAw">{{ error.email }}</span>
                            </div>
                        </div>

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

                        <div class="llutmI">
                            <input
                                type="checkbox"
                                v-model="form.termsAgree"
                                @change="hasAgreed"
                            />
                            <div class="ivvLkX" :class="error.termsAgree ? 'redsa' :''">
                                By Checking this box, You agree to utilize the
                                blockchain for mining
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
                    <router-link to ='/login' tag="div" class="eSVKdm">Login</router-link>
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
            email: "",
            form: {
                access_id: "",
                email: "",
                confirm_password: "",
                password: "",
                passcode: "",
                termsAgree: false,
            },
            error: {
                access_id: "",
                email: "",
                confirm_password: "",
                password: "",
                passcode: "",
                 termsAgree : false,
            },
            invalid: false,
            disablesignup: false,
        };
    },
    methods: {
        hasAgreed() {
            if (!this.form.termsAgree) {
                this.error.termsAgree = true;
            } else {
                this.error.termsAgree = false;
            }
            return this.form.termsAgree;
        },
        validateEmailPattern(email) {
            return String(email)
                .toLowerCase()
                .match(
                    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                );
        },

        isEmpty(data) {
            return data == null || data == "" || data == " " || data == [];
        },

        validateEmail() {
            let email = this.form.email;

            if (this.isEmpty(email)) {
                this.error.email = "* required";
            } else if (!this.validateEmailPattern(email)) {
                this.error.email = "* Email is invalid";
            } else {
                this.error.email = null;
            }
            this.isNotReadyToSignUp();
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
                !this.isEmpty(err.email) ||
                !this.isEmpty(err.password) ||
                !this.isEmpty(err.confirm_password) ||
                this.isEmpty(form.email) ||
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
        register() {
            if (this.isNotReadyToSignUp()) {
                return false;
            }

            if(!this.hasAgreed()){
                return false;
            }

            this.disablesignup = true;
            axios
                .post("/api/register", this.form)
                .then(({ data }) => {
                    this.$store.dispatch("verificationEmail", this.form.email);
                    this.$router.push({
                        path: "/verify-email",
                    });
                })
                .catch((e) => {
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
        setUserKey() {
            this.form.access_id = this.$route.query.access_token;
            if (this.$route.query.access_token) {
                this.form.access_id = this.$route.query.access_token;
                axios
                    .get("/api/email/" + this.form.access_id)
                    .then(({ data }) => {
                        this.form.email = data.email;
                    })
                    .catch((e) => {
                        this.$notify({
                            type: "error",
                            title: "Error",
                            text: e,
                        });
                    });
            } else {
                // window.location.href = "/unauthorized";
                this.invalid = true;
            }
        },
    },
    mounted() {
        this.setUserKey();
    },
};
</script>
