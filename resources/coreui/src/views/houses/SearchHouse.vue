<template>
   <div>
       <div>
    <!-- <nav style="width: 100%;position: relative;margin-bottom: 20px;">
        <h1 style="position: absolute;left: 10px;">Logo</h1>

        <ul>
            <li>Home</li>
            <li>Contact</li>
            <li>About</li>
        </ul>
        <a style="position: absolute;right: 10px;"><i class="fa fa-bars" aria-hidden="true" style="visibility:hidden"></i></a>
    </nav> -->

    <nav>
        <h1>Audjean Realty</h1>
        
        <ul>
            <li><a href="http://">Home</a></li>
            <li><a href="http://">Contact</a></li>
             <li><a href="http://">About</a></li>
        </ul>
    
    </nav>

   <section>
        <div class="search">
           <div class="search-address">
                <div class="search-item">
                    <label>Country</label>
                    <input type="text" placeholder="Country" v-model="search.country"/>
                </div>

                <div class="search-item">
                    <label>Province</label>
                    <input type="text" placeholder="Province" v-model="search.province"/>
                </div>

                <div class="search-item">
                    <label>City</label>
                    <input type="text" placeholder="City" v-model="search.city"/>
                </div>

                <div class="search-item">
                    <label>Listing Type</label>
                    <select v-model="search.listing_type">
                        <option value="House and Lot">HOUSE AND LOT</option>
                        <option value="Condominium">CONDIMINIUM</option>
                        <option value="Land">LAND</option>
                        <option value="Lot">LOT</option>
                    </select>
                </div>
           </div>

            <div class="search-price">
                <div class="search-item">
                    <label>Price Range</label>
                    <div class="price-range">
                        <div style="margin-right: 3%;">
                            <input type="number" placeholder="Minimum" v-model="search.minPrice"/>
                        </div>
                        <div>
                            <p>to</p>
                        </div>
                        <div  style="margin-left: 3%;">
                            <input type="number" placeholder="Maximum" v-model="search.maxPrice"/>
                        </div>
                    </div>
                </div>
    
            </div>
            <div class="search-item">
                <button class="search-btn" @click="searchHouse">SEARCH</button>
            </div>
        </div>
    </section>

    <section class="content">
         <h1 class="content-title">HOUSE AND LOT</h1>

         <div class="house-lot-content" >
            <div class="house-item" v-for="(house,index) in searchHouses" :key="index" @click="showHouse(house.id)">
                <div class="body">
                    <template v-if="house.images.length">
                         <img :src="'/../storage/' + house.images[0].path" class="image card-img-top"/>
                    </template>
                    <template v-else>
                        none
                    </template>
                    <h1>₱ {{new Intl.NumberFormat().format(house.price)}}</h1>
                </div>
                <div class="footer">
                    <div class="footer-details">
                        <label>BEDS {{house.beds}}</label>
                        <label>BATHROOM {{house.bathroom}}</label>
                        <label>LOT AREA {{house.lot_area}} sqft</label>
                    </div>
                    <div class="footer-address">
                        <p>{{house.street}}</p>
                    </div>
                </div>
            </div>
         </div>

    </section>

    <footer>
      <div class="footer-item">
        <h1>CONTACT US</h1>
        <p>(050) 999-332</p>
        <p>+63 999 9999 991</p>

        <h1>Follow us</h1>
        <i class="fab fa-facebook-square"></i>
      </div>

      <div class="footer-item">
        <h1 style="text-align: center">Logo</h1>
      </div>
    </footer>
</div>
   </div>
</template>

<script>
export default {
    data(){
        return{
            houses : [],
            searchHouses : [],
            search : {
                country : '',
                province : '',
                city : '',
                minPrice : 100000,
                maxPrice : 100000,
                listing_type : ''
            }
        }
    },

    created(){
        this.getHouses()
    },
    methods: {
       getHouses(){
            this.axios.get('house/index')
            .then(response => {
               this.houses = response.data.houses
               this.searchHouses = response.data.houses
            })
        },
        showHouse(id){
            this.$router.push({ name: 'Show House', params: { id} })
        },
        searchHouse(){

            console.log(this.houses)
            this.searchHouses = this.houses.filter(house => house.listing_type == this.search.listing_type)

            if(this.search.minPrice != 0 && this.search.maxPrice != 0){
                 console.log(this.minPrice)
                 this.searchHouses = this.searchHouses.filter(house => house.price > this.search.minPrice)
                 this.searchHouses = this.searchHouses.filter(house => house.price < this.search.maxPrice)
            }
            if(this.search.country != ''){
                 this.searchHouses = this.searchHouses.filter(house => house.country == this.search.country)
            }

            if(this.search.province != ''){
                 this.searchHouses = this.searchHouses.filter(house => house.province == this.search.province)
            }

             if(this.search.city != ''){
                 this.searchHouses = this.searchHouses.filter(house => house.city == this.search.city)
            }
            console.log(this.searchHouses)
        }
    },
    filters: {

    },
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