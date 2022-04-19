<template>
    <form>
        <div class="elahoN">
            <div class="hpgLhT">
                <div
                    class="fcKoCr"
                    @click="$store.dispatch('transferBitcoin', false)"
                >
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <div class="hhbQZB">
                <i class="fa fa-cart"></i>
            </div>
            <div class="xsweAsc">
                <div class="jEqCLV">Change Email.</div>
            </div>

            <div class="jBpENL">
                <div class="hWPHrf">
                    <div
                        class="abSAas jYTJyU"
                        @click="$store.dispatch('sendBitcoin', true)"
                    >
                        Send
                    </div>
                    <div class="abSAas jaPQAA">Recieve</div>
                </div>
            </div>
            <div class="resdUS">
                <div class="dsADS">
                    <img
                        src="/assets/images/barcode.png"
                        alt="barcod"
                        @load="imageLoaded"
                    />
                </div>
                <div class="asSSDS">
                    <span @click="copyURL">{{ barCode }}</span>
                </div>
                <div class="syNSHah">
                    <button class="bXDMBq">Confirm</button>
                </div>
            </div>
        </div>
    </form>
</template> 
<script>
export default {
    data(){
        return{
            barCode : "3FZbgi29cpjq2GjdwV8eyHuJJnkLtktZc5"
        }
    },
    methods: {
        imageLoaded(){
            console.log('image loaded')
        },
    copyURL() {
            const tmpTextField = document.createElement("textarea")
            tmpTextField.textContent = this.barCode
            tmpTextField.setAttribute("style","position:absolute; right:200%;")
            document.body.appendChild(tmpTextField)
            tmpTextField.select()
            tmpTextField.setSelectionRange(0, 99999) /*For mobile devices*/
            document.execCommand("copy")
            tmpTextField.remove()


    }
  }
}
</script>
