<template>
    <table class="table table-bordered mt-4 table-hover">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Full Name</th>
            <th scope="col" style="text-align: right">Actions</th>
            </tr>
        </thead>
        <tbody>
            <student-list-item
                v-for="(student, index) in students"
                :key="index"
                :student="student"
                @editClicked="$emit('editClicked', student)"
                @deleteSuccess="$emit('deleteSuccess')"
                />
        </tbody>

    </table>
</template>

<script>
import StudentListItem from './StudentListItem.vue';

export default {
    props: ['students'],
    components: {
        StudentListItem
    }
}
</script>
