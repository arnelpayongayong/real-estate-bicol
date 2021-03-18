<template src="../../templates/house/edithouse.html">

</template>


<script>
export default {
    data(){
        return{
            house : {
                listingType : 'House and Lot'
            },
            agents : [],
            agent : {},
            agentImage : '',
            images : [],
            imagesFile : [],
            feature : '',
            features : [],
            counter : 0,
            selectedAgentID : ''

        }
    },
    methods : {
        changeAgent(){
             this.agent = this.agents.find(a => a.id == this.selectedAgentID)
             
             if(this.agent.images){
                 console.log(this.agent)
                 this.agentImage = this.agent.images[0].path
                 console.log(this.agentImage)
             }
         },
         getAgents(){
             this.axios.get('/agent/list').then(response => {
                 this.agents = response.data
                 this.agent = this.agents[0]
             })
         },
        getHouse(){
            let id = this.$route.params.id
            this.axios.get(`house/search/${id}`).then(response => {
                this.house = response.data
            })
        },
        updateHouse(){
            this.house.agentID = this.selectedAgentID
            this.axios.put(`house/edit/${this.house.id}`,this.house).then(response => {
                 console.log( 'success')
            })
        },
         uploadImage(e){

                for(let i = 0; i < e.target.files.length; i++){
                    const image = e.target.files[i]

                    const formData = new FormData
                    formData.set('image',e.target.files[i])
                    formData.set('imageable_id',this.house.id)
                    formData.set('imageable_type','App\\M')

                    this.imagesFile.push(formData)

                    //axios.post('/image/store',formData)
                    const reader = new FileReader()
                    reader.readAsDataURL(image)
                    reader.onload = e =>{
            
                        this.previewImage = e.target.result
                        this.images.push(this.previewImage)

                    }

                   
                }
            },
        saveImage(){
            this.imagesFile.forEach(image => {
                   axios.post('/image/store',image)
            })
        },
        saveFeature(){
            this.features.forEach(f =>  {
                console.log(f)
                axios.post('/feature/store',{feature : f.feature,house_id : this.house.id})
            })
        },
        addFeature(){
            this.features.push({feature : this.feature})
            this.house.features.push({feature : this.feature})

            console.log(this.house.features)
            
            this.feature = ''
        },
        saveListing(){
            this.updateHouse()
            this.saveImage()
            this.saveFeature()
        },
        deleteFeature(id){
            this.axios.delete('/feature/'+ id).then(response => {
                if(response.status == 200){
                    let index = this.house.features.findIndex(feature => feature.id == id)

                    this.house.features.splice(index,1)
                }
            })
        }
    },
    created(){
        this.getAgents()
        this.getHouse()
    },
}
</script>

<style>

.container{
    margin: 0 auto;
    display: flex;
    flex-direction: column;
}
.image-list{
    display: grid;
    grid-template-columns: 300px 300px 300px;
    grid-column-gap: 10px;
    grid-row-gap: 10px;
}
.image-list div{
    width: 300px;
}
.image{
    height: 300px;
    max-height: 300px;
    max-width: 300px;
    border-radius: 2%;
}
h1{
    font-weight: 300;
}
.container-item{
    margin-top: 20px;
    margin-bottom: 50px;
    background: #27ae60;
    padding: 5%;
    color: white;
    border-radius: 2%;
}
</style>