<template>
  <div>
        <div class="row">
            <div class="col-md-4">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ this.formData.department }} Department</h1>
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
                                    placeholder="Search member to add to Department"
                                    aria-label="Search" 
                                    aria-describedby="basic-addon2"
                                >
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <router-link :to="{ name: 'DepartmentsIndex' }" class="float-right">Back</router-link>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="members != null" class="row">
            <div class="col-md-12 mt-5">
                <div class="card mx-auto">
                    <div v-if="showMessage">
                        <div class="alert alert-success">{{ message }}</div>
                    </div>
                    <div class="card-header">
                        <h3>Click on member to add to Department</h3>
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

        <div class="row mt-5">
        <div class="col">
            <div class="card mx-auto w-100">
                <div class="card-header">
                    Edit the Name of Department
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <label for="cell" class="col-md-4 col-form-label text-md-end">Department Name</label>
        
                            <div class="col-md-6">
                                <input 
                                    id="cell" 
                                    v-model="formData.department"
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
                                <button type="submit" class="btn btn-primary" v-on:click.prevent="updateCell">
                                    Update Department
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
                cell: ''
            },
            members: null,
            search: null,
            showMessage: false,
            message: "",
        }
    },
    watch: {
        search() {
            this.getMembers();
        }
    },
    created(){
        this.getDepartment();
    },
    methods: {
        getDepartment() {
            axios
                .get("/api/departments/" + this.$route.params.id)
                .then(res => {
                    this.formData = res.data.department;
                    console.log(this.cell)
                })
                .catch(error => {
                    console.log(console.error);
                });
        },
        getMembers(){
            axios.get('/api/members', {
                params: {
                    search: this.search
                }
            }).then(res => {
                console.log(res.data.data)
                this.members = res.data.data
            }).catch(error => {
                console.log(error);
            })
        },
        selectMember(id){
            axios.put("/api/members/" + id + "/add-department-member", {
                department_id: this.$route.params.id
            }).then(res => {
                this.showMessage = true;
                this.message = res.data;
            }).catch(error => {
                console.log(error);
            })
        },
        updateCell(){
            axios.put("/api/cells/" + this.$route.params.id, {
                cell: this.formData.cell
            }).then(res => {
                this.$router.push({name: 'CellsIndex'});
            })
        },
    }
}
</script>

<style>

</style>
