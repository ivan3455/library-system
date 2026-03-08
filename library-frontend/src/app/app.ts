import { Component } from '@angular/core';
import { CommonModule } from '@angular/common'; // Додано
import { RouterOutlet, RouterLink } from '@angular/router';

@Component({
  selector: 'app-root',
  standalone: true,
  // Переконайся, що ВСІ три модулі вказані тут
  imports: [CommonModule, RouterOutlet, RouterLink],
  templateUrl: './app.html',
  styleUrl: './app.scss'
})
export class AppComponent {
  title = 'library-frontend';
}
