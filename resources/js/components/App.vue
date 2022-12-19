<template>
    <div>
        <student-form-vue
            :student=this.student
            @saveSuccess="refreshList"
            />
        <nav class="navbar bg-light">
            <div class="container-fluid app-container">
                <span class="navbar-brand mb-0 h1">Students</span>
                <button type="button" class="btn btn-primary btn-sm" @click="showForm(null)">Add Student</button>
            </div>
        </nav>
        <div class="container-fluid app-container">
            <student-list-view
                :students="students"
                @editClicked="showForm"
                @deleteSuccess="refreshList"
                />
        </div>
    </div>
</template>

<script>
import StudentListView from './StudentListView.vue';
import StudentFormVue from './StudentForm.vue';

export default {
    components: {
        StudentListView,
        StudentFormVue
    },
    data: function() {
        return {
            students: [],
            student: undefined
        }
    },
    methods: {
        getStudents() {
            axios.get('api/students')
            .then(response => {
                this.students = response.data;
            })
            .catch(error => {
                console.log(error);
            })
        },
        showForm(student) {
            if(student === null) {
                // Add
                this.student = null;
            }
            else {
                // Edit
                this.student = student;
            }
            $('#studentForm').modal('show');
        },
        refreshList() {
            this.getStudents();
        }
    },
    created() {
        this.getStudents();
    }
}
</script>
