<template>
    <div class="sidebar">
        <div class="menuItems">
            <div style="max-width: 200px;"><img src="../../public/images/Logo3.png" style="max-width:100%;max-height:100%;" alt=""></div>
            <div><router-link to="/">Home</router-link></div>
            <div v-if="!tokenSet"><router-link to="/register">Register</router-link></div>
            <div v-if="!tokenSet"><router-link to="/login">Login</router-link></div>
            <div v-if="tokenSet"><router-link to="/profile">Profile</router-link></div>
            <div v-if="tokenSet"><router-link to="/profile/mytickets">My Tickets</router-link></div>
            <div><router-link to="/purchase">Purchase tickets</router-link></div>
            <button v-if="tokenSet" @click="logout" class="btn btn-primary float-right">Logout</button>
        </div>
    </div>
    
</template>

<script>
export default {
    data() {
        return {
           tokenSet: false,
        }
    },
    methods:{
        logout(){
            axios.post('/api/logout').then((response) => {
                localStorage.removeItem('token')
                this.$router.push('/login')
            }).catch((errors) => {
                console.log(errors)
            });
        },
        checkToken(){
            if(localStorage.getItem('token') != null){
                this.tokenSet = true
                console.log(this.tokenSet)
            }
        }
        
    },
    mounted(){
        this.checkToken()
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
    background-color: #13214f;
    float: left;
    position: fixed;
    z-index: 0;
    top: 0;
    left: 0;
    bottom: 0;
    padding: 30px;
}
</style>
