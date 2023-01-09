<template>
  <div>
    <div class="row">
        <div class="col">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Create New Department</h1>
            </div>
        </div>

        <div class="col">
            <router-link :to="{ name: 'DepartmentsIndex' }" class="float-right">Back</router-link>
        </div>
    </div>

    <div class="row">
        <div class="card mx-auto">
        <div class="card-body">
            <form @submit.prevent="addMember">
                <div class="row mb-3">
                    <label 
                        for="department" 
                        class="col-md-4 col-form-label text-md-end"
                    >Name of Department</label>

                    <div class="col-md-6">
                        <input 
                            id="department" 
                            v-model="formData.department"
                            type="text" 
                            class="form-control" 
                            name="department"  
                            required 
                            autocomplete="off" 
                            autofocus
                        >
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" v-on:click.prevent="makeDepartment">
                            Create
                        </button>
                    </div>
                </div>
            </form>
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
            formData: {
                department: ''
            }
        }
    },
    methods: {
        async makeDepartment(){
            console.log(this.formData)
            axios.post("/api/departments", {
                department: this.formData.department
            }).then(res => {
                this.$router.push({name: 'DepartmentsIndex'});
            })
        }
    }
}
</script>

<style>

</style>