<template>
    <div>
        <!-- Page Heading -->
        <div class="row">
            <div class="col">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Cells</h1>
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
                        <router-link :to="{ name: 'CellsCreate' }" class="btn btn-primary">Create Cell</router-link>
                    </div>
                    <div class="card-body">
                        <div v-for="cell, index in cells" :key="cell.id" v-bind:class="{'table-primary': (index == selectedCell)}">
                            <a href="" class="text-decoration-none" v-on:click.prevent="selectCell(index, cell.id)">
                                <div class="row mx-auto p-2">
                                    <div class="col-sm-2">
                                        <i class="fa-square-check" v-bind:class="{'fa-regular': (index != selectedCell), 'fa-solid': (index == selectedCell)}"></i>
                                    </div>
                                    <div class="col-sm-10">
                                        <h5>CELL {{ cell.cell }}</h5>
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
                                <h3>Select a cell to see members</h3>
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
                                <h3>CELL {{ this.cell.cell }}</h3>
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
                                        <tr v-for="member, index in cellMembers" :key="member.id">
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
                                <button class="btn btn-danger" @click="deleteCell(cell.id)">Remove Cell</button>
                            </div>
                            <div class="col">
                                <router-link :to="{ name: 'CellsEdit', params: {id: cell.id} }" class="float-right">Edit</router-link>
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
            cells: [],
            selectedCell: null,
            cell: [],
            cellMembers: [],
            toggleRight: 0,
            showMessage: false,
            message: "",
        }
    },
    created(){
        this.getCells();
    },
    methods: {
        getCells(){
            axios.get('/api/cells').then(res => {
                this.cells = res.data.cells;
                console.log(this.cells);
            }).catch(error => {
                console.log(error);
            })
        },
        selectCell(index, id){
            this.selectedCell = index;
            this.getCell(id);
            this.toggleRight = 1;
        },
        getCell(id){
            axios.get("/api/cells/" + id).then(res => {
                this.cell = res.data.cell
                this.cellMembers = res.data.cell.members
                console.log(this.cell)
            }).catch(error => {
                console.log(error);
            })
        },
        deleteCell(id){
            axios.delete("api/cells/" + id).then(res => {
                this.showMessage = true;
                this.message = res.data;
                this.toggleRight = 0;
                this.getCells();
                
            });
        }
    }
}
</script>

<style>

</style>