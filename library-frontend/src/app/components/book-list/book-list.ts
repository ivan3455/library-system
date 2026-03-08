import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BookService } from '../../services/book';

@Component({
  selector: 'app-book-list',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './book-list.html',
  styleUrl: './book-list.scss'
})
export class BookListComponent implements OnInit {
  books: any[] = [];

  constructor(private bookService: BookService) {}

  ngOnInit(): void {
    this.bookService.getBooks().subscribe({
      next: (response: any) => {
        this.books = response.data;
      },
      error: (err: any) => console.error('Error fetching books', err)
    });
  }

  deleteBook(id: number): void {
  if (confirm('Do you want to delete this book?')) {
    this.bookService.deleteBook(id).subscribe({
      next: () => {
        this.books = this.books.filter(b => b.id !== id);
      },
      error: (err: any) => alert('Error deleting book')
    });
  }
}
}
