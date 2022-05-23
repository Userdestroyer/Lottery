<template>
    <Sidebar />
    <div class="d-flex flex-column">
        <div class="d-flex justify-content-evenly">
            MY PROFILE PAGE
            <button @click="logout" class="btn btn-primary float-right">Logout</button>
        </div>
        <div >
            <p class="text-center">Name: {{data.name}}</p>
            <p class="text-center">Email: {{data.email}}</p>
            <p class="text-center">Phone: {{data.phone_number}}</p>
            <p class="text-center">Role: {{data.role}}</p>
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
    data(){
        return {
            data: [],
            token: localStorage.getItem('token')
        }
    },
    methods: {
        getInfo(){
            axios.get('/api/profile').then((response) => {
                this.data = response.data
            }).catch((errors) => {
                console.log(errors)
            });
        },
        logout(){
            this.$router.push('/login')
            axios.post('/api/logout').then((response) => {
                localStorage.removeItem('token')
            }).catch((errors) => {
                console.log(errors)
            });
        }

    },
    mounted() {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        this.getInfo()
    }
};
</script>
