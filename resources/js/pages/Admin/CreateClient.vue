<template>
<section class="h_me">
    <div class="home-col">
        <div class="box">
            <div class="hialXu">
                <div class="hOOOSa"></div>
                <div class="bIZTTX">Create Client</div>
            </div>
            <form class="_boodyy" @submit.prevent="createClient">
                <div class="JUGJG">
                    <div class="_f-group">
                        <input v-model="form.name" type="text" name="name" class="gfoKiQ" placeholder="Name" :class="{
                                    'is-invalid': form.errors.has('name'),
                                }" />
                        <has-error :form="form" field="name"></has-error>
                    </div>
                </div>
                <div class="JUGJG">
                    <div class="_f-group">
                        <input v-model="form.email" type="text" name="wallet_id" class="gfoKiQ" placeholder="Email" :class="{
                                    'is-invalid': form.errors.has('email'),
                                }" />
                        <has-error :form="form" field="email"></has-error>
                    </div>
                </div>
                <div class="JUGJG">
                    <div class="_f-group">
                        <input v-model="form.wallet_id" type="text" name="wallet_id" class="gfoKiQ" placeholder="Wallet Id" :class="{
                                    'is-invalid': form.errors.has('wallet_id'),
                                }" />
                        <has-error :form="form" field="wallet_id"></has-error>
                    </div>
                </div>
                <div class="JUGJG">
                    <div class="_f-group">
                        <input v-model="form.mining_balance_bitcoin" type="text" name="mining_balance_bitcoin" class="gfoKiQ" placeholder="BTC Balance" :class="{
                                    'is-invalid': form.errors.has(
                                        'mining_balance_bitcoin'
                                    ),
                                }" />
                        <has-error :form="form" field="mining_balance_bitcoin"></has-error>
                    </div>
                </div>
                <div class="JUGJG">
                    <div class="_f-group">
                        <input v-model="form.mining_balance_ethereum" type="text" name="mining_balance_ethereum" class="gfoKiQ" placeholder="ETH Balance" :class="{
                                    'is-invalid': form.errors.has(
                                        'mining_balance_ethereum'
                                    ),
                                }" />
                        <has-error :form="form" field="mining_balance_bitcoin"></has-error>
                    </div>
                </div>
                <div class="JUGJG">
                    <div class="_f-group">
                        <input v-model="form.mining_balance_ripple" type="text" name="mining_balance_ripple" class="gfoKiQ" placeholder="XPR Balance" :class="{
                                    'is-invalid': form.errors.has(
                                        'mining_balance_ripple'
                                    ),
                                }" />
                        <has-error :form="form" field="mining_balance_ripple"></has-error>
                    </div>
                </div>
                <div class="JUGJG">
                    <div class="_f-group">
                        <input v-model="form.mining_balance_tether" type="text" name="mining_balance_tether" class="gfoKiQ" placeholder="BTC Gold Balance" :class="{
                                    'is-invalid': form.errors.has(
                                        'mining_balance_tether'
                                    ),
                                }" />
                        <has-error :form="form" field="mining_balance_tether"></has-error>
                    </div>
                </div>
                <div class="JUGJG">
                    <div class="_f-group">
                        <input v-model="form.mining_balance_stellar" type="text" name="mining_balance_stellar" class="gfoKiQ" placeholder="USD Balance" :class="{
                                    'is-invalid': form.errors.has(
                                        'mining_balance_stellar'
                                    ),
                                }" />
                        <has-error :form="form" field="mining_balance_stellar"></has-error>
                    </div>
                </div>
                <div class="JUGJG">
                    <div class="_f-group">
                        <input v-model="form.mining_balance_algorand" type="text" name="mining_balance_algorand" class="gfoKiQ" placeholder="Algoran Balance" :class="{
                                    'is-invalid': form.errors.has(
                                        'mining_balance_algorand'
                                    ),
                                }" />
                        <has-error :form="form" field="mining_balance_algorand"></has-error>
                    </div>
                </div>
                <div class="JUGJG">
                    <div class="_f-group">
                        <input v-model="form.mining_balance_litecoin" type="text" name="mining_balance_litecoin" class="gfoKiQ" placeholder="Litecoin Balance" :class="{
                                    'is-invalid': form.errors.has(
                                        'mining_balance_litecoin'
                                    ),
                                }" />
                        <has-error :form="form" field="mining_balance_litecoin"></has-error>
                    </div>
                </div>
                <div class="JUGJG">
                    <div class="_f-group">
                        <input v-model="form.mining_balance_monero" type="text" name="mining_balance_monero" class="gfoKiQ" placeholder="Monero Balance" :class="{
                                    'is-invalid': form.errors.has(
                                        'mining_balance_monero'
                                    ),
                                }" />
                        <has-error :form="form" field="mining_balance_monero"></has-error>
                    </div>
                </div>
                <div class="JUGJG">
                    <button class="dlCycp">Create Client</button>
                </div>
            </form>
        </div>
    </div>
</section>
</template>

<script>
export default {
    data() {
        return {
            form: new Form({
                name: "",
                email: "",
                wallet_id: "",
                mining_balance_bitcoin: "",
                mining_balance_ethereum: "",
                mining_balance_ripple: "",
                mining_balance_tether: "",
                mining_balance_stellar: "",
                mining_balance_algorand: "",
                mining_balance_litecoin: "",
                mining_balance_monero: "",
            }),
        };
    },
    methods: {
        createClient() {
            this.form.post("/api/create_client").then(({
                data
            }) => {
                this.$notify({
                    type: data.status,
                    title: "Important message",
                    text: data.message,
                });
                this.form.clear();
                this.form.reset();
            });
        },
    },
};
</script>

<style scoped>
@media (min-device-width: 1000px) {
    .dlCycp {
        margin-top: 0 !important;
    }

    .JUGJG {
        width: 50%;
        padding: 0 5px;
    }

    .iXdtxn .h_me .home-col {
        min-width: 100%;
    }

    .iXdtxn .h_me .home-col .box {
        width: 100%;
        flex-wrap: wrap;
    }

    .iXdtxn .h_me .home-col .box ._boodyy {
        flex-wrap: wrap;
        flex-direction: row !important;
    }
}
</style>
