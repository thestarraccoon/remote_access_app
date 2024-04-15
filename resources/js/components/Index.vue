<template>
    <Header/>
    <MainTable/>
    <router-view></router-view>
</template>

<script>
    import Header from './Header.vue'
    import MainTable from './MainTable.vue'
    export default {
        name: 'Index',

        components: {
            Header,
            MainTable
        },
    }
</script>
