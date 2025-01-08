<script>
import {removeTask, updateTask} from "../../clients/tasks/index.js";

const props = defineProps({
    id: Number,
    title: String,
    description: String,
    comments: Array,
    files: Array,
    createdUser: Object,
    endDate: String
})

const emits = defineEmits(['remove-task', 'update-task'])
const deleteTask = async () => {
    const result = await removeTask(props.id)
    if (result) {
        emits('remove-task', props.id)
    }
}

const update = async () => {
    const taskData = {
        title: props.title,
        description: props.description,
        endDate: props.endDate
    }

    const result = await updateTask(taskData, props.id)
    if (result) {
        emits('update-task', result)
    }
}
</script>

<template>

</template>

<style scoped>

</style>
