<template>
    <Sidebar />

    <div class="mainWindow">
        <!-- <Header /> -->
        <DrawTypes />
    </div>
</template>

<script>
import Sidebar from "./Sidebar";
import Header from "./Header";
import DrawTypes from "./DrawTypes";

export default {
    components: { 
        Sidebar,
        Header,
        DrawTypes
        }
};
</script>

<style scoped>
.mainWindow{
    min-width: 1100px;
    min-height: 2000px;
    padding: 12px 10px 1px 260px;
    background-color:beige;
    font-size: 600;
}
</style>
