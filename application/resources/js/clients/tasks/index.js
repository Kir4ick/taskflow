import {apiClient} from "../api-client.js";

export const removeTask = async (taskId) => {
    const { data } = await apiClient.delete('tasks/remove?id=' + taskId)

    return data.result
}

export const updateTask = async (taskData, taskId) => {
    const { data } = await apiClient.patch('tasks/update?id=' + taskId, {
        ...taskData
    })

    return data.result
}
