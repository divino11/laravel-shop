<template>
    <div class="minusplusnumber">
        <div class="mpbtn minus" v-on:click="mpminus(order, name)">
            -
        </div>

        <div id="field_container">
            <input type="number" class="mpinput" v-bind:name="name" v-model="newValue" />
        </div>

        <div class="mpbtn plus" v-on:click="mpplus(order, name)">
            +
        </div>
    </div>
</template>

<script>
    export default {
        name: "MinusPlusComponent",
        props: {
            value: {
                default: 0,
                type: Number
            },
            min: {
                default: 0,
                type: Number
            },
            max: {
                default: undefined,
                type: Number
            },
            name: {
                type: String
            },
            order: {
                default: null,
                type: Number
            }
        },
        data: function () {
            return {
                newValue: 0
            }
        },
        methods: {
            mpplus: function (order, size) {
                if (this.max == undefined || (this.newValue < this.max)) {
                    this.newValue = this.newValue + 1;
                    this.$emit('input', this.newValue);
                    if (order) {
                        axios.post('/add_to_basket/' + order + '/' + size)
                            .then(response => {
                                document.location.reload()
                            })
                            .catch(response => console.log(response.data));
                    }
                }
            },
            mpminus: function (order, size) {
                if ((this.newValue) > this.min) {
                    this.newValue = this.newValue - 1;
                    this.$emit('input', this.newValue);
                    if (order) {
                        axios.post('/remove_from_basket/' + order + '/' + size)
                            .then(response => {
                                document.location.reload()
                            })
                            .catch(response => console.log(response.data));
                    }
                }
            }
        },
        watch: {
            value: {
                handler: function (newVal, oldVal) {
                    this.newValue = newVal;
                }
            }
        },
        created: function() {
            this.newValue = this.value;
        }
    }
</script>

