<template>
    <div>   
        <div class="photo-gallery">
            <div class="container">
                <div class="intro">
                    <h2 class="text-center">{{house.title}} Gallery</h2>
                    <p class="text-center">{{house.description}}</p>
                    <h1 style="font-size:30px" class="text-center">₱ {{new Intl.NumberFormat().format(house.price)}}</h1>
                </div>
            <div class="row photos">
                <div class="col-sm-6 col-md-4 col-lg-3 item" v-for="(image,index) in house.images" :key="index">
                    <a :href="'/../storage/' + image.path" data-lightbox="photos">
                    <img class="img-fluid" :src="'/../storage/' + image.path" height="640" width="426"></a>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                house : {}
            }
        },
       methods : {
            getHouse(){
            let id = this.$route.params.id
            this.axios.get(`house/search/${id}`).then(response => {
                this.house = response.data
            })
        },
       },
       created(){
           this.getHouse()
       }

    }
</script>

<style>

    .photo-gallery {
        color:#313437;
        background-color:#fff;
    }   

    .photo-gallery p {
        color:#7d8285;
    }

    .photo-gallery h2 {
        font-weight:bold;
        margin-bottom:40px;
        padding-top:40px;
        color:inherit;
    }
    .images{
        display: grid;
        grid-template-columns: 500px 400px 400px;
    }
    .images div{
        height: 400px;
    }
    img{
        max-width: 100%;
        max-height: 100%;
    }
    .img-fluid{
        height: 350px;
    }
</style>