<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" v-model="formData.name">
                            <p class="text-danger" v-text="errors.name"></p>
                        </div>
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
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" v-model="formData.password_confirmation">
                            <p class="text-danger" v-text="errors.password_confirmation"></p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button @click="registerUser"  class="btn btn-primary">Register</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            errors: {}
        }
    },
    methods: {
        registerUser(){
            axios.post('api/register', this.formData).then((response)=> {
                localStorage.setItem('token', response.data.token)
                this.formData.name = this.formData.email = this.formData.password = this.formData.password_confirmation = ''
                this.errors = {}
                this.$router.push('/profile')
            }).catch((errors) => {
                this.errors = errors.response.data.errors
                console.log(errors.response.data.errors)
            });
        }
    }
};
</script>
