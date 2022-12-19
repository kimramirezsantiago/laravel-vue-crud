<template>
    <div class="modal fade" id="studentForm" tabindex="-1" role="dialog" aria-labelledby="studentFormLabel"
    aria-hidden="true">
    <!-- Modal -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentFormLabel"> {{ title }}</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="inputFirstName">First Name</label>
                            <input v-model="firstName" type="text" class="form-control" id="inputFirstName" placeholder="Enter your first name">
                        </div>
                        <div class="form-group mt-3">
                            <label for="inputLastName">Last Name</label>
                            <input v-model="lastName" type="text" class="form-control" id="inputLastName" placeholder="Enter your first name">
                        </div>
                        <div class="form-group mt-3">
                            <label for="inputStatus">Status</label>
                            <select v-model="status" class="form-control custom-select" id="inputStatus">
                                <option v-for="option in statusOptions" v-bind:value="option.key">
                                    {{ option.value }}
                                </option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="saveForm()">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'student'
    ],
    data: function() {
        return {
            title: "",
            firstName: "",
            lastName: "",
            status: -1,
            statusOptions: [
                { key: -1, value: 'Select status' },
                { key: 0, value: 'Pending' },
                { key: 1, value: 'Cancelled' },
                { key: 2, value: 'Declined' },
                { key: 3, value: 'Approved' }
        ]
        }
    },
    methods: {
        saveForm() {
            if(this.student !== null) {
                let data = JSON.stringify({
                    student: {
                        firstName : this.firstName,
                        lastName : this.lastName,
                        status : this.status,
                        documents: this.student.documents
                    }
                });
                axios.put('api/students/' + this.student.id, data, {headers:{"Content-Type" : "application/json"}})
                .then(response => {
                    if(response.status == 200) {
                       this.onSaveSuccess();
                    }
                })
                .catch(error => {
                    console.log(error);
                })
            }
            else {
                let data = JSON.stringify({
                    student: {
                        firstName : this.firstName,
                        lastName : this.lastName,
                        status : this.status,
                        documents: "[]"
                    }
                });
                axios.post('api/students/store', data, {headers:{"Content-Type" : "application/json"}})
                .then(response => {
                    if(response.status == 200) {
                       this.onSaveSuccess();
                    }
                })
                .catch(error => {
                    console.log(error);
                })
            }
        },
        onSaveSuccess() {
            this.$emit('saveSuccess');
            $('#studentForm').modal('hide');
        }
    },
    watch: {
        student: function() {
            if(this.student !== null) {
                this.title = "Edit Student";
                this.firstName = this.student.firstName;
                this.lastName = this.student.lastName;
                this.status = this.student.status;
            }
            else {
                this.title = "Add Student";
                this.firstName = '';
                this.lastName = '';
                this.status = -1;
            }
        }
    }
}
</script>
