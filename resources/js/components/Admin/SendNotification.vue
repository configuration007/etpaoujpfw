<template>
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
        <div class="jEqCLV">Send Notification.</div>
        <div class="cDNAIu">
            Email : <b>{{user ?  user.email :'-'}}</b> <br />
        </div>
    </div>
    <form class="gCdspF" @submit.prevent="sendNotification">
        <div class="cdsdASDC" style="margin-bottom:10px">
            <div class="sDEad">
                <input class="gqlmIw" type="text" v-model="payload.subject" required placeholder="Subject" />
            </div>
        </div>
        <vue-editor v-model="payload.content"></vue-editor>
        <div class="cdsdASDC">
            <div class="dEDaxd">
                <input type="checkbox" v-model="payload.send_to_mail" />
                <label>Should Also send an Email</label>
            </div>
        </div>
        <div class="bZFaRN" style="margin-top:20px">
            <button data-e2e="toBackupFlyout" height="48px" color="white" type="submit" class="hTtdgR">Send</button>
        </div>
    </form>
</div>
</div>
</template>

<script>
import {
    mapGetters
} from "vuex";

import {
    VueEditor
} from "vue2-editor";

export default {
    components: {
        VueEditor
    },
    data() {
        return {
            payload: {
                client_id: '',
                subject: '',
                content: '',
                send_to_mail: true,
            },
            user: null
        }
    },
    watch: {
        getDrawPayload() {
            this.setUser();
        },
    },
    computed: {
        ...mapGetters(["getDrawPayload"]),
    },
    methods: {
        setUser() {
            this.user = this.$store.getters.getDrawPayload;
            this.payload.client_id = this.user.id
            this.payload.content = null
        },
        sendNotification() {
            axios.post('/api/admin/send_notification', this.payload).then(() => {
                this.$toastr.Add({
                    title: 'Success',
                    msg: "Notification Sent",
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
        this.setUser()
    },
};
</script>
