<script>
    export default {
        name: "Login",

        data() {
            return {
                email: '',
                password: '',
            }
        },

        methods: {
            login() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/login', { email: this.email, password: this.password })
                        .then( res => {
                            // localStorage.setItem('authToken', res.config.headers['X-XSRF-TOKEN']);
                            this.$router.push({name: 'main'})
                        })
                        .catch( err => {
                            console.log(err.response);
                        })
                });
            }
        }
    }
</script>

<template>
    <div>
        <form>
            <div class="form-group mb-3 ">
                <label for="exampleInputEmail1">Email address</label>
                <input v-model="email" type="email" class="form-control mt-1 w-25" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputPassword1">Password</label>
                <input v-model="password" type="password" class="form-control mt-1 w-25" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button @click.prevent="login" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<style scoped>

</style>
