<template>
    <Sidebar />
    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" v-model="formData.email">
                            <p class="text-danger" v-text="errors.email"></p>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" v-model="formData.password">
                            <p class="text-danger" v-text="errors.password"></p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button @click="login" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <router-link to="/register">Create New Account</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "./Sidebar";
import Header from "./Header";

export default {
    components: { 
        Sidebar,
        Header
        },
    data() {
        return {
            formData: {
                email: '',
                password: '',
                device_name: 'browser'
            },
            errors: {}
        }
    },
    methods: {
        login(){
            axios.post('api/login', this.formData).then((response) => {
                console.log(response.data)
                localStorage.setItem('token', response.data.token)
                this.$router.push('/profile')
            }).catch((errors) => {
                this.errors = errors.response.data.errors
            })
        }
    }
};
</script>
