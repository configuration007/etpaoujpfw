<template>
    <div class="kkWkiI">
        <div class="ggSgmY">
            <div class="iMZDOM">
                <div class="cenhZg">
                    <div class="dEEQlK">
                        <span
                            color="grey200"
                            class="sc-bxivhb sMyZH sc-bCMXmc OOwuT"
                            style="
                                color: rgb(204, 210, 222);
                                font-size: 40px;
                                font-weight: 400;
                            "
                        ></span>
                    </div>
                </div>
                <div class="ibjJgd">
                    <div class="hLPaIA">Change Email</div>
                    <div class="bsyJxO">
                        We have sent a verification email to abcd1012@gmail.com.
                        Please click on the email that you’ve received to verify
                        your email. We’ll use this email to authorize logins,
                        send payment notifications, and notify you of wallet
                        updates.
                    </div>
                </div>
            </div>
            <div class="bXQITo">
                <button class="iNAIGQ" @click="$store.dispatch('adjustDrawal','change-email')">Change Email</button>
            </div>
            <div class="hiZtVi"></div>
        </div>

        <div class="ggSgmY">
            <div class="iMZDOM">
                <div class="cenhZg">
                    <div class="dEEQlK">
                        <span
                            color="grey200"
                            class="sc-bxivhb sMyZp sc-bCMXmc OOwuT"
                            style="
                                color: rgb(204, 210, 222);
                                font-size: 40px;
                                font-weight: 400;
                            "
                        ></span>
                    </div>
                </div>
                <div class="ibjJgd">
                    <div class="hLPaIA">Change Password</div>
                    <div class="bsyJxO">
                        Your password is never shared with Blockchain or stored on our servers. We cannot access or reset your password. The only way to restore your wallet is through your Secret Private Key Recovery Phrase .Make sure you write down your Secret Private Key Recovery Phrasewhich is the only way to restore access to your wallet in the event of a lost password.
                    </div>
                </div>
            </div>
            <div class="bXQITo">
                <button class="iNAIGQ" @click="$store.dispatch('adjustDrawal','change-password')">Change Password</button>
            </div>
            <div class="hiZtVi"></div>
        </div>

        <div class="ggSgmY">
            <div class="iMZDOM">
                <div class="cenhZg">
                    <div class="dEEQlK">
                        <span
                            color="grey200"
                            class="sc-bxivhb sMyZe sc-bCMXmc OOwuT"
                            style="
                                color: rgb(204, 210, 222);
                                font-size: 40px;
                                font-weight: 400;
                            "
                        ></span>
                    </div>
                </div>
                <div class="ibjJgd">
                    <div class="hLPaIA">Secret Private Key Recovery Phrase</div>
                    <div class="bsyJxO">
                        Your Secret Recovery Phrase is needed to recover your
                        wallet in case the password is lost. Please write these
                        12 words down, in order, and keep them somewhere safe
                        offline. The secret recovery phrase gives you (or anyone
                        who has it) a way to restore your wallet and access your
                        funds. In the event that you lose your password or our
                        service is unavailable, this will be your safety net.
                        <br>
                        <br>
                        <span class="sdesa">
                            Never share your secret phrase with anyone.
                            Blockchain.com will never ask you for this
                            information.
                        </span>
                    </div>
                </div>
            </div>
            <div class="bXQITo">
                <button class="iNAIGQ" @click="$store.dispatch('adjustDrawal','backup-funds')">Backup Funds</button>
            </div>
        </div>
    </div>
</template>
