export default function init(form) {
    if (form.tagName !== 'FORM') form = form.closest('form') || form;
    if (!form || form.__bound) return;
    form.__bound = true;
    // Basic client-side UX touches, no inline scripts
    form.addEventListener('submit', () => {
        const btn = form.querySelector('[type="submit"]');
        if (btn) {
            btn.disabled = true;
            const original = btn.textContent;
            btn.textContent = btn.dataset.loadingLabel || '…';
            setTimeout(() => { btn.disabled = false; btn.textContent = original; }, 3000);
        }
    });
}

