<template src="../../templates/house/houselist.html">
    
</template>

<script>
export default {
    data(){
        return{
            houses : []
        }
    },
    methods : {
        getHouses(){
            this.axios.get('house/index')
            .then(response => {
               this.houses = response.data.houses
            })
        },
    },
    created(){
        this.getHouses()
    }
}
</script>

<style>
        .house-list{
            height: 100vh;
            display: flex;
            margin: 0 auto;
            justify-content: center;
        }
        th{
            margin-left: 10%;
        }
        tr td{
            margin: 3%;
        }
</style>