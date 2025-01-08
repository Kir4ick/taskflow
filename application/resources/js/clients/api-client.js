import axios from "axios";

const BASE_URL = ''

export const apiClient = axios.create({
    baseURL: BASE_URL
})
