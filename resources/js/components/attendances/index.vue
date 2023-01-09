<template>
    <div>
        <!-- Page Heading -->
        <div class="row">
            <div class="col">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Attendances</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mt-5">
                <div class="card mx-auto">
                    <div v-if="showMessage">
                        <div class="alert alert-success">{{ message }}</div>
                    </div>
                    <div class="card-body">
                        <div v-for="attendance in attendances" :key="attendance.id">
                            <div class="row mx-auto p-2">
                                <div class="col-sm-6">
                                    <h5>{{ attendance.event[0].topic }}</h5>
                                    <p>{{ attendance.event[0].date }}</p>
                                </div>
                                <div class="col-sm-6 mt-1">
                                    <router-link :to="{ name: 'AttendancesMark', params: {id: attendance.id} }" class="btn btn-success">Mark Attendance</router-link>
                                    <button class="btn btn-danger mt-1" @click.prevent="deleteAttendance(attendance.id)">Delete</button>
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
            attendances: [],
            showMessage: false,
            message: "",
        }
    },
    created(){
        this.getAttendances();
    },
    methods: {
        getAttendances(){
            axios.get('/api/attendances').then(res => {
                this.attendances = res.data.attendances;
                console.log(this.attendances);
            }).catch(error => {
                console.log(error);
            })
        },
        deleteEvent(id){
            axios.delete("api/attendances/" + id).then(res => {
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