<template>
    <div class="dashboard_wrapper">
       <Drawer />
        <div class="_navigation">
            <div class="hCNyBo">
                <div class="buGjPd">
                    <div>
                        <div class="logo">
                            <img src="/assets/images/bc-logo.svg" alt="" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="m_jt">
                <div class="cdUxEf">
                    <ul class="hnQAwg">
                        <li class="iumGO" id="toggler" @click="tog = !tog">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-align-justified"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                stroke-width="3"
                                stroke="#E5E9E9"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <line x1="4" y1="6" x2="24" y2="6"></line>
                                <line x1="4" y1="12" x2="24" y2="12"></line>
                                <line x1="4" y1="18" x2="24" y2="18"></line>
                            </svg>
                        </li>
                        <div class="sc-GMQeP lmfY"></div>
                        <div class="iumGO">
                            <div class="rgEQc">
                                <div class="_txr">$0.00</div>
                                <div class="cRT">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-chevron-down"
                                        width="18"
                                        height="18"
                                        viewBox="0 0 24 24"
                                        stroke-width="3"
                                        stroke="currentColor"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path
                                            stroke="none"
                                            d="M0 0h24v24H0z"
                                            fill="none"
                                        ></path>
                                        <polyline
                                            points="6 9 12 15 18 9"
                                        ></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </ul>
                    <ul class="hnQAwg"></ul>
                </div>
            </div>
        </div>

        <div class="dashboard_body">
            <div :class="tog ? 'side_bar open' : 'side_bar'">
                <div class="rgrQc">
                    <div class="iANjPF">
                        <span> Current User</span>
                    </div>
                    <div class="bTUday">
                        <ul class="dropdown"></ul>
                        <div class="_js">
                            <div class="total">{{ current_user() }}</div>
                        </div>
                    </div>
                </div>
                <div class="bhwFE">
                    <div class="_ndr">
                        <router-link
                            to="/admin"
                            class="SiDlnk blue"
                            exact-active-class="active"
                        >
                            <span class="_IcN">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    xmlns:svgjs="http://svgjs.com/svgjs"
                                    version="1.1"
                                    width="512"
                                    height="512"
                                    x="0"
                                    y="0"
                                    viewBox="0 0 512 512"
                                    style="enable-background: new 0 0 512 512"
                                    xml:space="preserve"
                                    class=""
                                >
                                    <g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m256 0-256 192.266v319.734h190.667v-210h130.666v210h190.667v-319.734z"
                                                fill="currentColor"
                                                data-original="#000000"
                                                style=""
                                                class=""
                                            />
                                        </g>
                                    </g>
                                </svg>
                            </span>

                            <span class="_TnxT"> Dashboard </span>
                        </router-link>

                        <router-link
                            to="/admin/tranasctions"
                            class="SiDlnk blue"
                            exact-active-class="active"
                        >
                            <span class="_IcN">
                                <svg
                                    width="30px"
                                    height="30px"
                                    role="img"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 640 512"
                                    class="svg-inline--fa fa-users fa-w-20 fa-2x"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"
                                        class=""
                                    ></path>
                                </svg>
                            </span>

                            <span class="_TnxT"> Transactions </span>
                        </router-link>
                        <router-link
                            to="/admin/wallets"
                            class="SiDlnk blue"
                            exact-active-class="active"
                        >
                            <span class="_IcN">
                                <svg
                                    width="30px"
                                    height="30px"
                                    role="img"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 640 512"
                                    class="svg-inline--fa fa-users fa-w-20 fa-2x"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"
                                        class=""
                                    ></path>
                                </svg>
                            </span>

                            <span class="_TnxT"> Wallet Settings </span>
                        </router-link>
                        <a
                            href="javascript::void(0)"
                            class="SiDlnk blue"
                            @click="logOut"
                        >
                            <span class="_IcN">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-power"
                                    width="44"
                                    height="44"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="#2c3e50"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    />
                                    <path d="M7 6a7.75 7.75 0 1 0 10 0" />
                                    <line x1="12" y1="4" x2="12" y2="12" />
                                </svg>
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
    </div>
</template>
<script>
import Drawer from "../../components/Drawer";
export default {
    components: {
        Drawer,
    },
    data() {
        return {
            tog: false,
        };
    },
    methods: {
        current_user() {
            return localStorage.getItem("name");
        },
        logOut() {
            localStorage.clear();
            this.$router.push("/admin");
        },
    },
};
</script>
