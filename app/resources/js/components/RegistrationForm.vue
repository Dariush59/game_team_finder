<template>
    <form-wizard @onComplete="onComplete">
        <tab-content title="" :selected="true">
            <div class="form-group">
                <div class="game-selector">
                    <input
                            type="radio"
                            id="dota2"
                            value="Dota2"
                            name="game"
                            :class="hasError('game') ? 'is-invalid' : ''"
                            v-model="formData.game">
                    <label
                            for="dota2"
                            class="drinkcard-game dota2"
                    >
                    </label>
                    <br>
                    <input
                            type="radio"
                            id="fifa"
                            value="FIFA"
                            name="game"
                            :class="hasError('game') ? 'is-invalid' : ''"
                            v-model="formData.game">
                    <label
                            for="fifa"
                            class="drinkcard-game fifa"
                    >
                    </label>
                    <div v-if="hasError('game')" class="invalid-feedback">
                        <div
                                class="error"
                                v-if="!$v.formData.game.required"
                        >Please Choose your game.</div>
                    </div>
                </div>
            </div>
        </tab-content>
        <tab-content title="" >
            <div class="form-group">
                <div class="rank-selector" v-for="mmr in data.mmrs" :value="mmr.id">
                    <div v-for="rank in mmr" :value="rank.id">
                        <input
                                type="radio"
                                :id="rank.id"
                                :value="rank.id"
                                :class="hasError('rank') ? 'is-invalid' : ''"
                                v-model="formData.rank">
                        <label
                                :for="rank.id"
                                class="drinkcard-game ">
                            <div style="color: white">
                                <h5>{{rank.name}}</h5>
                                <p>
                                    {{ rank.from }}{{ rank.to ?  ` - ${rank.to}` : rank.from ? '+' : null }} {{rank.description}}
                                </p>
                            </div>
                        </label>
                        <div v-show="mmr.length == rank.id" v-if="hasError('game')" class="invalid-feedback">
                            <div class="error" v-if="!$v.formData.rank.required">
                                Please Choose your game.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </tab-content>
        <tab-content title="" >
            <div class="form-group">
                <label class="typo__label"><h4>Preferred positions</h4><p>Select one or two options</p></label>
                <multiselect
                        v-model="formData.position_ids"
                        :options="data.options"
                        :multiple="true"
                        :close-on-select="false"
                        :clear-on-select="false"
                        :preserve-search="true"
                        placeholder="Pick some"
                        label="name"
                        track-by="name"
                        :preselect-first="true"
                        :hide-selected="true"
                        :max="2">
                    <template
                            lot="selection"
                            slot-scope="{ values, search, isOpen }">
                            <span class="multiselect__single"
                                  v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected
                            </span>
                    </template>
                </multiselect>
            </div>

            <div class="form-group">
                <label for="referral">Location</label>
                <select v-for="region in data.regions" :value="region.id"
                        :class="hasError('region') ? 'is-invalid' : ''"
                        class="form-control"
                        v-model="formData.region"
                >
                    <option v-for="reg in region" :value="reg.id">{{reg.name}}</option>

                </select>
                <div v-if="hasError('region')" class="invalid-feedback">
                    <div class="error" v-if="!$v.formData.region.required">Please select one.</div>
                </div>
            </div>

            <div class="form-group">
                <label for="email"><span>Your Email</span></label>
                <input
                        type="email"
                        class="form-control"
                        :class="hasError('email') ? 'is-invalid' : ''"
                        placeholder="Enter your email"
                        v-model="formData.email"
                >
                <div v-if="hasError('email')" class="invalid-feedback">
                    <div class="error" v-if="!$v.formData.email.required">Email field is required</div>
                    <div class="error" v-if="!$v.formData.email.email">Should be in email format</div>
                </div>
            </div>

            <div class="form-group form-check">
                <input
                        type="checkbox"
                        :class="hasError('discord') ? 'is-invalid' : ''"
                        class="form-check-input"
                        v-model="formData.discord"
                >

                <label class="form-check-label font-color-white">I accept to login with discord </label>
                <div v-if="hasError('discord')" class="invalid-feedback">
                    <div class="error" v-if="!$v.formData.discord.required">This field is required.</div>
                </div>
            </div>

        </tab-content>
    </form-wizard>
