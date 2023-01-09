<template>
    <div>
        <!-- Page Heading -->
        <div class="row">
            <div class="col">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Events</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mt-5">
                <div class="card mx-auto">
                    <div v-if="showMessage">
                        <div class="alert alert-success">{{ message }}</div>
                    </div>
                    <div class="card-header">
                        <router-link :to="{ name: 'EventsCreate' }" class="btn btn-primary">Create Event</router-link>
                    </div>
                    <div class="card-body">
                        <div v-for="event in events" :key="event.id">
                            <div class="row mx-auto p-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5>{{ event.topic }}</h5>
                                        <p>{{ event.date }}</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <router-link :to="{ name: 'EventsEdit', params: {id: event.id} }" class="btn btn-success">Edit</router-link>
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-danger" @click.prevent="deleteEvent(event.id)">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios'
export default {
    data(){
        return{
            events: [],
            showMessage: false,
            message: "",
        }
    },
    created(){
        this.getEvents();
    },
    methods: {
        getEvents(){
            axios.get('/api/events').then(res => {
                this.events = res.data.data;
            }).catch(error => {
                console.log(error);
            })
        },
        deleteEvent(id){
            axios.delete("api/events/" + id).then(res => {
                this.showMessage = true;
                this.message = res.data;
                this.getEvents();
            });
        }
    }
}
</script>

<style>

</style>