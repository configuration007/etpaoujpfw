<template>
<div class="dashboard_wrapper">
    <Drawer />
    <v-app id="inspire">
        <div class="_navigation">
            <div class="hCNyBo">
                <div class="buGjPd">
                    <div>
                        <router-link to="/dashboard" class="logo" tag="a">
                            <img src="/assets/images/bc-logo.svg" alt="" />
                        </router-link>
                    </div>
                    <div class="lerVvP">
                        <ul class="hnQAwg _jdj">
                            <li class="sc-iujRgT iumRbO">
                                <router-link to="/dashboard" class="_lnks">
                                    <span class="ico"></span>
                                    <div class="txt">Email</div>
                                </router-link>
                            </li>
                            <div class="lmjspY"> {{ $store.getters.getLoggedInUser.email }} </div>
                            <li class="sc-iujRgT iumRbO">
                                <router-link to="/dashboard" class="_lnks">
                                    <span class="ico"></span>
                                    <div class="txt">{{ user.email }}</div>
                                </router-link>
                            </li>
                            <div class="lmjspY"></div>
                        </ul>

                        <ul class="hnQAwg">
                            <li class="sc-iujRgT iumRbO">
                                <a href="javascript:void(0)" class="_lnks" @click="getSecurity">
                                    <span class="ico"></span>
                                    <div class="txt">Security</div>
                                </a>
                            </li>
                            <div class="lmjspY"></div>
                            <li class="sc-iujRgT iumRbO">
                                <a href="javascript:void(0)" class="_lnks" @click="getNotification">
                                    <span class="ico"></span>
                                    <div class="txt">Notification</div>
                                </a>
                            </li>
                            <div class="lmjspY"></div>
                            <li class="sc-iujRgT iumRbO lGt">
                                <a href="javascript::void(0)" @click="logOut" to="/dashboard" class="_lnks">
                                    <span class="ico"></span>
                                    <div class="txt logout">
                                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-sign-out-alt fa-w-16 fa-2x">
                                            <path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z" class=""></path>
                                        </svg>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="m_jt">
                <div class="cdUxEf">
                    <ul class="hnQAwg">
                        <li class="iumGO" id="toggler" @click="tog = !tog">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-align-justified" width="20" height="20" viewBox="0 0 24 24" stroke-width="3" stroke="#E5E9E9" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <line x1="4" y1="6" x2="24" y2="6"></line>
                                <line x1="4" y1="12" x2="24" y2="12"></line>
                                <line x1="4" y1="18" x2="24" y2="18"></line>
                            </svg>
                        </li>
                        <div class="sc-GMQeP lmfY"></div>
                        <div class="iumGO">
                            <div class="rgEQc">
                                <div class="_txr">{{ user.email }}</div>
                            </div>
                        </div>
                    </ul>
                    <ul class="hnQAwg"></ul>
                </div>
            </div>
        </div>
        <div class="uyrvDUYEhs">
                 
        </div>
        <div class="dashboard_body">
        
            <div :class="tog ? 'side_bar open' : 'side_bar'">
                <div class="rgrQc">
                    <div class="iANjPF">
                        <span> Total Balance</span>
                    </div>
                    <div class="bTUday">
                        <ul class="dropdown"></ul>
                        <div class="_js">
                            <div class="total">${{ total | addComma }}</div>

                            <span class="togglebtn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <polyline points="6 9 12 15 18 9" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="bhwFE">
                    <div class="_ndr">
                        <div class="jVKMIR">
                            <div class="bWknoI">Portfolio</div>
                            <div class="iHyyjn">
                                <div class="jJOJSo"></div>
                            </div>
                        </div>
                        <router-link to="/dashboard" class="SiDlnk blue" exact-active-class="active">
                            <span class="_IcN">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="
                                            enable-background: new 0 0 512 512;
                                        " xml:space="preserve" class="">
                                    <g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path d="m256 0-256 192.266v319.734h190.667v-210h130.666v210h190.667v-319.734z" fill="currentColor" data-original="#000000" style="" class="" />
                                        </g>
                                    </g>
                                </svg>
                            </span>

                            <span class="_TnxT"> Dashboard </span>
                        </router-link>
                        <router-link to="/dashboard/usd" class="SiDlnk coin" exact-active-class="active">
                            <span class="_IcN">
                                <div class="aux-coin sth">
                                    <span class="_IcN">
                                        <div class="coin-icon">&#36;</div>
                                    </span>
                                </div>
                            </span>

                            <span class="_TnxT"> Us Dollar </span>
                        </router-link>

                        <router-link to="/dashboard/gbp" class="SiDlnk coin" exact-active-class="active">
                            <span class="_IcN">
                                <div class="aux-coin sth">
                                    <span class="_IcN">
                                        <div class="coin-icon">&pound;</div>
                                    </span>
                                </div>
                            </span>

                            <span class="_TnxT"> British Pound </span>
                        </router-link>

                        <router-link to="/dashboard/eur" class="SiDlnk coin" exact-active-class="active">
                            <span class="_IcN">
                                <div class="aux-coin sth">
                                    <span class="_IcN">
                                        <div class="coin-icon">&euro;</div>
                                    </span>
                                </div>
                            </span>

                            <span class="_TnxT"> Euro</span>
                        </router-link>
                        <router-link to="/dashboard/btc" class="SiDlnk coin" exact-active-class="active" style="padding-left: 10px;">
                            <span class="_IcN" style="margin-right:18px">
                                <div class="aux-coin sth" style="background:#f2a900;">
                                    <img   src="/assets/images/prices-btc.svg" alt="" />
                                </div>
                            </span>

                            <span class="_TnxT"> Bitcoin </span>
                        </router-link>

                        <div class="jVKMIR dsfc">
                            <div class="iHyyjn">
                                <div class="jJOJSo"></div>
                            </div>
                        </div>

                        <router-link to="/dashboard/activities" class="SiDlnk coin" exact-active-class="active">
                            <span class="_IcN">
                                <div class="aux-coin sth saE">
                                    <img src="/assets/images/logg.png" alt="" />
                                </div>
                            </span>

                            <span class="_TnxT"> Activities </span>
                        </router-link>
                        <router-link to="/dashboard/settings" class="SiDlnk coin" exact-active-class="active">
                            <span class="_IcN">
                                <div class="aux-coin sth saE">
                                    <img src="/assets/images/settings.png" alt="" />
                                </div>
                            </span>

                            <span class="_TnxT"> Settings </span>
                        </router-link>
                        <ul class="dsSACD">
                            <li>Enable 2FA</li>
                            <li>Backup Phrase</li>
                            <li>Password</li>
                        </ul>

                        <a href="javascript::void(0)" class="SiDlnk coin" @click="logOut">
                            <span class="_IcN">
                                <div class="aux-coin sth saE">
                                    <img src="/assets/images/enter.png" alt="" />
                                </div>
                            </span>

                            <span class="_TnxT"> Logout </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="kkzpGP">
                <div class="ikKNan">
                    <div class="iXdtxn">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
        <v-dialog v-model="dialogSecurity" max-width="500px">
            <v-card>
                <v-card-text>
                    <div class="card_content">
                        <p class="s_1">
                            This Miner is being accessed outside the Mining
                            Facility
                        </p>
                        <p class="s_2">
                            {{ security_data.country }}
                        </p>
                        <p class="s_3">
                            <span>I.P</span> {{ security_data.ip }}
                        </p>
                    </div>
                </v-card-text>
            </v-card>
        </v-dialog>

        <v-dialog v-model="dialogNotification" max-width="500px">
            <v-card>
                <v-card-title class="headline">
                    Notifications
                </v-card-title>
                <v-card-text>
                    <v-list-item v-for="data in all_notification" :key="data.id">
                        <v-list-item-content>
                            <v-list-item-title>{{
                                    data.type
                                }}</v-list-item-title>
                            <v-list-item-subtitle>{{
                                    data.message
                                }}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="dialogNotification = false">
                        Cancel
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-app>
</div>
</template>

