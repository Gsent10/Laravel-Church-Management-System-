<template>
  <div>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ this.formData.topic }}</h1>
                </div>
            </div>

            <div class="col-xs-12 col-md-6">
                <router-link :to="{ name: 'EventsIndex' }" class="float-right">Back</router-link>
            </div>
        </div>

        <div class="row mt-5">
        <div class="col">
            <div class="card mx-auto w-100">
                <div class="card-header">
                    Edit the Name of Event
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <label for="cell" class="col-md-4 col-form-label text-md-end">Event Name</label>
        
                            <div class="col-md-6">
                                <input 
                                    id="cell" 
                                    v-model="formData.topic"
                                    type="text" 
                                    class="form-control" 
                                    name="cell"  
                                    required 
                                    autocomplete="off" 
                                    autofocus
                                >
                            </div>
                        </div>

                        <div class="row mb-3">
                    <label 
                        for="date" 
                        class="col-md-4 col-form-label text-md-end"
                    >Date</label>

                    <div class="col-md-6">
                        <input 
                            id="date" 
                            v-model="formData.date"
                            type="date" 
                            class="form-control" 
                            name="date" 
                            autocomplete="off"
                        >
                    </div>
                </div>
    
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" v-on:click.prevent="updateEvent">
                                    Update Event
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            formData: {
                topic: '',
                date: ''
            },
            members: null,
            search: null,
            showMessage: false,
            message: "",
        }
    },
    created(){
        this.getEvent();
    },
    methods: {
        getEvent() {
            axios
                .get("/api/events/" + this.$route.params.id)
                .then(res => {
                    this.formData = res.data.event;
                })
                .catch(error => {
                    console.log(console.error);
                });
        },
        updateEvent(){
            axios.put("/api/events/" + this.$route.params.id, {
                topic: this.formData.topic,
                date: this.formData.date
            }).then(res => {
                this.$router.push({name: 'EventsIndex'});
            })
        },
    }
}
</script>

<style>

</style>
