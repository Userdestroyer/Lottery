<template>
    <Sidebar />
    <div class="d-flex flex-column">
        <div class="d-flex justify-content-evenly">
            MY PROFILE PAGE
            <button @click="logout" class="btn btn-primary float-right">Logout</button>
        </div>
        <div >
            <h3 class="text-center">Personal Info</h3>
            <p class="text-center">Name: {{data.personal.name}}</p>
            <p class="text-center">Email: {{data.personal.email}}</p>
            <p class="text-center">Role: {{data.personal.role}}</p>
            <p class="text-center">Phone: {{data.personal.phone_number}}</p>
            <h3 class="text-center">PayAccounts</h3>
            <div v-for="account in data.payaccounts">
                <p class="text-center">Description: {{account.description}}</p>
                <p class="text-center">Balance: {{account.balance}}</p>
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
    data(){
        return {
            data: {
                personal: [],
                payaccounts: []
            },
            token: localStorage.getItem('token')
        }
    },
    methods: {
        getInfo(){
            axios.get('/api/profile').then((response) => {
                this.data.personal = response.data
            }).catch((errors) => {
                console.log(errors)
            });
            axios.get('/api/profile/payaccountinfo').then((response) => {
                this.data.payaccounts = response.data
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
