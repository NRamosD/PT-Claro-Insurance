import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core'
import { StudentsService } from '../../services/students/students.service'
import { Student } from '../../interfaces/student'
import { RouterLink, RouterOutlet } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';

@Component({
  selector: 'app-student',
  standalone: true,
  imports: [CommonModule, RouterOutlet, RouterLink, HttpClientModule],
  templateUrl: './student.component.html',
  styleUrl: './student.component.css'
})
export class StudentComponent implements OnInit{
  students: Student[] = [];
  dataResponse : any;
  existStudents: boolean = false;

  constructor(private studentService: StudentsService) {}


  ngOnInit(): void {
    this.studentService.getStudents().subscribe((dataResponse) => {
      this.dataResponse = dataResponse;
    })
  }

}
