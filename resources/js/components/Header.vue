<template>
<div class="header mb-4">
    <div class="main-table-title">
        <h2 class="w-50">Remote Access App</h2>
        <div class="btn btn-info btn-add" @click="showModal = true">Добавить
        <Teleport to="body">
            <modal :show="showModal" header="Add Remote Access" @close="showModal = false">
                <template #body>
                    <div class="input-group mb-3">
                        <input v-model="connectionData.clientName" type="text" class="form-control" placeholder="Client name or URL">
                    </div>

                    <div class="input-group mb-3">
                        <select class="form-select" v-model="connectionData.protocol">
                            <option value="ftp">FTP</option>
                            <option value="ssh">SSH</option>
                            <option value="apanel">Apanel</option>
                            <option value="cpanel">Cpanel</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <input v-model="connectionData.host" type="text" class="form-control" placeholder="Host">
                    </div>

                    <div class="input-group mb-3">
                        <input v-model="connectionData.login" type="text" class="form-control" placeholder="Login">
                    </div>

                    <div class="input-group mb-3">
                        <input v-model="connectionData.password" type="text" class="form-control" placeholder="Password">
                    </div>

                    <div class="input-group mb-3">
                        <input v-model="connectionData.port" type="text" class="form-control" placeholder="Port">
                    </div>

                    <div class="input-group mb-3">
                        <input v-model="connectionData.note" type="text" class="form-control" placeholder="Note">
                    </div>
                </template>

                <template #footer>
                    <div
                        class="btn btn-primary"
                        @click="showModal = false"
                    >Close</div>

                    <div
                        class="btn btn-primary"
                        @click="showModal = false; addRemoteAccess(connectionData)"
                    >OK</div>
                </template>
            </modal>
        </Teleport>
        </div>
    </div>
    <h6 class="w-50">Сделано потому что заебало</h6>
</div>
</template>


<script>
import Modal from './ModalWindow.vue'
import { ref } from 'vue'
import ModalWindow from "@/components/ModalWindow.vue";

const showModal = ref(false);
export default {
    name: 'Header',

    components: {
        ModalWindow,
        Modal
    },

    data() {
        return {
            showModal: ref(false),

            connectionData: {
                clientName: '',
                protocol: 'ftp',
                host: '',
                login: '',
                password: '',
                port: null,
                note: ''
            },
        }
    },

    methods: {
        addRemoteAccess(connectionData) {
            axios.post('/api/add', connectionData)
                .then(response => {
                    console.log(response);
                })
        }
    }
}
</script>

<style scoped>

</style>