<script>
import Drawer from "../../components/Drawer";
import PlaceholderRel from "../../components/PlaceholderRel";
import {
    mapGetters
} from "vuex";
export default {
    components: {
        Drawer,
        PlaceholderRel,
    },
    data() {
        return {
            load_a: true,
            load_b: true,
            load_c: true,
            load_d: true,
            tog: false,
            security_data: {},
            all_notification: [],
            dialogNotification: false,
            dialogSecurity: false,
            total: 0.0,
            user: {},
        };
    },
    computed: {
        ...mapGetters(["getClientDetail"]),
    },
    watch: {
        getClientDetail() {
            this.setBalance();
        },
    },
    methods: {
        setBalance() {
            const data = this.$store.getters.getClientDetail;
            if (data) {
                this.total = data.fiat_balances["usd"];
            }
        },
        getNotification() {
            axios.get("/api/get_user_notification").then(({
                data
            }) => {
                this.all_notification = data;
                this.dialogNotification = true;
            });
        },
        getSecurity() {
            axios.get("/api/get_security").then(({
                data
            }) => {
                this.security_data = data;
                this.dialogSecurity = true;
            });
        },
        logOut() {
            localStorage.clear();
            this.$router.push("/block_access");
        },

        async getUser() {
            const data = await axios.get("/api/client/me");
            this.user = data ? data.data : null;
        },
        async getWalletBalance() {
            await this.$store.dispatch("loggedInClientDetail");
        },
    },
    mounted() {
        this.getUser();
        this.getWalletBalance();
    },
};
</script>

<style scoped>
.card_content {
    padding-top: 15px;
    padding-bottom: 25px;
    display: Flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.card_content p {
    margin: 5px;
    font-weight: bold;
}

.s_2 {
    color: green;
}

.s_4 {
    color: red;
}

.s_3 span {
    color: green;
}

a._lnks .txt {
    color: white !important;
}
</style>
