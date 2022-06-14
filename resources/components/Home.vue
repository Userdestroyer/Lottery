<template>
    <Sidebar />

    <div class="sidebar-layout">
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
