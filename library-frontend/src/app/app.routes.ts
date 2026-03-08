import { Routes } from '@angular/router';
import { LoginComponent } from './components/login/login';
import { RegisterComponent } from './components/register/register';
import { AuthorListComponent } from './components/author-list/author-list';
import { AuthorFormComponent } from './components/author-form/author-form';
import { BookListComponent } from './components/book-list/book-list';
import { BookFormComponent } from './components/book-form/book-form';

export const routes: Routes = [
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'authors', component: AuthorListComponent },
  { path: 'authors/new', component: AuthorFormComponent },
  { path: 'authors/edit/:id', component: AuthorFormComponent },
  { path: 'books', component: BookListComponent },
  { path: 'books/create', component: BookFormComponent },
  { path: 'books/edit/:id', component: BookFormComponent },
  { path: '', redirectTo: '/login', pathMatch: 'full' }
];
