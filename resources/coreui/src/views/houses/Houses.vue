<template src="../../templates/house/mainhouse.html">

</template>

<script>
export default {
    data(){
        return{
            houses : []
        }
    },
    created(){
        this.getHouses()
        console.log(this.houseAndLot)
    },
    methods: {
       getHouses(){
            this.axios.get('house/index')
            .then(response => {
               this.houses = response.data.houses
            })
        },
        showHouse(id){
            console.log(id)
            this.$router.push({ name: 'Show House', params: { id} })
        }
    },
    filters: {

    },
    computed:{
        houseAndLot(){
            return this.houses.map(house => {
                if(house.listing_type == 'House and Lot')
                    return house
            })
        },
        lots(){
            return this.houses.map(house => {
                if(house.listingType == 'lot')
                    return house
            })
        }
    }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Sarpanch:wght@400;500;600;700;800;900&display=swap');

*{
    padding: 0;
    margin: 0;
    scroll-behavior: smooth;
}
body{
    font-family: 'Sarpanch', sans-serif;
    font-weight: 400;
    padding: 0 3% 3% 3%;
}

nav{
    width: 100%;
    position: relative;
    margin-bottom: 20px;
    padding-bottom: 5%;
    padding-top: 3%;
}
nav ul{
    display: flex;
    float: right;
    list-style-type: none;
}
nav ul li{
    margin-right: 20px;
}
nav ul li a {
    color: black;
}
nav ul li a:hover{
    text-decoration: none;
}
nav h1{
    display: inline;
}
.search{
   display: flex;
   flex-direction: column;
   justify-content: center;
   align-items: center;
}
.search .search-address{
    display: flex;
}
.price-range{
    display: flex;
}
.search-item input{
    background-color: #637065;
    color: white !important;
    border: 0;
    padding-top: 2%;
    padding-bottom: 2%;
    padding-left: 2%;
    font-family: 'Sarpanch', sans-serif;
}

.search-item select{
    background-color: #637065;
    color: white !important;
    border: 0;
    padding-top: 2%;
    padding-bottom: 2%;
    padding-left: 2%;
    font-family: 'Sarpanch', sans-serif;
}
.search-item input::placeholder{
    color: white;
}

.search-btn{
    display: block;
    width: 20vw;
    margin: 0 auto;
    margin-top: 3%;
    background-color: #637065;
    border: none;
    padding: 1% 10%;
    color: white;
    font-family: 'Sarpanch', sans-serif;
    font-size:medium;
}

section{
    margin-top: 5%;
}
.house-lot-content{
    margin-bottom: 5%;
    display: grid;
    grid-template-columns: 350px 350px 350px 350px;
}
.content h1{
    font-size: 20px;
}
.house-item{
    margin-top: 10%;
    margin-left: 10%;
    border-radius: 2%;
}
.house-item:hover{
    color: red;
}

.house-item .body{
   
    background-position: center;
    background-size:cover;
    background-repeat: no-repeat;
    height: 20vh;
    position: relative;
}
.house-item .body img{
   
   background-position: center;
   background-size:cover;
   background-repeat: no-repeat;
   height: 20vh;
   width: 100%;
   opacity: .7;
   position: relative;
   border-radius: 2%;

}
.house-item h1{
    position: absolute;
    bottom: 0;
    font-weight: 500;
    display: block;
    background-color: white;
    width: 100%;
    opacity: .8;
       font-size: 20px;
   
}
.house-item .footer{
    background-color: #637065;
    padding: 5%;
}
.house-item .footer .footer-details{
    display: flex;
    flex-direction: row;
    
}
.house-item .footer label{
    width: 100%;
    margin-left: 2%;
    font-size: smaller;
    color: white;
}
.house-item .footer .footer-address{
    color: white;
    text-align: center;
    margin-top: 3%;
}

.partners{
    margin: 10% 0%;
}
.partners-list{
    margin-top: 3%;
    display: grid;
    grid-template-columns: auto auto auto auto;
}

.partners-item{
    height:100px;
}
footer{
    background-color: #427356;
    color: white;
    display: flex;
    padding: 5%;
}
.footer-item h1{
    font-size: large;
}
.footer-item p{
    font-size: small;
}
.footer-item{
    width: 50%;
}
@media only screen and (max-width: 600px)  {
    .search-item{
    justify-content: center;
    padding: 1rem;
}

.search-item label{
    display: block;
    margin-bottom: 5px;
  
    font-size: medium;
}
.search-item input{
    display: block;
    width: 100%;
    margin: 0 auto;
    font-size: 18px;
}

.search-item input::placeholder{
    color: white;
}
.price-range{
    display: flex;
    width: 100%;
    margin: 0 auto;
}
.price-range input{
    width: 90%;
}

.price-range label{
    position: absolute;
    font-size: small;
    text-align: center;
    bottom: 0;
    left: 0;
    font-size: medium;
}
.search-btn{
    display: block;
    width: 90%;
    margin: 0 auto;
    margin-top: 3%;
    background-color: #637065;
    border: none;
    padding: 3%;
    color: white;
    font-family: 'Sarpanch', sans-serif;
    font-size:medium;
}

/* FIRST SECTION END */
/* FIRST SECTION END */
/* FIRST SECTION END */
/* FIRST SECTION END */


.content{
    padding: 5%;
}
.content-title{
    font-weight: 400;
}
.house-item{
    margin-top: 10%;
}

.house-item .body{
   
    background-position: center;
    background-size:cover;
    background-repeat: no-repeat;
    height: 20vh;
    position: relative;
}
.house-item .body img{
   
   background-position: center;
   background-size:cover;
   background-repeat: no-repeat;
   height: 20vh;
   width: 100%;
   opacity: .5;
   position: relative;
}
.house-item h1{
    position: absolute;
    bottom: 0;
    left: 5px;
    font-weight: 500;
   
}
.house-item .footer{
    background-color: #637065;
    padding: 5%;
}
.house-item .footer .footer-details{
    display: flex;
    flex-direction: row;
    
}
.house-item .footer label{
    width: 100%;
    margin-left: 2%;
    font-size: smaller;
    color: white;
}
.house-item .footer .footer-address{
    color: white;
    text-align: center;
    margin-top: 3%;
}

/* SECOND SECTION END*/
/* SECOND SECTION END*/
/* SECOND SECTION END*/
/* SECOND SECTION END*/

.partners{
    margin-top: 10%;
    padding: 5%;
}



/* THIRD SECTION END*/
/* THIRD SECTION END*/
/* THIRD SECTION END*/


footer{
    background-color: #427356;
    color: white;
    display: flex;
    padding: 5%;
}
.footer-item h1{
    font-size: large;
}
.footer-item p{
    font-size: small;
}
.footer-item{
    width: 50%;
}
}
/* */


</style>