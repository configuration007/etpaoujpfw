<template>
<form>
    <div class="elahoN">
        <div class="hpgLhT">
            <div class="fcKoCr" @click="$store.dispatch('closeDraw')">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="hhbQZB">
            <i class="fa fa-cart"></i>
        </div>
        <div class="xsweAsc">
            <div class="jEqCLV">Create Client Wallet.</div>
            <div class="cDNAIu">
                <br />
            </div>
        </div>
        <form class="gCdspF" @submit.prevent="is_edit ? editWallet() :createWallet()">
            <div class="cdsdASDC">
                <label>Wallet Name (Not visible to clients)</label>
                <div class="sDEad">
                    <input class="gqlmIw" type="text" v-model="payload.name" />
                </div>
            </div>
            <div class="cdsdASDC">
                <label>Wallet Address</label>
                <div class="sDEad">
                    <input class="gqlmIw" type="text" v-model="payload.address" />
                </div>
            </div>
            <div class="cdsdASDC">
                <div class="wallet_img">
                    <image-upload :caption="'Upload Bar Code'" @imageUpdated="payload.barcode = $event" :imagevalue="payload.barcode" @clearImage="payload.barcode = ''" />
                </div>
            </div>
            <div class="bZFaRN" style="margin-top:20px">
                <button data-e2e="toBackupFlyout" height="48px" color="white" type="submit" class="hTtdgR">{{is_edit ? 'Edit' : 'Create'}}</button>
            </div>
        </form>
    </div>
    </div>
</form>
</template>

<script>
import {
    mapGetters
} from "vuex";
import ImageUpload from "../ImageUpload";

export default {
    components: {
        ImageUpload,
    },
    data() {
        return {
            payload: {
                id: '',
                name: '',
                address: '',
                barcode: '',
            },
            is_edit: false,
            Wallet: null,
        };
    },
    watch: {
        getDrawPayload() {
            this.setWallet();
        },
    },
    computed: {
        ...mapGetters(["getDrawPayload"]),
    },
    methods: {
        setWallet() {
            const payload = this.$store.getters.getDrawPayload;
            if (payload) {
                this.payload = payload
                this.is_edit = true;
            }
        },

        createWallet() {
            axios.post('/api/admin/dest_wallet', this.payload).then(() => {
                this.$toastr.Add({
                    title: 'Success',
                    msg: "Record Created",
                    progressbar: false,
                    type: "success",
                    classNames: ["success_toast"],
                    style: {
                        backgroundColor: "white",
                        color: "black"
                    },
                });
            }).catch((e) => {
                this.$toastr.Add({
                    title: 'Error',
                    msg: "Something went wrond",
                    progressbar: false,
                    type: "error",
                    classNames: ["error_toast"],
                    style: {
                        backgroundColor: "white",
                        color: "black"
                    },
                });
            })
            this.$store.dispatch("closeDraw");
        },
        editWallet() {
            axios.put('/api/admin/dest_wallet/' + this.payload.id, this.payload).then(() => {
                this.$toastr.Add({
                    title: 'Success',
                    msg: "Record Updated",
                    progressbar: false,
                    type: "success",
                    classNames: ["success_toast"],
                    style: {
                        backgroundColor: "white",
                        color: "black"
                    },
                });
            }).catch((e) => {
                this.$toastr.Add({
                    title: 'Error',
                    msg: "Something went wrond",
                    progressbar: false,
                    type: "error",
                    classNames: ["error_toast"],
                    style: {
                        backgroundColor: "white",
                        color: "black"
                    },
                });
            })
            this.$store.dispatch("closeDraw");
        }
        
    },
    mounted() {
        this.setWallet();
    },
};
</script>
