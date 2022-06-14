<template>
    <div class="sidebar">
        <div class="menuItems">
            <div><router-link to="/register">Register</router-link></div>
            <div><router-link to="/login">Login</router-link></div>
            <div><router-link to="/profile">Profile</router-link></div>
            <div><router-link to="/profile/mytickets">My Tickets</router-link></div>
            <router-link to="/purchase">Purchase tickets</router-link>
        </div>
    </div>
    
</template>

<script>
export default {};
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
    color: white;
    background-color: yellow;
    float: left;
    position: fixed;
    z-index: 0;
    top: 0;
    left: 0;
    bottom: 0;
    padding: 30px;
}
</style>
