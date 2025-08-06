import axiosInstance from "./axiosConfig";
import type { CategoryView } from '@/models/Categories';

export const categoryService = {


    async getCategories(pageSize: number = 10, pageNumber: number = 1) {

        const params = {
            page: {
                size: pageSize,
                number: pageNumber
            }
        };

        const response = await axiosInstance.get('/categories', {
            params: params
        });

        return response.data;
    },

    async createCategory(categoryData: CategoryView)
    {
        const response = await axiosInstance.post('/categories', {
            data: {
                type: 'categories',
                attributes: {
                    nombre: categoryData.nombre,
                    descripcion: categoryData.descripcion,
                }
            }
        });

        return response.data;
    },

    async updateCategory(categoryId: number, categoryData: CategoryView) {
        const response = await axiosInstance.put(`/categories/${categoryId}`, {
            data: {
                type: 'categories',
                id: categoryId,
                attributes: {
                    nombre: categoryData.nombre,
                    descripcion: categoryData.descripcion,
                }
            }
        });

        return response.data;
    },
}