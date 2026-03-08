import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { AuthorService } from '../../services/author';

@Component({
  selector: 'app-author-form',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, RouterLink],
  templateUrl: './author-form.html'
})
export class AuthorFormComponent implements OnInit {
  authorForm: FormGroup;
  isEditMode = false;
  authorId?: number;

  constructor(
    private fb: FormBuilder,
    private authorService: AuthorService,
    private router: Router,
    private route: ActivatedRoute
  ) {
    this.authorForm = this.fb.group({
      name: ['', Validators.required],
      bio: ['', Validators.required]
    });
  }

  ngOnInit(): void {
    this.authorId = Number(this.route.snapshot.paramMap.get('id'));
    if (this.authorId) {
      this.isEditMode = true;
      this.authorService.getAuthor(this.authorId).subscribe(res => {
        this.authorForm.patchValue(res.data);
      });
    }
  }

  onSubmit(): void {
    if (this.authorForm.valid) {
      const action = this.isEditMode
        ? this.authorService.updateAuthor(this.authorId!, this.authorForm.value)
        : this.authorService.createAuthor(this.authorForm.value);

      action.subscribe({
        next: () => this.router.navigate(['/authors']),
        error: (err) => console.error(err)
      });
    }
  }
}
