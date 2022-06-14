<template>
    PURCHASE PAGE
    <Sidebar />
    <div class="sidebar-layout">
        <div style="padding-left:clamp(50px, 5%, 100px); width: 500px;">
            <h3>TYPE</h3>
                <input list="type" size="40" class="form-control" name="type" v-model="formData.type_id">
                <datalist id="type" size="40">
                    <option v-for="option in data" v-bind:value="option.id">{{option.name}}</option>>
                </datalist>
                    <p class="text-danger" v-if="hasErrors" v-text="errors.errors.type_id"></p>
            <h3>NUMBERS</h3>
                <input type="text" size="40" class="form-control" name="values" v-model="formData.values">
                    <p class="text-danger" v-if="hasErrors" v-text="errors.errors.values"></p>
            <h3>SUM</h3>
                <input type="text" size="40" class="form-control" name="price" v-model="formData.price">
                    <p class="text-danger" v-if="hasErrors" v-text="errors.errors.price"></p>
                    <p class="text-danger" v-if="!hasErrors" v-text="errors.message"></p>
            <button class="btn btn-primary" @click="purchase">Buy Ticket</button>
        </div>
    </div>
</template>

<script>
import Sidebar from "./Sidebar";

export default{
    components: { 
        Sidebar
    },
    data() {
        return {
            data: [],
            formData: {
                type_id: '',
                values: '',
                price: ''
            },
            token: localStorage.getItem('token'),
            errors: {
                errors: '',
                message: ''
            }
        }
    },
    methods: {
        getInfo(){
            axios.get('/api/draw_types').then((response) => {
                this.data = response.data.data
                console.log(this.data);
            }).catch((errors) => {
                console.log(errors)
            });
        },
        purchase(){
            axios.post('api/ticket/create', this.formData, this.config).then((response) => {
                console.log(response.data)
                this.$router.push('/profile/mytickets')
            }).catch((errors) => {
                this.errors = errors.response.data
                console.log(this.errors)
            })
        },
        containsKey(obj, key ) {
            return Object.keys(obj).includes(key);
        }
    },
    computed: {
        hasErrors() {
            return this.containsKey(this.errors, 'errors');
        }
    },
    mounted() {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        this.getInfo()
        const config = {
            headers: { Authorization: `Bearer ${this.token}` }
        };
    }
};
</script>