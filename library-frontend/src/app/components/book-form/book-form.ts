import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { BookService } from '../../services/book';
import { AuthorService } from '../../services/author';

@Component({
  selector: 'app-book-form',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, RouterLink],
  templateUrl: './book-form.html'
})
export class BookFormComponent implements OnInit {
  bookForm: FormGroup;
  authors: any[] = [];
  isEditMode = false;
  bookId?: number;

  constructor(
    private fb: FormBuilder,
    private bookService: BookService,
    private authorService: AuthorService,
    private router: Router,
    private route: ActivatedRoute
  ) {
    this.bookForm = this.fb.group({
      title: ['', Validators.required],
      isbn: ['', Validators.required],
      author_id: ['', Validators.required],
      published_year: ['', [Validators.required, Validators.min(1000)]]
    });
  }

  ngOnInit(): void {
    // Завантажуємо авторів для випадаючого списку
    this.authorService.getAuthors().subscribe(res => this.authors = res.data);

    this.bookId = Number(this.route.snapshot.paramMap.get('id'));
    if (this.bookId) {
      this.isEditMode = true;
      this.bookService.getBook(this.bookId).subscribe(res => {
        this.bookForm.patchValue(res.data);
      });
    }
  }

  onSubmit(): void {
    if (this.bookForm.valid) {
      const action = this.isEditMode
        ? this.bookService.updateBook(this.bookId!, this.bookForm.value)
        : this.bookService.createBook(this.bookForm.value);

      action.subscribe({
        next: () => this.router.navigate(['/books']),
        error: (err) => console.error(err)
      });
    }
  }
}
