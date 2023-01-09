<template>
  <div>
    <div class="row">
        <div class="col">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Create New Cell</h1>
            </div>
        </div>

        <div class="col">
            <router-link :to="{ name: 'CellsIndex' }" class="float-right">Back</router-link>
        </div>
    </div>

    <div class="row">
        <div class="card mx-auto">
        <div class="card-body">
            <form @submit.prevent="addMember">
                <div class="row mb-3">
                    <label 
                        for="cell" 
                        class="col-md-4 col-form-label text-md-end"
                    >Name of Cell</label>

                    <div class="col-md-6">
                        <input 
                            id="cell" 
                            v-model="formData.cell"
                            type="text" 
                            class="form-control" 
                            name="cell"  
                            required 
                            autocomplete="off" 
                            autofocus
                        >
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" v-on:click.prevent="makeCell">
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
                cell: ''
            }
        }
    },
    methods: {
        async makeCell(){
            console.log(this.formData)
            axios.post("/api/cells", {
                cell: this.formData.cell
            }).then(res => {
                this.$router.push({name: 'CellsIndex'});
            })
        }
    }
}
</script>

<style>

</style>