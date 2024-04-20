<script>
    import Swal from 'sweetalert2';
    import Modal from "@/components/ModalWindow.vue";
    import EditIcon from "@/components/svg/EditSvgIcon.vue";
    import DeleteIcon from "@/components/svg/DeleteSvgIcon.vue";
    import { ref } from "vue";
    import modal from "bootstrap/js/src/modal.js";
    import {Bootstrap5Pagination} from "laravel-vue-pagination";
    import SearchBar from "@/components/SearchBar.vue";

    export default {
        name: 'MainTable',

        computed: {
            modal() {
                return modal
            },
        },

        components: {
            SearchBar,
            Modal,
            EditIcon,
            DeleteIcon,
            pagination: Bootstrap5Pagination,
        },

        data() {
            return {
                showModal: ref(false),
                modalData: {},
            }
        },

        setup(props) {
            const onSuccess = () => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true,
                    width: 200,
                });
                Toast.fire({
                    icon: "info",
                    title: "Copied!"
                });
            };

            const connections = ref({});
            const url_path = ref({});
            const savedSearch = ref('');

            const saveSearchQuery = (sq) => {
                savedSearch.value = sq;
            };

            const getConnectionsList = async (page = 1, searchQuery = '', url_path = '') =>
            {
                searchQuery = savedSearch.value;

                if (searchQuery === '') {
                    url_path = `/api?page=${page}`;
                } else {
                    url_path = `/api/search?query=${searchQuery}&page=${page}`;
                }
                const response = await fetch(url_path);
                connections.value = await response.json();
            }

            return { onSuccess, getConnectionsList, connections, saveSearchQuery, savedSearch }
        },

        mounted() {
            this.getConnectionsList();
        },

        methods: {
            editRemoteAccess(currentConnection) {
                axios.put('/api/' + currentConnection.id, currentConnection)
                    .then(response => {
                        this.getConnectionsList()
                    })
            },

            deleteRemoteAccess(currentConnectionID) {
                axios.delete('/api/' + currentConnectionID)
                    .then(response => {
                        this.getConnectionsList();
                    })
            },

            editConnection(connection) {
                this.modalData = Object.assign({}, connection);
            },

            search_results (s_res) {
                this.saveSearchQuery(s_res.connections);
                this.getConnectionsList(1, s_res.connections);
            },
        },
    }
</script>

<template>
    <SearchBar @connections_search='search_results'/>
    <pagination align="right" :data="connections" @pagination-change-page="getConnectionsList"></pagination>
    <table class="table" >
        <thead>
        <tr>
            <th scope="col" class="col-2">Client name or URL</th>
            <th scope="col" class="col-small">Protocol</th>
            <th scope="col">Host</th>
            <th scope="col">Login</th>
            <th scope="col">Password</th>
            <th scope="col" class="col-small">Port</th>
            <th scope="col">Date</th>
            <th class="cols-edit-remove"></th>
            <th class="cols-edit-remove"></th>
        </tr>
        </thead>
        <tbody v-for="connection in connections.data">
            <tr class="hand">
                <td
                    v-clipboard="connection.clientName"
                    v-clipboard:success="onSuccess"
                >{{ connection.clientName }}</td>

                <td v-clipboard="connection.protocol"
                    v-clipboard:success="onSuccess"
                >{{ connection.protocol }}</td>

                <td v-clipboard="connection.host"
                    v-clipboard:success="onSuccess"
                >{{ connection.host }}</td>

                <td v-clipboard="connection.login"
                    v-clipboard:success="onSuccess"
                >{{ connection.login }}</td>

                <td v-clipboard="connection.password"
                    v-clipboard:success="onSuccess"
                >{{ connection.password }}</td>

                <td v-clipboard="connection.port"
                    v-clipboard:success="onSuccess"
                >{{ connection.port }}</td>

                <td>{{ connection.created_at }}</td>

                <td @click="showModal = true; editConnection(connection)">
                    <EditIcon/>
                </td>
                <td @click="deleteRemoteAccess(connection.id)">
                    <DeleteIcon/>
                </td>
            </tr>

            <tr class="hand">
                <td
                    v-clipboard="connection.login + ':' + connection.password + '@' + connection.host"
                    v-clipboard:success="onSuccess"
                >
                    {{ connection.login + ':' + connection.password + '@' + connection.host }}
                </td>
                <td v-clipboard="connection.note"
                    v-clipboard:success="onSuccess"
                >{{ connection.note }}</td>
            </tr>
        </tbody>
    </table>
    <pagination align="center" :data="connections" @pagination-change-page="getConnectionsList"></pagination>

    <Teleport to="body">
        <modal :show="showModal" header="Edit Remote Access" @close="showModal = false">
            <template #body>
                <div class="input-group mb-3">
                    <input v-model="modalData.clientName" type="text" class="form-control" placeholder="Client name or URL">
                </div>

                <div class="input-group mb-3">
                    <select class="form-select" v-model="modalData.protocol">
                        <option :selected="modalData.protocol === 'ftp'" value="ftp">FTP</option>
                        <option :selected="modalData.protocol === 'ssh'" value="ssh">SSH</option>
                        <option :selected="modalData.protocol === 'apanel'" value="apanel">Apanel</option>
                        <option :selected="modalData.protocol === 'cpanel'" value="cpanel">Cpanel</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <input v-model="modalData.host" type="text" class="form-control" placeholder="Host">
                </div>

                <div class="input-group mb-3">
                    <input v-model="modalData.login" type="text" class="form-control" placeholder="Login">
                </div>

                <div class="input-group mb-3">
                    <input v-model="modalData.password" type="text" class="form-control" placeholder="Password">
                </div>

                <div class="input-group mb-3">
                    <input v-model="modalData.port" type="text" class="form-control" placeholder="Port">
                </div>

                <div class="input-group mb-3">
                    <input v-model="modalData.note" type="text" class="form-control" placeholder="Note">
                </div>
            </template>

            <template #footer>
                <div
                    class="btn btn-primary"
                    @click="showModal = false;"
                >Close</div>

                <div
                    class="btn btn-primary"
                    @click="showModal = false; editRemoteAccess(modalData)"
                >OK</div>
            </template>
        </modal>
    </Teleport>
</template>

<style scoped>
    .pagination{
        margin-bottom: 0;
    }
</style>
