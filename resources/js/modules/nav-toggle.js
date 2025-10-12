export default function init(node) {
    const btn = node.querySelector('button');
    if (!btn) return;
    const targetId = btn.getAttribute('aria-controls') || 'mobile-nav';
    let panel = document.getElementById(targetId);
    if (!panel) {
        panel = document.createElement('div');
        panel.id = targetId;
        panel.className = 'md:hidden border-t border-neutral-200/70 bg-white';
        panel.innerHTML = `<nav class="px-4 py-3 space-y-2">
            <a class="block" href="/">Home</a>
            <a class="block" href="#services">Services</a>
            <a class="block" href="#about">About</a>
            <a class="block" href="#contact">Contact</a>
        </nav>`;
        node.parentElement?.appendChild(panel);
    }
    let open = false;
    const update = () => {
        panel.style.display = open ? 'block' : 'none';
        btn.setAttribute('aria-expanded', String(open));
    };
    btn.addEventListener('click', () => {
        open = !open;
        update();
    });
    update();
}

