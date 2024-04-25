import { Routes } from '@angular/router';
import { StudentComponent } from './components/student/student.component';

export const routes: Routes = [
    {
        path: "students",
        component:StudentComponent,
        title:"Students",
    }
];
