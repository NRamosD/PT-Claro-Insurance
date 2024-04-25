import { environment } from '../../../../environment';

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Student } from '../../interfaces/student';

@Injectable({
  providedIn: 'root'
})
export class StudentsService {
  private baseURL = environment.apiUrl

  constructor(private http: HttpClient) { }

  getStudents(): Observable<Student[]> {
    return this.http.get<Student[]>(`${this.baseURL}/student`);
  }
}
