<template>
    <Sidebar />
    <div class="sidebar-layout">
        <div class="lottery-header">HOMEPAGE</div>
        <DrawTypes />
    </div>
</template>

<script>
import Sidebar from "./Sidebar";
import DrawTypes from "./DrawTypes";

export default {
    components: { 
        Sidebar,
        DrawTypes
        }
};
</script>

<style scoped>

</style>
