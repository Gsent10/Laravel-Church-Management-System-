<template>
    <div>
        <!-- Page Heading -->
        <div class="row">
            <div class="col">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Departments</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mt-5">
                <div class="card mx-auto">
                    <div v-if="showMessage">
                        <div class="alert alert-success">{{ message }}</div>
                    </div>
                    <div class="card-header">
                        <router-link :to="{ name: 'DepartmentsCreate' }" class="btn btn-primary">Create Department</router-link>
                    </div>
                    <div class="card-body">
                        <div v-for="department, index in departments" :key="department.id" v-bind:class="{'table-primary': (index == selectedDepartment)}">
                            <a href="" class="text-decoration-none" v-on:click.prevent="selectDepartment(index, department.id)">
                                <div class="row mx-auto p-2">
                                    <div class="col-sm-2">
                                        <i class="fa-square-check" v-bind:class="{'fa-regular': (index != selectedDepartment), 'fa-solid': (index == selectedDepartment)}"></i>
                                    </div>
                                    <div class="col-sm-10">
                                        <h5>{{ department.department }} department</h5>
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
                                    <h6 class="font-weight-bold mb-0 text-gray-800">Members</h6>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <h3>Select a department to see members</h3>
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
                                    <h6 class="font-weight-bold mb-0 text-gray-800">Members</h6>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <h3>{{ this.department.department }} Department</h3>
                            </div>

                            <div class="col-md-12 mt-3">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Name</th>
                                        <th scope="col">BirthDay</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="member, index in departmentMembers" :key="member.id">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ member.surname }} {{ member.first_name }}</td>
                                            <td>{{ member.birthday }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-danger" @click.prevent="deleteDepartment(department.id)">Remove Department</button>
                            </div>
                            <div class="col">
                                <router-link :to="{ name: 'DepartmentsEdit', params: {id: department.id} }" class="float-right">Edit</router-link>
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
            departments: [],
            selectedDepartment: null,
            department: [],
            departmentMembers: [],
            toggleRight: 0,
            showMessage: false,
            message: "",
        }
    },
    created(){
        this.getDepartments();
    },
    methods: {
        getDepartments(){
            axios.get('/api/departments').then(res => {
                this.departments = res.data.data;
                console.log(this.departments);
            }).catch(error => {
                console.log(error);
            })
        },
        selectDepartment(index, id){
            this.selectedDepartment = index;
            this.getDepartment(id);
            this.toggleRight = 1;
        },
        getDepartment(id){
            axios.get("/api/departments/" + id).then(res => {
                this.department = res.data.department
                this.departmentMembers = res.data.department.members
                console.log(this.department)
            }).catch(error => {
                console.log(error);
            })
        },
        deleteDepartment(id){
            axios.delete("api/departments/" + id).then(res => {
                this.showMessage = true;
                this.message = res.data;
                this.toggleRight = 0;
                this.getDepartments();
                
            });
        }
    }
}
</script>

<style>

</style>