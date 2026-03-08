import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({ providedIn: 'root' })
export class AuthorService {
  private apiUrl = 'http://127.0.0.1:8000/api/authors';

  constructor(private http: HttpClient) {}

  getAuthors(): Observable<any> { return this.http.get(this.apiUrl); }

  getAuthor(id: number): Observable<any> { return this.http.get(`${this.apiUrl}/${id}`); }

  createAuthor(data: any): Observable<any> { return this.http.post(this.apiUrl, data); }

  updateAuthor(id: number, data: any): Observable<any> { return this.http.put(`${this.apiUrl}/${id}`, data); }

  deleteAuthor(id: number): Observable<any> { return this.http.delete(`${this.apiUrl}/${id}`); }
}
