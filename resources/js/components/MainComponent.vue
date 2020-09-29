<template>

    <div id="main">
        <Header v-if="currentUser"/>
        <div class="content" style="height:100%">
            <router-view></router-view>
        </div>
    </div>


</template>

<script>

    import Header from './Header.vue';
    import Login from './Login.vue';


    export default {
        name: 'main-app',
        components: {Login,Header},

        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        }
    }




</script>