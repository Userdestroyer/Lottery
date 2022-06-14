<template>
    <div class="sidebar">
        <div class="menuItems">
            <div><router-link to="/">Home</router-link></div>
            <div><router-link to="/register">Register</router-link></div>
            <div><router-link to="/login">Login</router-link></div>
            <div><router-link to="/profile">Profile</router-link></div>
            <div><router-link to="/profile/mytickets">My Tickets</router-link></div>
            <div><router-link to="/purchase">Purchase tickets</router-link></div>
            <button @click="logout" class="btn btn-primary float-right">Logout</button>
        </div>
    </div>
    
</template>

<script>
export default {
    methods:{
        logout(){
            this.$router.push('/login')
            axios.post('/api/logout').then((response) => {
                localStorage.removeItem('token')
            }).catch((errors) => {
                console.log(errors)
            });
        }
    }
};
</script>

<style>

</style>

<style>

</style>
<style scoped>
.sidebar{
    min-width: 200px;
    max-width: 200px;
    font-size: large;
    color: #c9c9c9;
    background-color: red;
    float: left;
    position: fixed;
    z-index: 0;
    top: 0;
    left: 0;
    bottom: 0;
    padding: 30px;
}
</style>
