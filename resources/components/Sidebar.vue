<template>
    <div class="sidebar">
        <div class="menuItems">
            <div><router-link to="/register">Register</router-link></div>
            <div><router-link to="/login">Login</router-link></div>
            <div><router-link to="/profile">Profile</router-link></div>
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
    color: white;
    background-color: #1a1e21;
    float: left;
    position: fixed;
    z-index: 0;
    top: 0;
    left: 0;
    bottom: 0;
    padding: 100px;
}
</style>
