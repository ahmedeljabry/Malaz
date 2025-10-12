import './bootstrap';
import { initModules } from './modules/index.js';

// Initialize feature modules after DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => initModules());
} else {
    initModules();
}
