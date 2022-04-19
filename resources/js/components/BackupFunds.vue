<template>
<div>
    <div class="elahoN" v-if="layer == 1">
        <div class="hpgLhT">
            <div class="fcKoCr" @click="$store.dispatch('transferBitcoin', false)">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="hhbQZB">
            <i class="fa fa-cart"></i>
        </div>

        <div class="xsweAsc">
            <div class="jEqCLs">Secret Private Key Recovery Phrase.</div>
            <div class="cDNAIs">
                In crypto, when you hold the private keys, you're in control
                of the funds in your Private Key Wallet. The downside is
                that WHOEVER holds your private keys can control your
                Private Key Wallet
            </div>
            <div class="cDNAIs">
                So you must: <br>
                1. Write down the 12 word phrase on the next screen in the exact order it appears.<br>
                2. Keep it safe, ideally on a securely stored piece of paper (in other words, not a digital copy).<br>
                3. NEVER share your Secret Private Key Recovery Phrase with anyone.<br>
            </div>
            <div class="cDNAIs">
                Warning: If someone has your Secret Private Key Recovery Phrase they will have access to your Private Key Wallet and can withdraw funds.
            </div>
            <div class="bBTnet">
                <div class="hcolEF">
                    <div class="kgTWLa">
                        <div class="cqfRsR">!</div>
                    </div>
                </div>
                <div class="hEgldK" style="margin-left:25px;">
                    Blockchain.remotemining.net will never ask to view or receive your Secret Private Key Recovery Phrase.</div>
            </div>

            <div class="bZFaRN">
                <button data-e2e="toBackupFlyout" height="48px" color="white" type="button" class="hTtdgR" @click="layer = 2">View Secret Private Key Recovery Phrase</button>
            </div>
        </div>

    </div>
    </div>
    <div class="elaho2" v-if="layer == 2">
        <div class="xsweAsc sdsdseSA">
            <div class="jEqCLs jEqCLswes">
                <span color="grey600" role="button" data-e2e="recoveryBackArrow" class="sc-bxivhb kWdPjc" style="color: rgb(103, 113, 132); font-size: 20px; font-weight: 400; margin-right: 24px;"></span>
                Secret Private Key Recovery Phrase.</div>
            <div class="cDNAIs">
                Carefully write down these 12 words in order. Do not email or screenshot your Secret Private Key Recovery Phrase.
            </div>
        </div>
        <div class="fOIFTw">
            <div class="WdPpq">
                <div class="dglrAP">1</div>
                <div class="fFGLio">penalty</div>
            </div>
        </div>
        <div class="fOIFTw">
            <div class="WdPpq">
                <div class="dglrAP">2</div>
                <div class="fFGLio">penalty</div>
            </div>
        </div>
        <div class="xsweAsc sdsdseSA">
            <div class="bZFaRN">
                <button data-e2e="toBackupFlyout" height="48px" color="white" type="button" class="hTtdgR" @click="layer = 3">Continue</button>
            </div>
        </div>
    </div>
    <div class="elaho2" v-if="layer == 3">
        <div class="xsweAsc sdsdseSA">
            <div class="jEqCLs jEqCLswes">
                <span color="grey600" role="button" data-e2e="recoveryBackArrow" class="sc-bxivhb kWdPjc" style="color: rgb(103, 113, 132); font-size: 20px; font-weight: 400; margin-right: 24px;"></span>
                Secret Private Key Recovery Phrase.</div>
            <div class="cDNAIs">
                Carefully write down these 12 words in order. Do not email or screenshot your Secret Private Key Recovery Phrase.
            </div>
        </div>
        <div class="fOIFTw">
            <div class="WdPpq">
                <div class="dglrAP">1</div>
                <div class="fFGLio">penalty</div>
            </div>
        </div>
        <div class="fOIFTw">
            <div class="WdPpq">
                <div class="dglrAP">2</div>
                <div class="fFGLio">penalty</div>
            </div>
        </div>
        <div class="xsweAsc sdsdseSA">
            <div class="bZFaRN">
                <button data-e2e="toBackupFlyout" height="48px" color="white" type="button" class="hTtdgR" @click="layer++">Continue</button>
            </div>
        </div>
    </div>
      <div class="elahoN" v-if="layer == 4">
        <div class="hpgLhT">
            <div class="fcKoCr" @click="$store.dispatch('transferBitcoin', false)">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="hhbQZB">
            <i class="fa fa-cart"></i>
        </div>

        <div class="xsweAsc">
            <div class="jEqCLs">Confirm Your Phrase.</div>
            <div class="cDNAIs">
               Please enter the words that match the numbers you see below.
            </div>

           <div class="cdsdASDC acdeeA">
                <label>6th</label>
                <div class="sDEad">
                    <input class="gqlmIw" type="text" />
                </div>
            </div>

            <div class="cdsdASDC acdeeA">
                <label>8th</label>
                <div class="sDEad">
                    <input class="gqlmIw" type="text" />
                </div>
            </div>

            <div class="bZFaRN" style="margin-top:20px">
                <button data-e2e="toBackupFlyout" height="48px" color="white" type="button" class="hTtdgR" @click="layer = 2">View Secret Private Key Recovery Phrase</button>
            </div>
        </div>

    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            layer: 1,
            backupPhrase :null
        }
    },
    methods: {
        imageLoaded() {
            console.log('image loaded')
        },
        confirm() {

        },
        copyURL() {
            const tmpTextField = document.createElement("textarea")
            tmpTextField.textContent = this.barCode
            tmpTextField.setAttribute("style", "position:absolute; right:200%;")
            document.body.appendChild(tmpTextField)
            tmpTextField.select()
            tmpTextField.setSelectionRange(0, 99999) /*For mobile devices*/
            document.execCommand("copy")
            tmpTextField.remove()

        },
        getBackupPhrase(){
            axios.get('/api/client/get_backup_phrase').then(({data})=>{
                console.log(data.data)
                this.backupPhrase =data.data
            })
        }

    },
    mounted(){
        this.getBackupPhrase()
    }
}
</script>
