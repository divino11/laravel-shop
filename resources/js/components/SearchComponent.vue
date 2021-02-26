<template>
    <div class="search_component">
        <i class="fas fa-search" v-show="!show" v-on:click="show = !show"></i>

        <div class="search_component-item">
            <i class="fas fa-times" v-show="show" v-on:click="show = !show"></i>

            <div v-show="show">
                <input type="text" class="search_component-input" minlength="3" required name="search">
                <button class="search_component-btn"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SearchComponent",
        data: function () {
            return {
                show: false
            }
        }
    }
</script>

