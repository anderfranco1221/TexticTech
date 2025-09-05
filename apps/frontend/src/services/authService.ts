import axiosInstance from "./axiosConfig";
export const authService = {
  async login(email: string, password: string) {
    //TODO: Implementar logica para obtener el nombre del navegador o dispositivo
    const deviceName = "WebApp";
    try {

      const response = await axiosInstance.post('/login', {
        'email': email,
        'password': password,
        'device_name': deviceName
      });
      return response.data;
    } catch (error) {
      console.error("Login failed:", error);
      throw error;
    }
  }
}
