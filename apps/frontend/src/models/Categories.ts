export interface Category {
    id: number;
    nombre: string;
    descripcion: string;
}

export interface CategoryView extends Category {
    useLink?: string | null; // Optional link for actions
}