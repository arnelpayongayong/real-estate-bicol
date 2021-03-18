<template src="../../templates/house/newhouse.html">
</template>


<script>
export default {
    data(){
        return{
             agent : {images : []},
             agents: [],
             house : {
                id : '',
                title : 'test',
                description : 'test',
                price : '222',
                floor_area : '2',
                lot_area : '2',
                street: 'San Ramon',
                city : 'Naga',
                province : 'Camarines Sur',
                country : 'Philippines',
                beds : '2',
                bathroom : '3',
                listingType : 'House and Lot',
                isSold : '',
                images : [],
                features : [],
                agentID : ''
            },
            id : '',
            images : [],
            imagesFile : [],
            feature : '',
            features : [],
            counter : 0,
            selectedAgentID : '',
            agentImage : ''

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
         uploadImage(e){

                for(let i = 0; i < e.target.files.length; i++){
                    const image = e.target.files[i]
                    const formData = new FormData
                    formData.set('image',e.target.files[i])
                    formData.set('imageable_type','App\\Models\\House')

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
        saveHouse(){
            this.house.agentID = this.selectedAgentID
            this.axios.post('/house/create',this.house).then(response => {
                this.house = Object.assign({}, this.house,response.data.house)
            })

        },
        saveImage(){

            setTimeout(() => this.imagesFile.forEach(image => {
                   let sample = this.house

                   console.log('start')
                   console.log(this.house)
                   console.log(sample)
                   console.log('end')
                   image.set('imageable_id',this.house.id)
                   axios.post('/image/store',image)
            }), 2000)
        },
        saveFeature(){

             setTimeout(() =>  this.features.forEach(f =>  {
                    axios.post('/feature/store',{feature : f.feature,house_id : this.house.id})
                }), 2000)
        },
        addFeature(){
            this.features.push({feature : this.feature})
            this.house.features.push({feature : this.feature})
            
            this.feature = ''
        },
        saveListing(){
            this.saveHouse()
            this.saveImage()
            this.saveFeature()

            this.$swal("Good job!", "Sucessfully Saved!", "success");

            this.$router.push('/houses/list');

            
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
          setTimeout(() => {
                    console.log(this.agents)
                    if(this.agents.length == 0){
                        this.$router.push('/agent/create')
                    }
          }, 2000)
        
    }
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
