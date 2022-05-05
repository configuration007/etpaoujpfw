<template>
    <div class="_wrapper">
        <notifications />
        <div class="topbar">
            <div class="ktsDXc">
                <div class="buGjPd">
                    <div class="dWqUnF">
                        <img src="/assets/images/bc-logo.svg" alt="" />
                    </div>
                </div>
            </div>
        </div>
        <div class="_bdy">
            <div class="cLOsib">
                <div class="jytEer">
                    <div class="blKetq">Staff Access!</div>

                    <form class="jbFwLR" @submit.prevent="loginAdmin">
                        <div class="JUGJG">
                            <div class="_f-group">
                                <label for="">Email</label>
                                <input
                                    v-model="form.email"
                                    type="text"
                                    name="email"
                                    class="gfoKiQ"
                                    :class="{
                                        'is-invalid': form.errors.has('email'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="email"
                                ></has-error>
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
                                    :class="{
                                        'is-invalid':
                                            form.errors.has('password'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="password"
                                ></has-error>
                            </div>
                        </div>
                        <div class="JUGJG">
                            <button class="dlCycp">Log in</button>
                        </div>
                    </form>
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
            form: new Form({
                email: "",
                name: "",
                password: "",
            }),
            invalid: false,
        };
    },
    methods: {
        loginAdmin() {
            this.form
                .post("/api/login-admin")
                .then(({ data }) => {
                    if (data.token != null) {
                        localStorage.setItem("client_token", data.token);
                        localStorage.setItem("is_admin", true);
                        localStorage.setItem("user", data.user);
                        this.$store.dispatch("loggedInUser", data.user);
                        this.$router.push("/admin");
                    }
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
};
</script>
