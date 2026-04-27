import './bootstrap';
import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.store('theme', {
        darkMode: false,
        init() {
            const saved = localStorage.getItem('theme');
            this.darkMode = saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches);
            if (this.darkMode) document.documentElement.classList.add('dark');
        },
        toggle() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            document.dispatchEvent(new CustomEvent('theme-changed'));
        }
    });
});

window.Alpine = Alpine;
Alpine.start();