</template>

<script>
    import { FormWizard, TabContent, ValidationHelper } from "vue-step-wizard";
    import "vue-step-wizard/dist/vue-step-wizard.css";
    import { required } from "vuelidate/lib/validators";
    import { email } from "vuelidate/lib/validators";
    // import { numeric } from 'vuelidate/lib/validators';
    import Multiselect from 'vue-multiselect';

    export default {
        name: "StepFormValidation",
        components: {
            FormWizard,
            TabContent,
            Multiselect
        },
        mixins: [ValidationHelper],
        data() {
            return {
                data:{
                    mmrs: [],
                    options: [],
                    regions: []
                },
                formData: {
                    game: null,
                    email: null,
                    rank: null,
                    discord: null,
                    position_ids: '',
                    region: null
                },
                validationRules: [
                    { game: { required } },
                    { rank: { required } },
                    {
                        position_ids: { required },
                        region: { required },
                        email: { required, email },
                        discord: { required }
                    }
                ]
            };
        },
        mounted () {
            axios.get('/api/mmrs')
                .then(response => (this.data.mmrs = response.data));
            axios.get('/api/dota-2-positions')
                .then(response => (this.data.options = response.data));
            axios.get('/api/regions')
                .then(response => (this.data.regions = response.data));
        },
        methods: {
            onComplete() {
                localStorage.setItem('formData',  JSON.stringify(this.formData));
                window.location.replace('/discord-oauth');
            }
        }
    };

</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    * {
        font-family: 'Lato', 'Avenir', sans-serif;
    }
    .game-selector {
        display: flex;
        flex-direction: row;
        margin: 5px;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }
    .game-selector input{
        text-align:center;
        margin:5px;
        padding:0;
        -webkit-appearance:none;
        -moz-appearance:none;
        appearance:none;
    }
    .dota2{background-image:url(/img/dota-2.c7c7dd3.jpg);}
    .fifa{background-image:url(/img/fifa.5c292dd.jpg);}

    .game-selector input:active +.drinkcard-game{opacity: .9;}
    .game-selector input:checked +.drinkcard-game{
        -webkit-filter: none;
        -moz-filter: none;
        filter: none;
    }
    .game-selector label.drinkcard-game{
        width:200px;
        height:300px;
    }


    .drinkcard-game{
        cursor:pointer;
        background-size:contain;
        background-repeat:no-repeat;
        display:inline-block;
        -webkit-transition: all 100ms ease-in;
        -moz-transition: all 100ms ease-in;
        transition: all 100ms ease-in;
        -webkit-filter: brightness(1.8) grayscale(1) opacity(.7);
        -moz-filter: brightness(1.8) grayscale(1) opacity(.7);
        filter: brightness(1.8) grayscale(1) opacity(.7);
    }
    .drinkcard-game:hover{
        -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
        -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
        filter: brightness(1.2) grayscale(.5) opacity(.9);
    }

    /* Extras */
    a:visited{color:#888}
    a{color:#444;text-decoration:none;}
    p{margin-bottom:.3em;}

    .vue-step-wizard {
        background-color: transparent !important;
        width: 100%;
    }
    .step-body {
        background-color: transparent !important;
    }
    .step-pills {
        display: none;
    }

    .game-selector input{
        text-align:center;
        margin:5px;
        padding:0;
        -webkit-appearance:none;
        -moz-appearance:none;
        appearance:none;
    }

    label.drinkcard-rank {
        height: 50px;
        width: 100%;
        padding: 10px;
        background-color: currentcolor;
        opacity: 80%;
    }

    .rank-selector label.drinkcard-game {
        width: 100%;
        background-color: black;
        padding: 10px;
        opacity: 80%;
    }
    span {
        color: white;
    }
    h5 {
        color: white;
    }
    .rank-selector input {
        position: absolute;
        visibility: hidden;
    }

    .multiselect__tags {
        border: 1px solid #212529;
        background: #212529;
    }

    .multiselect__content-wrapper {
        background: #212529;
    }

    label.typo__label {
        color: white;
    }

    select.form-control {
        background-color: #212529;
        color: white;
    }
    .font-color-white{
        color: white;
    }
</style>