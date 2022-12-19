<template>
    <tr>
        <th scope="row">{{ student.id }}</th>
        <td>
            <div>
                {{ student.lastName }}, {{ student.firstName }}
            </div>
            <span class="badge rounded-pill bg-secondary">{{ statusText }}</span>
        </td>
        <td style="text-align: right">
            <button type="button" class="btn btn-success btn-sm" @click="editClicked()"><font-awesome-icon icon="fa-solid fa-pen-to-square" /></button>
            <button type="button" class="btn btn-danger btn-sm" @click="deleteClicked()"><font-awesome-icon icon="fa-solid fa-trash-can" /></button>
        </td>
    </tr>
</template>

<script>
export default {
    props: [
        'student'
    ],
    methods: {
        editClicked() {
            this.$emit('editClicked');
        },
        deleteClicked() {
            axios.delete('api/students/' + this.student.id)
            .then(response => {
                this.$emit('deleteSuccess');
            })
            .catch(error => {
                console.log(error);
            });
        }
    },
    computed: {
        statusText() {
            switch (this.student.status) {
                case 0:
                    return "Pending";
                    break;
                case 1:
                    return "Cancelled";
                    break;
                case 2:
                    return "Declined";
                    break;
                case 3:
                    return "Approved";
                    break;
                default:
                    break;
            }
        }
    }
}
</script>
