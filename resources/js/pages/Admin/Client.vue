<template>
<div>
    <v-app id="inspire">
        <v-data-table :headers="headers" :items="clients" sort-by="calories" class="elevation-1">
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>All Clients</v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>

                    <input type="hidden" v-model="copied_me" id="copied_me" />
                    <v-dialog v-model="dialog" max-width="500px">
                        <v-card>
                            <v-card-title class="headline">
                                Notifications
                                <v-btn x-small color="red lighten-1" @click="view_notice = !view_notice">{{
                                            view_notice ? "Add" : "View"
                                        }}</v-btn>
                            </v-card-title>
                            <v-card-text v-if="view_notice">
                                <v-list-item v-for="data in all_notification" :key="data.id">
                                    <v-list-item-content>
                                        <v-list-item-title>{{
                                                data.type
                                            }}</v-list-item-title>
                                        <v-list-item-subtitle>{{
                                                data.message
                                            }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                    <v-list-item-action>
                                        <v-btn icon>
                                            <v-btn x-small color="red lighten-1" @click="
                                                        deleteNotification(
                                                            data.id
                                                        )
                                                    ">Delete</v-btn>
                                        </v-btn>
                                    </v-list-item-action>
                                </v-list-item>
                            </v-card-text>
                            <v-card-text v-else>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-text-field :rules="['Required']" v-model="
                                                        notification.message
                                                    " label="Notification Message"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-select :rules="['Required']" v-model="notification.type" :items="[
                                                        'Error',
                                                        'Success',
                                                        'Warning',
                                                    ]" label="Notification Type" solo></v-select>
                                        </v-col>
                                        <v-col cols="4" sm="4" md="4">
                                            <v-btn color="red lighten-2" elevation="2" small @click="addNotification">Add Notification</v-btn>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close">
                                    Cancel
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>

                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                            <v-card-title class="headline">Are you sure you want to delete this
                                item?</v-card-title>
                            <v-card-actions>
                                <v-spacer></v-spacer>

                                <v-row justify="center">
                                    <v-btn color="blue lighten-2" elevation="2" small @click="closeDelete">Cancel</v-btn>
                                    <v-btn color="red lighten-2" elevation="2" small @click="deleteItemConfirm">Yes, Delete</v-btn>
                                </v-row>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>

                    <v-dialog v-model="dialogMiner" max-width="500px">
                        <v-card>
                            <v-card-title class="headline">Client Finance?</v-card-title>
                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="
                                                        mining_record.mining_balance_bitcoin
                                                    " label="BTC BALANCE"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="
                                                        mining_record.mining_balance_ethereum
                                                    " label="ETH BALANCE"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="
                                                        mining_record.mining_balance_ripple
                                                    " label="XPR BALANCE"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="
                                                        mining_record.mining_balance_tether
                                                    " label="BTC GOLD"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="
                                                        mining_record.mining_balance_stellar
                                                    " label="STELLAR"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="
                                                        mining_record.mining_balance_algorand
                                                    " label="ALGORAND"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="
                                                        mining_record.mining_balance_litecoin
                                                    " label="LITECOIN"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="
                                                        mining_record.mining_balance_monero
                                                    " label="MONERO"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-btn @click="updateMiningBalance" color="red lighten-2" elevation="2" small>Update Balance</v-btn>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>

            <template v-slot:item.actions="{ item }">
                <v-row justify="center">
                    <v-btn color="red lighten-2" elevation="2" small @click="deleteItem(item)">Delete Client</v-btn>
                    <v-btn color="blue lighten-2" elevation="2" small @click="openMining(item)">Account</v-btn>
                    <v-btn color="green lighten-2" elevation="2" small @click="openNotification(item.id)">Notification
                    </v-btn>
                    <v-btn color="black lighten-2" class="white--text" elevation="2" small @click="copyClientCode(item)">Copy
                    </v-btn>
                </v-row>
            </template>
            <template v-slot:no-data>
                <v-btn color="primary" @click="initialize"> Refresh </v-btn>
            </template>
        </v-data-table>
    </v-app>
</div>
</template>

<script>
export default {
    data() {
        return {
            copied_me: "",
            view_notice: true,
            notification: {
                message: "",
                type: "",
            },
            all_notification: [],
            mining_record: {
                mining_balance_bitcoin: "",
                mining_balance_ethereum: "",
                mining_balance_ripple: "",
                mining_balance_tether: "",
                mining_balance_stellar: "",
                mining_balance_stellar: "",
                mining_balance_algorand: "",
                mining_balance_litecoin: "",
                mining_balance_monero: "",
            },
            currentMiningId: "",
            currentNotificationId: "",
            dialog: false,
            dialogDelete: false,
            dialogMiner: false,
            headers: [{
                    text: "Client Email",
                    align: "start",
                    value: "email",
                },
                {
                    text: "Wallet ID",
                    value: "access_id"
                },
                {
                    text: "Access code",
                    value: "blockchain_access_key"
                },
                {
                    text: "Actions",
                    value: "actions",
                    sortable: false,
                    align: "center",
                },
            ],
            clients: [],
            editedIndex: -1,

            editedItem: "",
            defaultItem: {
                name: "",
                calories: 0,
                fat: 0,
                carbs: 0,
                protein: 0,
            },
        };
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "New Item" : "Edit Item";
        },
    },

    watch: {
        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        },
        dialogMiner(val) {
            val || this.closeMiner();
        },
    },

    created() {
        this.initialize();
    },

    methods: {
        copyClientCode(item) {
            var site_ip = "https://block8278625lx.com";
            this.copied_me =
                site_ip + "/block_access?access_token=" + item.access_id;
            let testingCodeToCopy = document.querySelector("#copied_me");
            testingCodeToCopy.setAttribute("type", "text");
            testingCodeToCopy.select();
            try {
                var successful = document.execCommand("copy");
                var msg = successful ? "Copy Client Link !" : "unsuccessful";
            } catch (err) {
                alert("Oops, unable to copy");
            }
        },
        deleteNotification(id) {
            axios
                .delete("/api/delete_notification/" + id)
                .then(({
                    data
                }) => {
                    this.openNotification(this.currentNotificationId);
                })
                .catch((e) => {
                    console.log(e);
                });
        },
        addNotification() {
            axios
                .post(
                    "/api/add_notification/" + this.currentNotificationId,
                    this.notification
                )
                .then(({
                    data
                }) => {
                    this.openNotification(this.currentNotificationId);
                })
                .catch((e) => {
                    console.log(e);
                });
        },
        initialize() {
            axios.get("/api/view_client").then(({
                data
            }) => {
                this.clients = data;
            });
        },

        editItem(item) {
            this.editedIndex = this.clients.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        openMining(item) {
            var id = item.id;
            this.currentMiningId = id;
            axios.get("/api/client_mining/" + id).then(({
                data
            }) => {
                this.mining_record = data;
                this.dialogMiner = true;
            });
        },
        updateMiningBalance() {
            axios
                .put(
                    "/api/client_update_mining/" + this.currentMiningId,
                    this.mining_record
                )
                .then(({
                    data
                }) => {
                    this.initialize();
                    this.dialogMiner = false;
                })
                .catch((e) => {
                    console.log(e);
                });
        },
        openNotification(id) {
            this.currentNotificationId = id;
            this.view_notice = true;
            axios
                .get("/api/get_notification/" + this.currentNotificationId)
                .then(({
                    data
                }) => {
                    this.all_notification = data;
                    this.dialog = true;
                })
                .catch((e) => {
                    console.log(e);
                });
        },
        deleteItem(item) {
            this.editedIndex = item.id;
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            axios
                .delete("/api/delete_client/" + this.editedIndex)
                .then(({
                    data
                }) => {
                    this.initialize();
                });
            this.closeDelete();
        },

        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        closeDelete() {
            this.dialogDelete = false;
            this.initialize();
        },
        closeMiner() {
            this.dialogMiner = false;
        },
        save() {
            if (this.editedIndex > -1) {
                Object.assign(this.clients[this.editedIndex], this.editedItem);
            } else {
                this.clients.push(this.editedItem);
            }
            this.close();
        },
    },
};
</script>

<style>
#copied_me {
    border: 1px solid #ccc;
    min-width: 350px;
}

#copied_me:focus {
    border: 1px solid green;
    min-width: 350px;
    outline: none;
}

.v-btn {
    margin: auto 2px !important;
}
</style>
