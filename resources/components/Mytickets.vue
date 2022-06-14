<template>
MYTICKETS
<Sidebar />
<div class="sidebar-layout">
    <div style="padding-left:50px">
        <table border="1">
            <tr>
                <th>Type</th>
                <th>Draw</th>
                <th>Ticket Number</th>
                <th>Values</th>
                <th>Price</th>
                <th>Winner</th>
                <th>Matches</th>
                <th>Number of matches</th>
                <th>Winning amount</th>
            </tr>
            <tr v-for="row in data.content"><td v-for="value in row">{{value}}</td></tr>
        </table>
    </div>
</div>
</template>

<script>
import Sidebar from "./Sidebar";

export default{
    components: { 
        Sidebar
    },
    data(){
        return {
            data: {
                content: [],
                message: []
            },
            token: localStorage.getItem('token')
        }
    },
    methods: {
        getInfo(){
            axios.get('/api/profile/mytickets').then((response) => {
                this.data.content = response.data
                console.log(this.data.content)
            }).catch((errors) => {
                console.log(errors)
            });
        }
    },
    mounted() {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        this.getInfo()
    }
}
</script>