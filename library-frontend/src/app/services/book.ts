import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({ providedIn: 'root' })
export class BookService {
  private apiUrl = 'http://127.0.0.1:8000/api/books';

  constructor(private http: HttpClient) {}

  getBooks(): Observable<any> { return this.http.get(this.apiUrl); }

  getBook(id: number): Observable<any> { return this.http.get(`${this.apiUrl}/${id}`); }

  createBook(data: any): Observable<any> { return this.http.post(this.apiUrl, data); }

  updateBook(id: number, data: any): Observable<any> { return this.http.put(`${this.apiUrl}/${id}`, data); }

  deleteBook(id: number): Observable<any> { return this.http.delete(`${this.apiUrl}/${id}`); }
}
