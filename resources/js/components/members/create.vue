<template>
  <div>
    <div class="row">
        <div class="col">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Add New Member</h1>
            </div>
        </div>

        <div class="col">
            <router-link :to="{ name: 'MemberIndex' }" class="float-right">Back</router-link>
        </div>
    </div>

    <div class="row">
        <div class="card mx-auto">
        <div class="card-body">
            <form @submit.prevent="addMember">
                <div class="row mb-3">
                    <label 
                        for="firstname" 
                        class="col-md-4 col-form-label text-md-end"
                    >First Name</label>

                    <div class="col-md-6">
                        <input 
                            id="firstname" 
                            v-model="formData.first_name"
                            type="text" 
                            class="form-control" 
                            name="firstname"  
                            required 
                            autocomplete="off" 
                            autofocus
                        >
                    </div>
                </div>

                <div class="row mb-3">
                    <label 
                        for="lastname" 
                        class="col-md-4 col-form-label text-md-end"
                    >Last Name</label>

                    <div class="col-md-6">
                        <input 
                            id="lastname" 
                            v-model="formData.surname"
                            type="text" 
                            class="form-control" 
                            name="lastname" 
                            required 
                            autocomplete="off"
                        >
                    </div>
                </div>

                <div class="row mb-3">
                    <label 
                        for="middlename" 
                        class="col-md-4 col-form-label text-md-end"
                    >Middle Name</label>

                    <div class="col-md-6">
                        <input 
                            id="middlename" 
                            v-model="formData.middle_name"
                            type="text" 
                            class="form-control" 
                            name="middlename" 
                            autocomplete="off"
                        >
                    </div>
                </div>

                <div class="row mb-3">
                    <label 
                        for="birthday" 
                        class="col-md-4 col-form-label text-md-end"
                    >Birth Day</label>

                    <div class="col-md-6">
                        <input 
                            id="birthday" 
                            v-model="formData.birthday"
                            type="date" 
                            class="form-control" 
                            name="birthday" 
                            autocomplete="off"
                        >
                    </div>
                </div>

                <div class="row mb-3">
                    <label 
                        for="state" 
                        class="col-md-4 col-form-label text-md-end"
                    >State of Origin</label>

                    <div class="col-md-6">
                        <input 
                            id="state" 
                            v-model="formData.state"
                            type="text" 
                            class="form-control" 
                            name="state" 
                            required 
                            autocomplete="off"
                        >
                    </div>
                </div>

                <div class="row mb-3">
                    <label 
                        for="lga" 
                        class="col-md-4 col-form-label text-md-end"
                    >Local Government Area</label>

                    <div class="col-md-6">
                        <input 
                            id="lga"
                            v-model="formData.lga" 
                            type="text" 
                            class="form-control" 
                            name="lga" 
                            required 
                            autocomplete="off"
                        >
                    </div>
                </div>

                <div class="row mb-3">
                    <label 
                        for="address" 
                        class="col-md-4 col-form-label text-md-end"
                    >Home Address</label>

                    <div class="col-md-6">
                        <input 
                            id="address" 
                            v-model="formData.address"
                            type="text" 
                            class="form-control" 
                            name="address" 
                            required 
                            autocomplete="off"
                        >
                    </div>
                </div>

                <div class="row mb-3">
                    <label 
                        for="phone" 
                        class="col-md-4 col-form-label text-md-end"
                    >Phone Number</label>

                    <div class="col-md-6">
                        <input 
                            id="phone" 
                            v-model="formData.phone"
                            type="phone" 
                            class="form-control" 
                            name="phone" 
                            pattern="[0-9]{4} [0-9]{3} [0-9]{4}" 
                            autocomplete="off"
                        >
                        <small>Format: 0801 234 5678</small> <br>
                    </div>
                </div>

                <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <label class="form-control cusor-pointer">
                                        <span>
                                        </span>
                                        <input type="file" name="profileImage" id="profileImage" class="hidden" ref="profileImage" @change="handleProfileImage">
                                    </label>
                                </div>
                            </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" v-on:click.prevent="addMember">
                            Register
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
                first_name: '',
                surname: '',
                middle_name: '',
                birthday: '',
                state: '',
                lga: '',
                address: '',
                phone: ''
            },
            profileImage: null
        }
    },
    methods: {
        async addMember(){
            let formData = new FormData()
                
                formData.append('image', this.profileImage)

                _.each(this.formData, (value, key) => {
                    formData.append(key, value)
                })


            axios.post("/api/members", formData, {
                headers: {
                            'Content-Type': "multipart/form-data"
                        }
            }).then(res => {
                this.$router.push({name: 'MemberIndex'});
            })
        },
        handleProfileImage() {
            this.profileImage = this.$refs.profileImage.files[0]
        }
    }
}
</script>

<style>

</style>