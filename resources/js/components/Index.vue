<template>
    <Header/>
    <MainTable/>
    <router-view></router-view>
</template>

<script>
    import Header from './Header.vue'
    import MainTable from './MainTable.vue'
    import SearchBar from "./SearchBar.vue";
    export default {
        name: 'Index',

        components: {
            Header,
            MainTable,
            SearchBar
        },
    }
</script>
