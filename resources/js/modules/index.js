// Simple module registry and initializer based on data-module attributes

const registry = new Map();

export function define(name, init) {
    registry.set(name, init);
}

export function initModules(root = document) {
    const nodes = root.querySelectorAll('[data-module]');
    nodes.forEach((node) => {
        const names = (node.getAttribute('data-module') || '').split(/\s+/).filter(Boolean);
        names.forEach((name) => {
            const init = registry.get(name);
            if (typeof init === 'function') {
                // Avoid double-init
                const key = `__mod_${name}`;
                if (!node[key]) {
                    node[key] = true;
                    try { init(node); } catch (e) { console.error(`[module:${name}]`, e); }
                }
            }
        });
    });
}

// Example modules
import { default as navToggle } from './nav-toggle.js';
import { default as form } from './simple-form.js';

define('nav-toggle', navToggle);
define('form', form);

