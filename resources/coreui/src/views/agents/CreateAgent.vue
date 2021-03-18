<template>
    <div style="padding:5%">

        <div class="image" style="margin-bottom:50px">
            <div class="profile-picture" style="height: 300px;width: 250px;background:gray">
                <img :src="image" class="image" style="height: 300px;width: 250px;"/>
            </div>

           <input style="margin-bottom: 20px" type="file" placeholder="Image Upload" @change="uploadImage"  accept="image/x-png,image/jpeg" />
        </div>
        <form @submit.prevent="save()">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first" aria-describedby="firstnameHelp" v-model="agent.firstname">
            </div>
            <div class="mb-3">
                <label for="middlename" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="middlename" aria-describedby="middlenameHelp"  v-model="agent.middlename">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" aria-describedby="lastnameHelp"  v-model="agent.lastname">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="agent.email">
            </div>

            <div class="mb-3">
                <label for="contact" class="form-label">Contact No.  </label>
                <input type="text" class="form-control" id="contact" aria-describedby="contactHelp" v-model="agent.contact">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>


<script>
export default {
    data(){
        return{
            image : '',
            form : '',
            agent : {
                email : '',
                firstname : '',
                middlename : '',
                lastname : '',
                contact : '',
                path : 'none',
                id : '',
            }
        }
    },
    methods: {
         uploadImage(e){
            const image = e.target.files[0]
            const formData = new FormData

            formData.set('image',e.target.files[0])
            formData.set('imageable_type','App\\Models\\Agent')

            this.form = formData

            const reader = new FileReader()
            reader.readAsDataURL(image)
            reader.onload = e =>{
            
            this.previewImage = e.target.result
            this.image = this.previewImage

            }

            },
        saveAgent(){
            console.log('hel;')
            this.axios.post('/agent/store',this.agent).then(response => {
                 this.agent = Object.assign({}, this.agent,response.data.agent)
            })
        },
        saveImage(){
            setTimeout(() => {
                    this.form.set('imageable_id',this.agent.id)
                    axios.post('/image/store',this.form)
                   },2000)
        },
        save(){
            this.saveAgent()
            this.saveImage()

            this.$router.push('/houses/list')
        }
    }
}
</script>