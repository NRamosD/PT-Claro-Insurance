export interface Course {
    id : number;
    name: string;
    id_schedule: number;
    start_date: Date;
    end_date: Date;
    type: 'Presencial' | 'Virtual';
}
