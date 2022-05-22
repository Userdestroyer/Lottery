<template>
<div class="d-flex flex-column">
    <div class="d-flex justify-content-evenly">
        DRAW TYPES
    </div>
    <div >
        <ul id="example">
            <div v-for="type in data">
                <p class="text-center">{{type.name}}</p>
                <p class="text-center">{{type.description}}</p>
            </div>
        </ul>
        
    </div>

</div>
</template>

<script>
export default {
    data(){
        return {
            data: [],
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
        }
    },
    mounted() {
        this.getInfo()
    }
};
</script>
