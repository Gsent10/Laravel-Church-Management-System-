<template>
  <div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Members</h1>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Topbar Search -->
                <form 
                    class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 w-100 mw-100"
                    @submit.prevent="search"
                >
                    <div class="input-group">
                        <input 
                            type="search" 
                            v-model.lazy="search"
                            class="form-control bg-light border-0 small" 
                            placeholder="Search Names..."
                            aria-label="Search" 
                            aria-describedby="basic-addon2"
                        >
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mt-5">
                <div class="card mx-auto">
                    <div class="card-header">
                        <router-link :to="{ name: 'MemberCreate' }" class="btn btn-primary">Add New Member</router-link>
                    </div>
                    <div class="card-body">
                        <div v-for="member, index in members" :key="member.id" v-bind:class="{'table-primary': (index == selectedMember)}">
                            <a href="" class="text-decoration-none" v-on:click.prevent="selectMember(index, member.id)">
                                <div class="row mx-auto p-2">
                                    <div class="col-sm-2">
                                        <i class="fa-square-check" v-bind:class="{'fa-regular': (index != selectedMember), 'fa-solid': (index == selectedMember)}"></i>
                                    </div>
                                    <div class="col-sm-10">
                                        <h5>{{ member.surname }}, {{ member.first_name }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="toggleRight==0" class="col-md-8 mt-5">
                <div class="card mx-auto">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h6 class="font-weight-bold mb-0 text-gray-800">Details</h6>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h6 class="mb-0 text-gray-800">Attendance</h6>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-3">
                            </div>

                            <div class="col-md-6 mt-3">
                                <h3>Select a member to see details</h3>
                                <div>
                                    <p>Birthday: </p>
                                </div>
                                <div>
                                    <p>State of Origin: </p>
                                </div>
                                <div>
                                    <p>LGA of Origin: </p>
                                </div>
                                <div>
                                    <p>Address: </p>
                                </div>
                                <div>
                                    <p>Address: </p>
                                </div>
                                <div>
                                    <p>Phone number: </p>
                                </div>
                                <div>
                                    <p>Departments: </p>
                                </div>
                                <div>
                                    <p>Cell: </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="toggleRight==1" class="col-md-8 mt-5">
                <div class="card mx-auto">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h6 class="font-weight-bold mb-0 text-gray-800">Details</h6>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <a href="" class="text-decoration-none" v-on:click.prevent="togglePageRight(2)">
                                        <h6 class="mb-0 text-gray-800">Attendance</h6>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <img :src="imgPath()" alt="" class="img-thumbnail ">
                            </div>

                            <div class="col-md-6 mt-3">
                                <h3>{{ this.member.surname }}, {{ this.member.first_name }} <span v-if="this.member.middle_name">{{ this.member.middle_name }}</span></h3>
                                <div>
                                    <p>Birthday: <br> 
                                        <span v-if="this.member.birthday" class="font-weight-bold">{{ this.member.birthday }}</span>
                                        <span v-else class="font-weight-bold">Null</span>
                                    </p>
                                </div>
                                <div>
                                    <p>State of Origin: <br> 
                                        <span class="font-weight-bold">{{ this.member.state }} State</span>
                                    </p>
                                </div>
                                <div>
                                    <p>LGA of Origin: <br> 
                                        <span class="font-weight-bold">{{ this.member.lga }} Local Government Area</span>
                                    </p>
                                </div>
                                <div>
                                    <p>Address: <br> 
                                        <span class="font-weight-bold">{{ this.member.address }}</span>
                                    </p>
                                </div>
                                <div>
                                    <p>Phone number: <br> 
                                        <span v-if="this.member.phone" class="font-weight-bold">{{ this.member.phone }}</span>
                                        <span v-else class="font-weight-bold">Null</span>
                                    </p>
                                </div>
                                <div v-if="this.member.departments">
                                    <p>Departments: <br> 
                                        <span v-for="department in this.member.departments" :key="department.id" class="font-weight-bold"> {{ department.department }}, </span>
                                    </p>
                                </div>
                                <div>
                                    <p>Cell: <br> 
                                        <span v-if="this.member.cell" class="font-weight-bold">{{ this.member.cell.cell }}</span>
                                        <span v-else class="font-weight-bold">Null</span>
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col">
                                <router-link :to="{ name: 'MemberEdit', params: {id: member.id} }" class="float-right">Edit</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="toggleRight==2" class="col-md-8 mt-5">
                <div class="card mx-auto">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <a href="" class="text-decoration-none" v-on:click.prevent="togglePageRight(1)">
                                        <h6 class="mb-0 text-gray-800">Details</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h6 class="font-weight-bold mb-0 text-gray-800">Attendance</h6>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <h3>Services Present</h3>
                                <div class="col-xs-12 col-lg-3 mt-2 text-center" v-for="attendace in attendaces" :key="attendace.id">  
                                    <p>{{ attendace[0][0].event[0].topic }}</p>
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
            members: [],
            attendaces: [],
            selectedMember: null,
            search: null,
            member: [],
            toggleRight: 0,
        }
    },
    watch: {
        search() {
            this.getMembers();
        }
    },
    created(){
        this.getMembers();
    },
    methods: {
        getMembers(){
            axios.get('/api/members', {
                params: {
                    search: this.search
                }
            }).then(res => {
                this.members = res.data.data
            }).catch(error => {
                console.log(error);
            })
        },
        getMember(id){
            axios.get("/api/members/" + id).then(res => {
                this.member = res.data.member;
                console.log(this.member);
            }).catch(error => {
                console.log(error);
            })
        },
        imgPath() {
            var path = ("/images/" + this.member.img_path);
            return path;
        },
        getAttendaces(id){
            axios.get("/api/members/attendaces/" + id ).then(res => {
                this.attendaces = res.data.attendaces;
                console.log(this.attendaces);
            }).catch(error => {
                console.log(error);
            })
        },
        selectMember(index, id){
            this.selectedMember = index;
            this.getMember(id);
            this.getAttendaces(id);
            this.toggleRight = 1;
        },
        togglePageRight(index) {
            this.toggleRight = index;
        }
    }
}
</script>

<style>

</style>