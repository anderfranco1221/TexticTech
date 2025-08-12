import axios from "axios";

const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || "http://localhost:8000/api";

const axiosInstance = axios.create({
    baseURL: API_BASE_URL,
    headers: {
        "Content-Type": "application/vnd.api+json",
        "Accept": "application/vnd.api+json",
    },
});

// Interceptor de Peticiones: Añade el token de acceso automáticamente
axiosInstance.interceptors.request.use(
    (config) => {
        // Add any request interceptors here
        return config;
    },
    (error) => {
        // Handle request errors
        return Promise.reject(error);
    }
);

// Interceptor de Respuestas: Manejo global de errores HTTP (incluido 401 para tokens expirados)
axiosInstance.interceptors.response.use(
    (response) => {
        // Add any response interceptors here
        return response;
    },
    (error) => {
        if (error.response && error.response.status === 401) {
            // Handle unauthorized access, e.g., redirect to login
            console.error("Unauthorized access - redirecting to login");
            // Redirect logic can be added here
        }
        return Promise.reject(error);
    }
);

export default axiosInstance;