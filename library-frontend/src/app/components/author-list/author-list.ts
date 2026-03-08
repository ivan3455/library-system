import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router'; // Додайте цей імпорт
import { AuthorService } from '../../services/author';

@Component({
  selector: 'app-author-list',
  standalone: true,
  imports: [CommonModule, RouterLink], // Обов'язково додайте RouterLink сюди
  templateUrl: './author-list.html',
  styleUrl: './author-list.scss'
})
export class AuthorListComponent implements OnInit {
  authors: any[] = [];

  constructor(private authorService: AuthorService) {}

  ngOnInit(): void {
    this.loadAuthors();
  }

  loadAuthors(): void {
    this.authorService.getAuthors().subscribe({
      next: (response: any) => this.authors = response.data,
      error: (err: any) => console.error(err)
    });
  }

  deleteAuthor(id: number): void {
    if (confirm('Are you sure?')) {
      this.authorService.deleteAuthor(id).subscribe({
        next: () => this.loadAuthors(),
        error: (err: any) => console.error(err)
      });
    }
  }
}
