<template>
  <div>
        <div class="row">
            <div class="col-md-4">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ attendance.event[0].topic }}</h1>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Topbar Search -->
                        <form 
                            class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 w-100"
                            @submit.prevent="search"
                        >
                            <div class="input-group">
                                <input 
                                    type="search" 
                                    v-model.lazy="search"
                                    class="form-control bg-light border-0 small" 
                                    placeholder="Search for member to mark"
                                    aria-label="Search" 
                                    aria-describedby="basic-addon2"
                                >
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <router-link :to="{ name: 'AttendancesIndex' }" class="float-right">Back</router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card mx-auto">
                    <div v-if="showMessage">
                        <div class="alert alert-success">{{ message }}</div>
                    </div>
                    <div class="card-header">
                        <h3>Click on member to mark present</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-lg-3 mt-2 text-center" v-for="member in members" :key="member.id">
                                <a href="" class="text-decoration-none" v-on:click.prevent="selectMember(member.id)">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>{{ member.surname }}</p>
                                            <p>{{ member.first_name }}</p>
                                            <p>{{ member.state }} State</p>
                                            <p>{{ member.lga }} LGA</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card mx-auto">
                    <div class="card-header">
                        <h3>Members marked present</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-lg-3 mt-2 text-center" v-for="member in presentMembers" :key="member.id">  
                                <div class="card">
                                    <div class="card-body">
                                        <p>{{ member.surname }}</p>
                                        <p>{{ member.first_name }}</p>
                                        <p>{{ member.state }} State</p>
                                        <p>{{ member.lga }} LGA</p>
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
export default {
    data(){
        return{
            members: [],
            presentMembers: [],
            search: null,
            showMessage: false,
            message: "",
            attendance: [],
        }
    },
    watch: {
        search() {
            this.getMembers();
        }
    },
    created(){
        this.getAttendance();
        this.getMembers();
    },
    methods: {
        getAttendance(){
            axios.get('/api/attendances/' + this.$route.params.id).then(res => {
                this.attendance = res.data.attendance[0];
                this.presentMembers = this.attendance.members;
                console.log(this.presentMembers)
            }).catch(error => {
                console.log(error);
            })
        },
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
        selectMember(id){
            axios.put("/api/members/" + id + "/mark-member-present", {
                attendace_id: this.$route.params.id
            }).then(res => {
                this.showMessage = true;
                this.message = res.data;
                this.getAttendance();
            }).catch(error => {
                console.log(error);
            })
        },
    }
}
</script>

<style>

</style>
