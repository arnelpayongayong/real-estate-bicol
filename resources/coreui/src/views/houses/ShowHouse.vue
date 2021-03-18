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

        
        <div style="margin-top:10%">
            <h1 style="text-align:center;font-weigth:200">AGENT</h1>
             
             <div class="agent">
                  <div class="image" style="margin-bottom:50px">
                    <div class="profile-picture" style="height: 300px;width: 250px;background:gray">
                        <img :src="'/../storage/' + agentImage" class="image" style="height: 300px;width: 250px;"/>
                    </div>

                <!-- <input style="margin-bottom: 20px" type="file" placeholder="Image Upload" @change="uploadImage"  accept="image/x-png,image/jpeg" /> -->
                </div>

                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first" aria-describedby="firstnameHelp" v-model="house.agent.firstname" disabled>
                </div>
                <div class="mb-3">
                        <label for="middlename" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middlename" aria-describedby="middlenameHelp"  v-model="house.agent.middlename" disabled>
                </div>
                <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" aria-describedby="lastnameHelp"  v-model="house.agent.lastname" disabled>
                </div>
                <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="house.agent.email" disabled>
                </div>

                <div class="mb-3">
                        <label for="contact" class="form-label">Contact No.  </label>
                        <input type="text" class="form-control" id="contact" aria-describedby="contactHelp" v-model="house.agent.contactNo" disabled>
                </div>


                 <div class="mb-3">
                        <label for="message" class="form-label">Message  </label>
                        <textarea class="form-control">Hi,I'm interested</textarea>
                </div>

                 <div class="mb-3">
                        <label for="clientName" class="form-label">Full Name</label>
                         <input type="text" class="form-control" id="clientName" aria-describedby="clientName" v-model="client.name">
                </div>

                <div class="mb-3">
                        <label for="clientEmail" class="form-label">Your Email </label>
                         <input type="email" class="form-control" id="clientEmail" aria-describedby="clientEmail" v-model="client.email">
                </div>

                

                 <div class="mb-3">
                     <button class="btn btn-primary form-control" @click="sendEmail">Send</button>
                </div>
             </div>
            
        </div>


    </div>


    


</template>

<script>
    export default{
        data(){
            return{
                house : {
                     agent : {
                        email : '',
                        firstname : '',
                        middlename : '',
                        lastname : '',
                        contact : '',
                        path : 'none',
                        id : '',
                    }
                },
                agentImage : '',
                client : {name : '',email : ''}
            }
        },
       methods : {
            getHouse(){
            let id = this.$route.params.id
            this.axios.get(`house/search/${id}`).then(response => {
                this.house = response.data
                this.agentImage = this.house.agent.images[0].path
                console.log(this.house)
            })
        },
            sendEmail(){
                this.axios.post('/sample/email',this.client).then(response => {
                    console.log(response)
                })
            }
       },
       created(){
           this.getHouse()
       }

    }
</script>

<style>
    .row {
        row-gap: 3ch;
    }
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
    .agent{
        justify-content: center;
        text-align: center;
        display: flex;
        flex-direction: column;
    }
    .agent .image{
        margin: 0 auto;
    }
</style>