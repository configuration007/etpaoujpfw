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
            <div class="jEqCLV">Top up Bitcoin wallet.</div>
            <div class="cDNAIu">
                Easily buy and sell Crypto straight from your Wallet.
            </div>
        </div>

        <div class="jBpENL">
            <div class="hWPHrf">
                <div class="abSAas jYTJyU" @click="$store.dispatch('sendBitcoin', true)">
                    Send
                </div>
                <div class="abSAas jaPQAA">Recieve</div>
            </div>
        </div>
        <div class="resdUS">
            <div class="dsADS" @click="getaddress">
                <placeholder-div v-if="loading"></placeholder-div>
                <div>
                    <img :src="barcode" alt="barcod" />
                </div>
            </div>
            <div class="asSSDS">
                <placeholder-div v-if="loading"></placeholder-div>
                <span @click="copyURL">{{ address }}</span>
            </div>
            <div class="syNSHah">
                <button class="bXDMBq" type="button" @click="copyURL">
                    Copy
                </button>
            </div>
        </div>
    </div>
</form>
</template>

<script>
import PlaceholderDiv from "./PlaceholderDiv";
import {
    mapGetters
} from "vuex";
export default {
    components: {
        PlaceholderDiv,
    },
    data() {
        return {
            loading: true,
            address: "3FZbgi29cpjq2GjdwV8eyHuJJnkLtktZc5",
            barcode: "",
        };
    },
    methods: {
        closeMe() {
            alert('loaded');
            this.ab = false
        },
        imageLoaded() {
            console.log("image loaded");
        },
        copyURL() {
            const tmpTextField = document.createElement("textarea");
            tmpTextField.textContent = this.address;
            tmpTextField.setAttribute(
                "style",
                "position:absolute; right:200%;"
            );
            document.body.appendChild(tmpTextField);
            tmpTextField.select();
            tmpTextField.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            tmpTextField.remove();
        },
        getaddress() {
            this.loading = true
            const {
                data
            } = axios
                .get("/api/client/get_barcode")
                .then(({
                    data
                }) => {
                    console.log(data);
                    const res = data.data;
                    this.address = res.address;
                    this.barcode = res.barcode;
                    this.loading = false
                });
        },
    },
    mounted() {
        this.getaddress();
    },
};
</script>
