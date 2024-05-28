<template>
<!--    <router-link :to="{ name: 'login'}">Login</router-link>-->
<!--    <router-link :to="{ name: 'register'}">Register</router-link>-->
    <a @click.prevent='logout' href="#">Logout</a>

    <router-view></router-view>
</template>

<script>
    export default {
        name: 'Index',

        methods: {
            logout() {
                axios.post('/logout')
                    .then (res =>  {
                    this.$router.push({name: 'login'})
                })
            },
        }
    }
</script>
