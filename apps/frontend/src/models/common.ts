export interface TableColumn {
    key: string;
    label: string;
    withMax?: string;
}


export interface  PaginationModel{
    current_page: number;
    from: number;
    last_page: number;
    links: Array<{ url: string | null; label: string; active: boolean }>;
    path: string;
    per_page: number;
    to: number;
    total: number;
}